<?php
class Duitku_Vaatmbersama_Block_Form_Vaatmbersama extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('vaatmbersama/form/vaatmbersama.phtml');
  }
}