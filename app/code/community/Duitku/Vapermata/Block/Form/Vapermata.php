<?php
class Duitku_Vapermata_Block_Form_Vapermata extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vapermata/form/vapermata.phtml');
  }
}