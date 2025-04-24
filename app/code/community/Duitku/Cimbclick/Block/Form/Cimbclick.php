<?php
class Duitku_Cimbclick_Block_Form_Cimbclick extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('cimbclick/form/cimbclick.phtml');
  }
}