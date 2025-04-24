<?php

/**
 * Duitku Mandiri Click Payment controller
 *
 * @category   Mage
 * @package    Duitku_Mandiri_PaymentController
 * @author     Arieyann (ari@chakratechnology.com), Timur Pratama Wiradarma (timur@chakatechnology.com)
 * This class is used for handle redirection after placing order.
 * function processAction -> redirecting to Duitku Payment Web
 * function notifyAction -> when payment at Duitku VT Web is completed or
 */

require_once(Mage::getBaseDir('lib') . '/duitku-php/Duitku.php');

class Duitku_Mandiriclickpay_PaymentController extends Mage_Core_Controller_Front_Action {

    public function processAction() {
        $model = Mage::getModel('mandiriclickpay/mandiriclickpay');
        $modelduitku = Mage::getModel('iwallet/iwallet');
        
        $order_id = $model->getCheckout()->getLastRealOrderId();
        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        $amount = round($order->getGrandTotal(), 2);
        $merchantcode = $modelduitku->getMerchantCode();
        $apikey = $modelduitku->getApiKey();
        $apiurl = $modelduitku->getApiURL();
        
        $signature = md5($merchantcode.$order_id.$amount.$apikey);
        $baseUrl = Mage::getBaseUrl();

        //get billing order info
        $order_billing_address = $order->getBillingAddress();
        $merchantUserInfo = $order_billing_address->getFirstname() . " " . $order_billing_address->getLastname();

        // Prepare Parameters
         $params = array(
             'merchantCode' => $merchantcode,
             'paymentAmount' => $amount,
             'paymentMethod' => 'MY',
             'merchantOrderId' =>$order_id,
             'productDetails' => 'Order : ' . $order_id,
             'additionalParam' => '',
             'merchantUserInfo' => $merchantUserInfo,
             'callbackUrl' => $baseUrl . 'mandiriclickpay/payment/notify',
             'returnUrl' => $baseUrl . 'mandiriclickpay/payment/return',
             'signature' => $signature,
         );

        try {     
            $redirUrl = Duitku_VtWeb::getRedirectionUrl($apiurl, $params);
            $this->_redirectUrl($redirUrl);
        }
        catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            error_log($e->getMessage());
            echo $e->getMessage();
        }       
    }
      
    /*
    *   rie fungsi ini buat apa ya?
    */
    public function cartAction() {
        $session = Mage::getSingleton('checkout/session');
        if ($session->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
            if ($order->getId()) {
                $order->cancel()->save();
            }
            $quote = Mage::getModel('sales/quote')->load($order->getQuoteId());
            $quote->setIsActive(true)->save();
        }
        $this->_redirect('checkout/cart');
    }    

    private function refillCart()  {
           if(Mage::getSingleton('checkout/session')->getLastRealOrderId()){
                    if ($lastQuoteId = Mage::getSingleton('checkout/session')->getLastQuoteId()){
                            $quote = Mage::getModel('sales/quote')->load($lastQuoteId);
                            $quote->setIsActive(true)->save();
                    }                 
            } 
    }

    public function returnAction() {
        $order_id = Mage::getModel('mandiriclickpay/mandiriclickpay')->getCheckout()->getLastRealOrderId();
        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        if (isset($_GET['resultCode']) && isset($_GET['merchantOrderId']) && isset($_GET['reference']) && $_GET['resultCode'] == '00') {
            //if capture or pending or challenge or settlement, redirect to order received page
            $this->_redirect('checkout/onepage/success');            
            $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);            
            $order->save();            
          }
          else if( isset($_GET['resultCode']) && isset($_GET['merchantOrderId']) && isset($_GET['reference']) && $_GET['resultCode'] != '00') {
            //if deny, redirect to order checkout page again            
            $this->_redirect('checkout/onepage/error');
            $order->setState(Mage_Sales_Model_Order::STATE_CANCELED, true);            
            Mage::getSingleton('core/session')->addError(__('Transaction is rejected please try again or contact administrator.'));                        
            $order->cancel()->save();                        
            $this->refillCart();            
          }
          else {
            $this->refillCart();
            Mage_Core_Controller_Varien_Action::_redirect('');
          }
    }    

    public function notifyAction() {
        if (empty($_REQUEST['resultCode']) || empty($_REQUEST['merchantOrderId']) || empty($_REQUEST['reference'])) {
          throw new Exception(__('wrong query string please contact admin.', 'duitku'));
        }

        $order_id = stripslashes($_REQUEST['merchantOrderId']);
        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);

        $status = stripslashes($_REQUEST['resultCode']);
        $reference = stripslashes($_REQUEST['reference']);

        $modelduitku = Mage::getModel('iwallet/iwallet');            
        $merchant_code = $modelduitku->getMerchantCode();
        $api_key = $modelduitku->getApiKey();
        $endpoint = $modelduitku->getApiURL();

        //check if order id is in the database
        if ($order) {        
            if ($status == '00' && Duitku_VtWeb::validateTransaction($endpoint, $merchant_code, $order_id, $reference, $api_key)) {
                $invoice = $order->prepareInvoice();
                $invoice->register();
                $order->addRelatedObject($invoice);
                $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
                $order->sendNewOrderEmail();
                $order->save();
            } else {
                throw new Exception(__('the order number ' .  $order_id . ' cannot be validated.', 'duitku'));
            } 
        }        
        else {
                throw new Exception(__('the order number ' .  $order_id . ' cannot be   validated.', 'duitku'));
        }        
    }
}