<?php
class Duitku_Vamaybank_Block_Form_Vamaybank extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vamaybank/form/vamaybank.phtml');
  }
}