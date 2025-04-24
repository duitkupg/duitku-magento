<?php

class Duitku_Vabca_Model_Vabca extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'vabca';
	protected $_formBlockType = 'vabca/form_vabca';
	protected $_infoBlockType = 'vabca/info_vabca';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('vabca/payment/process', array('_secure' => true));
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
