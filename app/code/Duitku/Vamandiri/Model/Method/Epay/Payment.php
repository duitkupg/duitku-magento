<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku Vamandiri.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku Vamandiri
 * @copyright Duitku Vamandiri (http://duitku.com)
 * @license   Duitku Vamandiri
 *
 */
namespace Duitku\Vamandiri\Model\Method\Epay;
use \Magento\Sales\Model\Order\Payment\Transaction;
use \Duitku\Vamandiri\Helper\DuitkuConstants;

class Payment extends \Duitku\Vamandiri\Model\Method\AbstractPayment
{
    const METHOD_CODE = 'duitku_vamandiriepay';
    const METHOD_REFERENCE = 'duitkuvaperReference';

    protected $_code = self::METHOD_CODE;

    protected $_infoBlockType = 'Duitku\Vamandiri\Block\Info\View';

    /**
     * Payment Method feature
     */
    protected $_isGateway                   = true;
    protected $_canCapture                  = true;
    protected $_canCapturePartial           = true;
    protected $_canRefund                   = true;
    protected $_canRefundInvoicePartial     = true;
    protected $_canVoid                     = true;
    protected $_canDelete                   = true;

    /**
     * @var \Duitku\Vamandiri\Model\Api\Epay\Request\Models\Auth
     */
    protected $_auth;

    /**
     * Get ePay Auth object
     *
     * @return \Duitku\Vamandiri\Model\Api\Epay\Request\Models\Auth
     */
    public function getAuth()
    {
        if (!$this->_auth) {
            $storeId = $this->getStoreManager()->getStore()->getId();
            $this->_auth = $this->_duitkuHelper->generateEpayAuth($storeId);
        }

        return $this->_auth;
    }

    /**
     * Get Duitku Checkout payment window
     *
     * @param \Magento\Sales\Model\Order
     * @return \Duitku\Vamandiri\Model\Api\Epay\Request\Payment
     */
    public function getPaymentWindow($order)
    {
    	
        if (!isset($order)) {
            return null;
        }
        return $this->createPaymentRequest($order);
    }

    /**
     * Create the ePay payment window Request url
     *
     * @param \Magento\Sales\Model\Order
     * @return \Duitku\Vamandiri\Model\Api\Epay\Request\Payment
     */
    public function createPaymentRequest($order)
    {
    $obj = \Magento\Framework\App\ObjectManager::getInstance();
   	$orderId = $order->getIncrementId();
   	$merchantcode = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('payment/duitku_epay/merchantnumber');
  	 $apikey = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('payment/duitku_epay/api_key');
    $amount = round($order->getBaseTotalDue());
    $signature = md5($merchantcode.$orderId.$amount.$apikey);
    $callbackUrl = $this->_urlBuilder->getUrl('duitku/epayvamandiri/callback');
    $returnUrl = $this->_urlBuilder->getUrl('duitku/epayvamandiri/accept');
    $merchantUserInfo = $order->getCustomerFirstname() . " " . $order->getCustomerLastname();
    $email = $order->getCustomerEmail();
		
		$params = array(
             'merchantCode' => $merchantcode,
             'paymentAmount' => $amount,
             'paymentMethod' => 'M1',
			 'merchantOrderId' =>$orderId,
             'productDetails' => 'Order : '.$orderId,
             'additionalParam' => '',
             'merchantUserInfo' => $merchantUserInfo,
			 'email' => $email, 
             'callbackUrl' => $callbackUrl ,
             'returnUrl' => $returnUrl,
             'signature' => $signature,
         );
         
           return $params;
    }


    /**
     * Calculate the shipment Vat based on shipment tax and base shipment price
     *
     * @param \Magento\Sales\Model\Order $order
     * @return int
     */
    public function calculateShippingVat($order)
    {
        if ($order->getBaseShippingTaxAmount() <= 0 || $order->getBaseShippingAmount() <= 0) {
            return 0;
        }
        $shippingVat = round(($order->getBaseShippingTaxAmount() / $order->getBaseShippingAmount()) * 100);
        return $shippingVat;
    }

    /**
     * Remove special characters
     *
     * @param string $value
     * @return string
     */
    public function removeSpecialCharacters($value)
    {
        return preg_replace('/[^\p{Latin}\d ]/u', '', $value);
    }

   
   

    /**
     * Cancel payment
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @return $this
     */
    public function cancel(\Magento\Payment\Model\InfoInterface $payment)
    {
        try {
            $this->void($payment);
            $this->_messageManager->addSuccess(__("The payment have been voided").' ('.$payment->getOrder()->getIncrementId().')');
        } catch (\Exception $ex) {
            $this->_messageManager->addError($ex->getMessage());
        }

        return $this;
    }

   

    /**
     * Get Duitku Checkout Transaction
     *
     * @param mixed $transactionId
     * @param string &$message
     * @return \Duitku\Vamandiri\Model\Api\Epay\Response\Models\TransactionInformationType|null
     */
   

    /**{@inheritDoc}*/
    public function canCapture()
    {
        if ($this->_canCapture && $this->canAction($this::METHOD_REFERENCE)) {
            return true;
        }

        return false;
    }

    /**{@inheritDoc}*/
    public function canRefund()
    {
        if ($this->_canRefund && $this->canAction($this::METHOD_REFERENCE)) {
            return true;
        }

        return false;
    }

    /**{@inheritDoc}*/
    public function canVoid()
    {
        if ($this->_canVoid && $this->canAction($this::METHOD_REFERENCE)) {
            return true;
        }

        return false;
    }

   
    /**
     * Retrieve an url for the ePay Checkout action
     *
     * @return string
     */
    public function getCheckoutUrl()
    {
        return $this->_urlBuilder->getUrl('duitku/epayvamandiri/checkout', ['_secure' => $this->_request->isSecure()]);
    }

    /**
     * Retrieve an url for the ePay Decline action
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->_urlBuilder->getUrl('duitku/epayvamandiri/cancel', ['_secure' => $this->_request->isSecure()]);
    }

}
