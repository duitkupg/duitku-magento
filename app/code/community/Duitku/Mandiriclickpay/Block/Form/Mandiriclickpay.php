<?php
class Duitku_Mandiriclickpay_Block_Form_Mandiriclickpay extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('mandiriclickpay/form/mandiriclickpay.phtml');
  }
}