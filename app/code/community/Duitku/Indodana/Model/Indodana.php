<?php

class Duitku_Indodana_Model_Indodana extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'indodana';
	protected $_formBlockType = 'indodana/form_indodana';
	protected $_infoBlockType = 'indodana/info_indodana';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('indodana/payment/process', array('_secure' => true));
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
