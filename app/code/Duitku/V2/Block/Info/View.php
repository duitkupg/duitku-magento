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
namespace Duitku\V2\Block\Info;
use Duitku\V2\Model\Method\MethodRegistry as MethodRegistry;

class View extends \Magento\Payment\Block\Info
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('sales/order/view/info.phtml');
    }
    
    /**
     * {@inheritdoc}
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        if ($this->_paymentSpecificInformation !== null) {
            return $this->_paymentSpecificInformation;
        }
        
        $transport = parent::_prepareSpecificInformation($transport);
        $data = [];

        if ($this->getInfo()->getLastTransId()) {
            $txnId = "";
            $payment = $this->getInfo()->getOrder()->getPayment();
            
            if (in_array($payment->getMethod(), MethodRegistry::getAllCodes(), true)){
                $referenceKey = MethodRegistry::getReferenceByMethod($payment->getMethod());
                if ($referenceKey) {
                    $txnId = $payment->getAdditionalInformation($referenceKey);
                }
            }

            if (!empty($txnId)) {
                $data[(string)__("Transaction Id")] = $txnId;
            }
        }

        return $transport->setData(array_merge($data, $transport->getData()));
    }

    /**
     * Get translated payment information title
     * @return string
     */
    public function getPaymentInformationTitle()
    {
        return __("Payment Information");
    }
}
