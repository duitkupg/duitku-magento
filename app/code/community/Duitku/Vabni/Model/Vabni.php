<?php

class Duitku_Vabni_Model_Vabni extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vabni';
	protected $_formBlockType = 'vabni/form_vabni';
	protected $_infoBlockType = 'vabni/info_vabni';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vabni/payment/process', array('_secure' => true));
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
