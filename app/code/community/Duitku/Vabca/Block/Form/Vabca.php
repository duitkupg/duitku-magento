<?php
class Duitku_Vabca_Block_Form_Vabca extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vabca/form/vabca.phtml');
  }
}