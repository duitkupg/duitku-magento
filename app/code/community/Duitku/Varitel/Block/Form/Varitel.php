<?php
class Duitku_Varitel_Block_Form_Varitel extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('varitel/form/varitel.phtml');
  }
}