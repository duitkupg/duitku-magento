<?php

class Duitku_Vapermata_Model_Vapermata extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vapermata';
	protected $_formBlockType = 'vapermata/form_vapermata';
	protected $_infoBlockType = 'vapermata/info_vapermata';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vapermata/payment/process', array('_secure' => true));
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
