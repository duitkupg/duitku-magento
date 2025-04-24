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
namespace Duitku\Shopeepay\Logger;

use Monolog\Logger;

class DuitkuHandler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::DEBUG;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/duitku.log';
}
