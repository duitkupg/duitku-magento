<?php

class Duitku_Mandiriclickpay_Model_Mandiriclickpay extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'mandiriclickpay';
	protected $_formBlockType = 'mandiriclickpay/form_mandiriclickpay';
	protected $_infoBlockType = 'mandiriclickpay/info_mandiriclickpay';

    public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('mandiriclickpay/payment/process', array('_secure' => true));
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
