<?php
class Duitku_Vabni_Block_Form_Vabni extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vabni/form/vabni.phtml');
  }
}