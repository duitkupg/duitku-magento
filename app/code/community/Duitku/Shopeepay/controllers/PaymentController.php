<?php

/**
 * Duitku Virtual Account Payment controller
 *
 * @category   Mage
 * @package    Duitku_Shopeepay_PaymentController
 * @author     Arieyann (ari@chakratechnology.com), Timur Pratama Wiradarma (timur@chakatechnology.com)
 * This class is used for handle redirection after placing order.
 * function processAction -> redirecting to Duitku Payment Web
 * function notifyAction -> when payment at Duitku is completed
 */


require_once(Mage::getBaseDir('lib') . '/duitku-php/Duitku.php');

class Duitku_Shopeepay_PaymentController extends Mage_Core_Controller_Front_Action {

    public function processAction() {
        $model = Mage::getModel('shopeepay/shopeepay');
		
		$order_id = $model->getCheckout()->getLastRealOrderId();
        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        $amount = round($order->getGrandTotal(), 2);
		$merchantcode = $model->getMerchantCode();
        $apikey = $model->getApiKey();
        $apiurl = $model->getApiURL();
		$duitkuexpired = $model->getDuitkuExpired();
		
		$baseUrl = Mage::getBaseUrl();

        //get billing order info
        $order_billing_address = $order->getBillingAddress();
        $merchantUserInfo = $order_billing_address->getFirstname() . " " . $order_billing_address->getLastname();
		$email = $order->getCustomerEmail();
		
		//ItemDetails
		$itemsData = $order->getAllItems();
		$shippingAmountData = $order->getShippingAmount();
		$shippingTaxAmountData = $order->getShippingTaxAmount();
		$taxAmountData = $order->getTaxAmount();
		$DiscountAmount = $order->getDiscountAmount();
	
		$itemDetailParams = array();
		foreach ($itemsData as $value) {
			
		  $ItemPrice = (int)$value->getPrice() * (int)$value->getQtyOrdered();
		  
		  $item = array(
			'name' => $this->repString($this->getName($value->getName())),
			'price' => (int)$ItemPrice,
			'quantity' => (int)$value->getQtyOrdered(),
		  );
		  $itemDetailParams[] = $item;
		}

		if ($shippingAmountData > 0) {
		  $shippingItem = array(
			'name' => 'Shipping Amount',
			'price' => (int)$shippingAmountData,
			'quantity' => 1
		  );
		  $itemDetailParams[] = $shippingItem;
		}

		if ($shippingTaxAmountData > 0) {
		  $shippingTaxItem = array(
			'name' => 'Shipping Tax',
			'price' => (int)$shippingTaxAmountData,
			'quantity' => 1
		  );
		  $itemDetailParams[] = $shippingTaxItem;
		}

		if ($taxAmountData > 0) {
		  $taxItem = array(
			'name' => 'Tax',
			'price' => (int)$taxAmountData,
			'quantity' => 1
		  );
		  $itemDetailParams[] = $taxItem;
		}
		
		if ($DiscountAmount != 0) {
		  $couponItem = array(
			  'id' => 'DISCOUNT',
			  'price' => (int)$DiscountAmount,
			  'quantity' => 1,
			  'name' => 'DISCOUNT'
			);
		  $itemDetailParams[] = $couponItem;
		}

		$paymentAmount = 0;
		foreach ($itemDetailParams as $item) {
		  $paymentAmount += $item['price'];
		}
	
		$billing_address = array(
		  'firstName' => $order->getCustomerFirstname(),
		  'lastName' => $order->getCustomerLastname(),
		  'address' => $order->getBillingAddress()->getStreet()[0],
		  'city' => $order->getBillingAddress()->getCity(),
		  'postalCode' => $order->getBillingAddress()->getPostcode(),
		  'phone' => $order->getBillingAddress()->getTelephone(),
		  'countryCode' => $order->getBillingAddress()->getCountryId(),
		);
		
		$customerDetails = array(
			'firstName' => $order->getCustomerFirstname(),
			'lastName' => $order->getCustomerLastname(),
			'email' => $email,
			'phoneNumber' => $order->getBillingAddress()->getTelephone(),
			'billingAddress' => $billing_address,
			'shippingAddress' => $billing_address
		);
				
		$signature = md5($merchantcode.$order_id.$paymentAmount.$apikey);
		
        // Prepare Parameters
		 $params = array(
             'merchantCode' => $merchantcode,
             'paymentAmount' => $amount,
             'paymentMethod' => 'SP',
			 'merchantOrderId' =>$order_id,
             'productDetails' => 'Order : ' . $order_id,
             'additionalParam' => '',
             'merchantUserInfo' => $merchantUserInfo,
			 'customerVaName' => $merchantUserInfo,
			 'email' => $email,
             'callbackUrl' => $baseUrl . 'shopeepay/payment/notify',
             'returnUrl' => $baseUrl . 'shopeepay/payment/return',
             'signature' => $signature,
			 'expiryPeriod' => $duitkuexpired,
			 'customerDetail' => $customerDetails,
			 'itemDetails' => $itemDetailParams
         );

        try {     
			Mage::log(json_encode($params), null, 'duitku.log', true);
			     
            $redirUrl = DuitkuCore_Web::getRedirectionUrl($apiurl, $params);
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
        $order_id = Mage::getModel('shopeepay/shopeepay')->getCheckout()->getLastRealOrderId();
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
            //$order->setState(Mage_Sales_Model_Order::STATE_CANCELED, true);            
            Mage::getSingleton('core/session')->addError(__('Transaction is rejected please try again or contact administrator.'));                        
            $order->cancel();
            $order->save();                        
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

        $model = Mage::getModel('shopeepay/shopeepay');            
        $merchant_code = $model->getMerchantCode();
        $api_key = $model->getApiKey();
        $endpoint = $model->getApiURL();

        //check if order id is in the database
        if ($order) {        
            if ($status == '00' && DuitkuCore_Web::validateTransaction($endpoint, $merchant_code, $order_id, $reference, $api_key)) {
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
	
	private function repString($str) {
		return preg_replace("/[^a-zA-Z0-9]+/", " ", $str);
	}

	private function getName($s) {
		$max_length = 20;
		if (strlen($s) > $max_length) {
		  $offset = ($max_length - 3) - strlen($s);
		  $s = substr($s, 0, strrpos($s, ' ', $offset));
		}
		return $s;
	}
}
