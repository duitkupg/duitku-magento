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
namespace Duitku\V2\Observer;
use \Duitku\V2\Model\Method\MethodRegistry as MethodRegistry;

class SalesOrderPaymentPlaceStart implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Sales Order Payment Place Start Observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $payment = $observer->getEvent()->getPayment();
        if (in_array($payment->getMethod(), MethodRegistry::getAllCodes(), true)) {
            $order = $payment->getOrder();
            $order->setCanSendNewEmailFlag(false);
            $order->setIsCustomerNotified(false);
            $order->save();
        }
    }
}
