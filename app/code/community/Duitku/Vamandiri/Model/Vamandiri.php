<?php

class Duitku_Vamandiri_Model_Vamandiri extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vamandiri';
	protected $_formBlockType = 'vamandiri/form_vamandiri';
	protected $_infoBlockType = 'vamandiri/info_vamandiri';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vamandiri/payment/process', array('_secure' => true));
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
