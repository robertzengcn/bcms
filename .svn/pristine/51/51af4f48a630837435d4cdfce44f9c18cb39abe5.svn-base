<?php
class JSSDK {
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
		$abspath = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
		$ticketurl = $abspath.'/weixindb/jsapi_ticket_'.$this->appId.'.json';
		if(file_exists($ticketurl)){
			$data = json_decode(file_get_contents($ticketurl));	
			if($data->expire_time < time()){
				  $accessToken = $this->getAccessToken();   
				  $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
				  $res = json_decode($this->httpGet($url));
				  $ticket = $res->ticket;
				$data->expire_time = time() + 7000;
				$data->jsapi_ticket = $ticket;
				$fp = fopen($ticketurl, "w");
				fwrite($fp, json_encode($data));
				fclose($fp);				
			}else{
				$ticket = $data->jsapi_ticket;			
			}
			
		}else{
			  $accessToken = $this->getAccessToken();   
			  $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
			  $res = json_decode($this->httpGet($url));
			  $ticket = $res->ticket;
			$data1=array('expire_time'=>time() + 7000,'jsapi_ticket'=>$ticket);
			file_put_contents($ticketurl, json_encode($data1));
		}


    return $ticket;
  }

  private function getAccessToken() {
 	$abspath = rtrim ( $_SERVER ['DOCUMENT_ROOT'], '/' );
	$tokenurl = $abspath.'/weixindb/access_token_'.$this->appId.'.json';
	if(file_exists($tokenurl)){
		$data = json_decode(file_get_contents($tokenurl));
		if($data->expire_time < time()){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
			$result = json_decode($this->httpGet($url));
			$access_token = $result->access_token;
			if ($access_token) {
				$data->expire_time = time() + 7000;
				$data->access_token = $access_token;
				$fp = fopen($tokenurl, "w");
				fwrite($fp, json_encode($data));
				fclose($fp);
			}			
		}else{
			$access_token = $data->access_token;		
		}
	}else{
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
			$result = json_decode($this->httpGet($url));
			$access_token = $result->access_token;
			$data1=array('expire_time'=>time() + 7000,'access_token'=>$access_token);
			file_put_contents($tokenurl, json_encode($data1));	
	}
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
}