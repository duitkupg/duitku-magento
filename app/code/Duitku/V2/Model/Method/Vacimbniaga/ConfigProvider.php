<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku
 * @copyright Duitku (http://duitku.com)
 * @license   Duitku
 *
 */
namespace Duitku\V2\Model\Method\Vacimbniaga;

use \Duitku\V2\Model\Method\Vacimbniaga\Payment as VacimbniagaPayment;
use \Duitku\V2\Helper\DuitkuConstants;

class ConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * @var string
     */
    protected $methodCode = VacimbniagaPayment::METHOD_CODE;

    /**
     * @var Object
     */
    protected $_vacimbniagaMethod;

    /**
     * @var \Magento\Payment\Helper\Data
     */
    protected $_paymentHelper;

    /**
     * Config Provider
     *
     * @param \Magento\Payment\Helper\Data $paymentHelper
     */
    public function __construct(
        \Magento\Payment\Helper\Data $paymentHelper
    ) {
        $this->_paymentHelper = $paymentHelper;
        $this->_vacimbniagaMethod = $this->_paymentHelper->getMethodInstance($this->methodCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'payment' => [
                 $this->methodCode => [
                    'paymentTitle' => $this->_vacimbniagaMethod->getConfigData(DuitkuConstants::TITLE),
                    'checkoutUrl'=> $this->_vacimbniagaMethod->getCheckoutUrl(),
                    'cancelUrl'=> $this->_vacimbniagaMethod->getCancelUrl()
                ]
            ]
        ];

        return $config;
    }
    
}
