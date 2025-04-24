<?php
class Duitku_Iwallet_Block_Form_Iwallet extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('iwallet/form/iwallet.phtml');
  }
}