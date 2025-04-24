<?php

class Duitku_Vaatmbersama_Model_Vaatmbersama extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vaatmbersama';
	protected $_formBlockType = 'vaatmbersama/form_vaatmbersama';
	protected $_infoBlockType = 'vaatmbersama/info_vaatmbersama';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vaatmbersama/payment/process', array('_secure' => true));
    }

    public function getCheckout() {
        return Mage::getSingleton('checkout/session');
    }

    public function getMerchantCode() {
        return $this->getConfigData('merchantcode');
    }

    public function getApiKey() {
        return $this->getConfigData('apikey');
    }

    public function getApiURL() {
        return $this->getConfigData('apiurl');
    }
	
	public function getDuitkuExpired() {
        return $this->getConfigData('duitkuexpired');
    }

}
