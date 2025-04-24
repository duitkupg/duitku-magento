<?php

class Duitku_Ovo_Model_Ovo extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'ovo';
	protected $_formBlockType = 'ovo/form_ovo';
	protected $_infoBlockType = 'ovo/info_ovo';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('ovo/payment/process', array('_secure' => true));
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
