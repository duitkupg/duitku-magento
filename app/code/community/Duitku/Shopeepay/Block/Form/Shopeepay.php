<?php
class Duitku_Shopeepay_Block_Form_Shopeepay extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('shopeepay/form/shopeepay.phtml');
  }
}