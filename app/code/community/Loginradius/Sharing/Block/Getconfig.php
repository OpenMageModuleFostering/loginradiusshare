<?php
class Loginradius_Sharing_Block_Getconfig extends Mage_Core_Block_Template
{
	protected function _construct(){
        parent::_construct();
		if( $this->horizontalShareEnable() == "1" || $this->verticalShareEnable() == "1" ){
        	$this->setTemplate('sharing/socialshare.phtml');
    	}
	}
	public function _prepareLayout(){
		return parent::_prepareLayout();
    }
    public function getSharing(){ 
        if (!$this->hasData('sharing')) {
            $this->setData('sharing', Mage::registry('sharing'));
        }
        return $this->getData('sharing');
    }
	public function user_is_already_login() {
	   if( Mage::getSingleton('customer/session')->isLoggedIn() ){
		 return true;
	   }
	   return false;
    }
	public function getApikey(){
       return Mage::getStoreConfig('sharing_options/messages/appid');
    }
	public function horizontalShareEnable(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/horizontalShareEnable');
	  }
	  public function verticalShareEnable(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalShareEnable');
	  }
	  public function horizontalShareProduct(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/horizontalShareProduct');
	  }
	  public function verticalShareProduct(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalShareProduct');
	  }
	  public function horizontalShareSuccess(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/horizontalShareSuccess');
	  }
	  public function verticalShareSuccess(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalShareSuccess');
	  }
	  public function sharingTitle(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/sharingTitle');
	  }
	  public function horizontalSharingTheme(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/horizontalSharingTheme');
	  }
	  public function verticalSharingTheme(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalSharingTheme');
	  }
	  public function verticalAlignment(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalAlignment');
	  }
	  public function offset(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/offset');
	  }
	  public function horizontalSharingProviders(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/horizontalSharingProvidersHidden');
	  }
	  public function verticalSharingProviders(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalSharingProvidersHidden');
	  }
	  public function horizontalCounterProviders(){
    	return Mage::getStoreConfig('sharing_options/horizontalSharing/horizontalCounterProvidersHidden');
	  }
	  public function verticalCounterProviders(){
    	return Mage::getStoreConfig('sharing_options/verticalSharing/verticalCounterProvidersHidden');
	  }
	  public function getApiResult($ApiKey, $ApiSecrete) 
	  { 
	    if ( !empty($ApiKey) && !empty($ApiSecrete) && preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/i', $ApiKey) && preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/i', $ApiSecrete) ) {
		  return true;
		}
		else {
		   return false;
		}
      }
	    /** 
		 * Check if CURL/FSOCKOPEN are working. 
		 */	 
		public function login_radius_check_connection($method){
			$ValidateUrl = "https://hub.loginradius.com/ping/ApiKey/ApiSecrete";
			$JsonResponse = $this->loginradius_call_api($ValidateUrl, $method);
			$UserAuth = json_decode($JsonResponse);
			if(isset($UserAuth->ok)){
				return "ok";
			}elseif($JsonResponse == "service connection timeout"){
				return "service connection timeout";
			}elseif($JsonResponse == "timeout"){
				return "timeout";
			}else{
				return "connection error";
			}
		}
		/** 
		 * Login/register user to LR. 
		 */	 
		public function login_radius_lr_login($ValidateUrl, $method){ 
			$JsonResponse = $this->loginradius_call_api($ValidateUrl, $method, true);
			$response = json_decode($JsonResponse);
			return $response;
		}
      public function loginradius_call_api($ValidateUrl, $method = "", $post = false){
	   	if($method == "curl"){
			$curl_handle = curl_init(); 
			curl_setopt($curl_handle, CURLOPT_URL, $ValidateUrl); 
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 8);
			curl_setopt($curl_handle, CURLOPT_TIMEOUT, 8);
			if($post){
				curl_setopt($curl_handle, CURLOPT_POST, 1);
				curl_setopt($curl_handle, CURLOPT_POSTFIELDS, '');
			}
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false); 
			if(ini_get('open_basedir') == '' && (ini_get('safe_mode') == 'Off' or !ini_get('safe_mode'))){
				curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1); 
				curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true); 
			}else{
				curl_setopt($curl_handle, CURLOPT_HEADER, 1); 
				$url = curl_getinfo($curl_handle, CURLINFO_EFFECTIVE_URL);
				curl_close($curl_handle);
				$curl_handle = curl_init(); 
				$url = str_replace('?','/?',$url); 
				curl_setopt($curl_handle, CURLOPT_URL, $url); 
				curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
			}
			$JsonResponse = curl_exec($curl_handle); 
			$httpCode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
			if(in_array($httpCode, array(400, 401, 404, 500, 503)) && $httpCode != 200){
				return "service connection timeout";
			}else{
				if(curl_errno($curl_handle) == 28){
					return "timeout";
				}
			}
			curl_close($curl_handle);
		}else{
			if($post){
				$postdata = http_build_query(
					array(
						'var1' => 'val'
					)
				);
				$options = array('http' =>
					array(
						'method'  => 'POST',
						'timeout' => 10,
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => $postdata,
						'ignore_errors' => true
					)
				);
				$context  = stream_context_create($options);
			}else{
				$context = NULL;
			}
			$JsonResponse = file_get_contents($ValidateUrl, false, $context);
			if(strpos(@$http_response_header[0], "400") !== false || strpos(@$http_response_header[0], "401") !== false || strpos(@$http_response_header[0], "404") !== false || strpos(@$http_response_header[0], "500") !== false || strpos(@$http_response_header[0], "503") !== false){
				return "service connection timeout";
			}
		}
		//echo $JsonResponse; die;
		return $JsonResponse; 
      }
}