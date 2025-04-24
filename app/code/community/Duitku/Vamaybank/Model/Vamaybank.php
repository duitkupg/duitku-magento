<?php

class Duitku_Vamaybank_Model_Vamaybank extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vamaybank';
	protected $_formBlockType = 'vamaybank/form_vamaybank';
	protected $_infoBlockType = 'vamaybank/info_vamaybank';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vamaybank/payment/process', array('_secure' => true));
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
