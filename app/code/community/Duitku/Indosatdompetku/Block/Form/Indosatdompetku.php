<?php
class Duitku_Indosatdompetku_Block_Form_Indosatdompetku extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('indosatdompetku/form/indosatdompetku.phtml');
  }
}