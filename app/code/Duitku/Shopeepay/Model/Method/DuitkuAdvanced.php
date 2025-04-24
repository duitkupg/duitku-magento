<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku Shopee.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku Shopee
 * @copyright Duitku Shopee (http://duitku.com)
 * @license   Duitku Shopee
 *
 */
namespace Duitku\Shopeepay\Model\Method;

class DuitkuAdvanced extends \Magento\Payment\Model\Method\AbstractMethod
{
    const METHOD_CODE = 'duitku_advanced';

    protected $_code = self::METHOD_CODE;

    /**
     * @var bool
     */
    protected $_isGateway = false;

    /**
     * @var bool
     */
    protected $_canAuthorize = false;

    /**
     * @var bool
     */
    protected $_isInitializeNeeded = false;
}
