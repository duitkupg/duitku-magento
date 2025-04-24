<?php
class Duitku_Vamandiri_Block_Form_Vamandiri extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vamandiri/form/vamandiri.phtml');
  }
}