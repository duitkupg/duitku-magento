<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku Ovo.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku Ovo
 * @copyright Duitku Ovo (http://duitku.com)
 * @license   Duitku Ovo
 *
 */
namespace Duitku\Ovo\Controller\Epayovo;
use Magento\Framework\Controller\ResultFactory;

class Checkout extends \Duitku\Ovo\Controller\AbstractActionController
{
    /**
     * Checkout Action
     */
    public function execute()
    {
    	 $obj = \Magento\Framework\App\ObjectManager::getInstance();
    	 $paymentmode = $obj->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('payment/duitku_epay/payment_mode');
    	 if($paymentmode =='1')
    	 {
		 	  $url = 'https://passport.duitku.com/webapi';
		 }else{
		 	$url = 'http://sandbox.duitku.com/webapi';
		 	
		 }
        $order = $this->_getOrder();
        $this->setOrderDetails($order);
        $result = $this->getEPayPaymentWindowRequest($order);
        // $helper_factory = $obj->get('\Magento\Core\Model\Factory\Helper');
       //	$helper = $helper_factory->get('\Duitku\Online\Helper\Data');
       	$helper = $obj->get('Duitku\Online\Helper\Data');
        $Duitkuvtweb = $helper->getDuitkuvtweb();
      	$redirUrl = $Duitkuvtweb->getRedirectionUrl($url,$result);
      	$resultarr = array();
      	$resultarr['url']=$redirUrl;
        $resultJson = json_encode($resultarr);
        return $this->_resultJsonFactory->create()->setData($resultJson);
	  
    }

    /**
     * Get the Epay Payment window url
     *
     * @param \Magento\Sales\Model\Order
     * @return string|null
     */
    public function getEPayPaymentWindowRequest($order)
    {
        try {
            /** @var \Duitku\Ovo\Model\Method\Epay\Payment */
            $epayMethod = $this->_getPaymentMethodInstance($order->getPayment()->getMethod());
            $response = $epayMethod->getPaymentWindow($order);
            return $response;
        } catch (\Exception $ex) {
            $this->_duitkuLogger->addEpayError($order->getId(), $ex->getMessage());
            return null;
        }
    }
}
