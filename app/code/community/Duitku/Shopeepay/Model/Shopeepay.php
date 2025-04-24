<?php

class Duitku_Shopeepay_Model_Shopeepay extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'shopeepay';
	protected $_formBlockType = 'shopeepay/form_shopeepay';
	protected $_infoBlockType = 'shopeepay/info_shopeepay';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('shopeepay/payment/process', array('_secure' => true));
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
