<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku Dana.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku Dana
 * @copyright Duitku Dana (http://duitku.com)
 * @license   Duitku Dana
 *
 */
namespace Duitku\Dana\Block\Adminhtml\System\Config\Field;

class Version extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @var \Duitku\Dana\Helper\Data
     */
    protected $_duitkuHelper;

    /**
     * Version constructor.
     * @param \Duitku\Dana\Helper\Data $duitkuHelper
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Duitku\Dana\Helper\Data $duitkuHelper,
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_duitkuHelper = $duitkuHelper;
    }

    /**
     * Retrieve the setup version of the extension
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_duitkuHelper->getModuleVersion();
    }
}
