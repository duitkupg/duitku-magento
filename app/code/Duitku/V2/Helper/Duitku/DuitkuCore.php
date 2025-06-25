<?php

include_once('ApiRequestor.php');
class Duitku_Core {

  public static function getRedirectionUrl($baseUrl, $params)
  {
    //$payloads = array();
    //$payloads = array_replace_recursive($payloads, $params);    
    $ApiRequestor = new Duitku_ApiRequestor();
    $result =$ApiRequestor->post($baseUrl . '/api/merchant/v2/inquiry',$params);
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    /** @var \Duitku\V2\Logger\DuitkuLogger $duitkuLogger */
    $duitkuLogger = $objectManager->get(\Duitku\V2\Logger\DuitkuLogger::class);
    $duitkuLogger->addEpayInfo('Response', json_encode($result));  
    return $result->paymentUrl;
  }
  
  public static function validateTransaction($baseUrl, $merchantCode, $order_id, $reference, $apikey)
  {

        $url = $baseUrl . '/api/merchant/transactionStatus';                        

        //generate Signature
        $signature = hash("md5",$merchantCode . $order_id . $apikey);

        // Prepare Parameters
        $params = array(
          'merchantCode' => $merchantCode, // API Key Merchant /
          'merchantOrderId' => $order_id,
          'signature' => $signature,
          'reference' => $reference,
        );

        //throw error if failed
        $result = Duitku_ApiRequestor::post($url,$params);    

		if ($result->statusCode == "00")			
			return true;
		else
			return false;	        
  }
}