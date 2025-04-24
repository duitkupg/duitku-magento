<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku Bcaklikpay.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku Bcaklikpay
 * @copyright Duitku Bcaklikpay (http://duitku.com)
 * @license   Duitku Bcaklikpay
 *
 */
namespace Duitku\Bcaklikpay\Controller\Epaybca;

class Cancel extends \Duitku\Bcaklikpay\Controller\AbstractActionController
{
    /**
     * Decline Action
     */
    public function execute()
    {
    	
        $this->cancelOrder();
    }
}
