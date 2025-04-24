<?php
class Duitku_Indodana_Block_Form_Indodana extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('indodana/form/indodana.phtml');
  }
}