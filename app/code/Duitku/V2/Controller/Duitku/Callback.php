<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku .
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku 
 * @copyright Duitku  (http://duitku.com)
 * @license   Duitku 
 *
 */
namespace Duitku\V2\Controller\Duitku;

use Duitku\V2\Model\Method\MethodRegistry;
use \Magento\Framework\Webapi\Exception;
use \Magento\Framework\Webapi\Response;
use \Duitku\V2\Helper\DuitkuConstants;

class Callback extends \Duitku\V2\Controller\Duitku\DuitkuController
{
    /**
     * Callback Action
     */
    public function execute()
    {
    	
        $posted = $this->getRequest()->getParams();
		        /** @var \Magento\Sales\Model\Order */
        $order = null;
        $message = "Callback Failed: ";
        $responseCode = Exception::HTTP_BAD_REQUEST;
        if ($this->validateCallback($posted, $order, $message)) {
            $message = $this->processCallback($posted, $order, $responseCode);
        }

        $id = isset($order) ? $order->getIncrementId() : 0;
         if ($responseCode !== Response::HTTP_OK) {
            if (isset($order)) {
                $paymentMethodClass = $this->_getPaymentMethodInstance($order->getPayment()->getMethod());
                $paymentMethod = $paymentMethodClass::METHOD_CODE;
                $this->_logError($id, $paymentMethod, $message);
                $order->addStatusHistoryComment($message);
                $order->save();
            } else {
                $this->_logError("Error", "Callback", $message);
            }
        } else {
            $this->_logInfo($id,$message);
        }
        //$callBackResult = $this->_createCallbackResult($responseCode, $message, $id);
       
        exit;
    }

    /**
     * Validate the callback
     *
     * @param mixed $posted
     * @param \Magento\Sales\Model\Order $order
     * @param string $message
     * @return bool
     */
    public function validateCallback($posted, &$order, &$message)
    {
        //Validate response
        if (!isset($posted)) {
            $message .= "Response is null";
            return false;
        }

        //Validate parameteres
        if (!isset($posted['merchantOrderId'], $posted['resultCode'], $posted['reference'], $posted['signature'], $posted['amount'])) {
            $message .= "Parameteres are missing. Request: " . json_encode($posted);
            return false;
        }

        //Validate Order
        $order = $this->_getOrderByIncrementId($posted['merchantOrderId']);
        if (!isset($order)) {
            $message .= "The Order could be found or created";
            return false;
        }

        //Validate Payment
        $payment = $order->getPayment();
        if (!isset($payment)) {
            $message .= "The Payment object is null";
            return false;
        }
		
		$amount = isset($posted['amount']) ? $posted['amount'] : null; 
		$merchantOrderId = isset($posted['merchantOrderId']) ? $posted['merchantOrderId'] : null;
		$signature = isset($posted['signature']) ? $posted['signature'] : null; 
        $reference = isset($posted['reference']) ? $posted['reference'] : null; 
		$obj = \Magento\Framework\App\ObjectManager::getInstance();
        $merchantCode = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('payment/duitku_setting/merchantnumber');
		$apiKey = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('payment/duitku_setting/api_key');
		$params = $merchantCode . $amount . $merchantOrderId . $apiKey;
		$resultCode = isset($posted['resultCode']) ? $posted['resultCode']:null;

        $paymentmode = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('payment/duitku_setting/payment_mode');
    	if($paymentmode =='1')
    	{
		    $url = 'https://passport.duitku.com/webapi';
		}else{
		    $url = 'https://sandbox.duitku.com/webapi';
		}


	    //check signature
	    if ($signature != hash("sha256", $params)) {
		   $message .= "Signature is invalid";
		   return false;			
	    }

        //validate transaction
        $helper = $obj->get('Duitku\V2\Helper\Data');
        $DuitkuCore = $helper->getDuitkuCore();
        $validate = $DuitkuCore->validateTransaction($url, $merchantCode, $merchantOrderId, $reference, $apiKey);

	    if ($resultCode != '00') {
            $message .= "failed transaction";
            return false;
    	} 

        if (!$validate){
            $message .= "Payment not yet implemented";
            return false;
        }

        return true;
    }

    /**
     * Process the callback from Duitku
     * @param mixed $posted
     * @param \Magento\Sales\Model\Order $order
     * @param int $responseCode
     * @return void
     */
    public function processCallback($posted, $order, &$responseCode)
    {
        $duitkuTransactionId = $posted['reference'];
        $payment = $order->getPayment();
        $reference = MethodRegistry::getReferenceByMethod($order->getPayment()->getMethod());
        try {
            $pspReference = $payment->getAdditionalInformation($reference);
            if (empty($pspReference)) {
                $paymentMethod = $this->_getPaymentMethodInstance($order->getPayment()->getMethod());
                 $this->_processCallbackData($order,
                     $paymentMethod,
                     $duitkuTransactionId,
                     $reference,
                     $this->_duitkuHelper->getDuitkuSettingConfigData(DuitkuConstants::ORDER_STATUS),
                     $payment
                 );

                $message = "Callback Success - Order created";
            } else {
                $message = "Callback Success - Order already created";
            }
            $responseCode = Response::HTTP_OK;
        } catch (\Exception $ex) {
            $order->setState(\Magento\Sales\Model\Order::STATE_PENDING_PAYMENT);
            $order->setStatus(\Magento\Sales\Model\Order::STATE_PENDING_PAYMENT);
            $payment->setAdditionalInformation(array($reference => ""));
            $payment->save();
            $order->save();

            $message = "Callback Failed - " .$ex->getMessage();
            $responseCode = Exception::HTTP_INTERNAL_ERROR;
        }

        return $message;
    }
}
