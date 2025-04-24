<?php

class Duitku_Vacimbniaga_Model_Vacimbniaga extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vacimbniaga';
	protected $_formBlockType = 'vacimbniaga/form_vacimbniaga';
	protected $_infoBlockType = 'vacimbniaga/info_vacimbniaga';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vacimbniaga/payment/process', array('_secure' => true));
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
