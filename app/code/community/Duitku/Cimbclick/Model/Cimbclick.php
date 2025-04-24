<?php

class Duitku_Cimbclick_Model_Cimbclick extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'cimbclick';
	protected $_formBlockType = 'cimbclick/form_cimbclick';
	protected $_infoBlockType = 'cimbclick/info_cimbclick';
	
    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('cimbclick/payment/process', array('_secure' => true));
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

}
