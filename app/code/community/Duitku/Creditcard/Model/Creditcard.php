<?php

class Duitku_Creditcard_Model_Creditcard extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'creditcard';
	protected $_formBlockType = 'creditcard/form_creditcard';
	protected $_infoBlockType = 'creditcard/info_creditcard';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('creditcard/payment/process', array('_secure' => true));
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
