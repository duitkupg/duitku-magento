<?php
class Duitku_Ovo_Block_Form_Ovo extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('ovo/form/ovo.phtml');
  }
}