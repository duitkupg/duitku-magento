<?php
class Duitku_Vacimbniaga_Block_Form_Vacimbniaga extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vacimbniaga/form/vacimbniaga.phtml');
  }
}