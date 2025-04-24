<?php

class Duitku_Indosatdompetku_Model_Indosatdompetku extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'indosatdompetku';
	protected $_formBlockType = 'indosatdompetku/form_indosatdompetku';
	protected $_infoBlockType = 'indosatdompetku/info_indosatdompetku';
	
    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('indosatdompetku/payment/process', array('_secure' => true));
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
