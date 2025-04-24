<?php

class Duitku_Bcaklikpay_Model_Bcaklikpay extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'bcaklikpay';
	protected $_formBlockType = 'bcaklikpay/form_bcaklikpay';
	protected $_infoBlockType = 'bcaklikpay/info_bcaklikpay';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('bcaklikpay/payment/process', array('_secure' => true));
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
