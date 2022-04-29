<?php
class LinePay {
	var $channelId;
	var $channelSecret;

	function paymentsRequest($data) {
		//$url = "https://sandbox-api-pay.line.me/v2/payments/request";
		$url = "https://api-pay.line.me/v2/payments/request";
		return $this->_sendData($url, $data);
	}

	function paymentsConfirm($transactionId, $data) {
		//$url = "https://sandbox-api-pay.line.me/v2/payments/{$transactionId}/confirm";
		$url = "https://api-pay.line.me/v2/payments/{$transactionId}/confirm";
		return $this->_sendData($url, $data);
	}

	function paymentsCapture($transactionId, $data) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/authorizations/{$transactionId}/capture";
		return $this->_sendData($url, $data);
	}

	function paymentsVoid($transactionId, $data) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/authorizations/{$transactionId}/void";
		return $this->_sendData($url, $data);
	}

	function authorizationDetails($transactionId) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/authorizations?transactionId=$transactionId";
		return $this->_sendDataByGet($url, array());
	}

	function paymentsDetails($transactionId) {
		$url = "https://sandbox-api-pay.line.me/v2/payments?transactionId=$transactionId";
		return $this->_sendDataByGet($url, array());
	}

	function refundPayment($transactionId, $data) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/{$transactionId}/refund";
		return $this->_sendData($url, $data);
	}

	function checkRegKeyStatus($regKey) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/preapprovedPay/{$regKey}/check";
		return $this->_sendDataByGet($url, array());
	}

	function preapprovedPayment($regKey, $data) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/preapprovedPay/{$regKey}/payment";
		return $this->_sendData($url, $data);
	}

	function expireRegKey($regKey) {
		$url = "https://sandbox-api-pay.line.me/v2/payments/preapprovedPay/{$regKey}/expire";
		return $this->_sendData($url, array());
	}

	function _sendData($url, $data) {
	    
		//echo "$url<br/>";
		$header = array(
			'Content-Type: application/json; charset=UTF-8',
			'X-LINE-ChannelId:' . $this->channelId,
			'X-LINE-ChannelSecret:' . $this->channelSecret
		);

		
		//echo "<h1>Header</h1/>";
		//print_r($header);
		//echo "<br/>";
		//echo "<h1>Data</h1/>";
		//print_r($data);
		//echo "<br/>";
        
		
		$content = json_encode($data);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
		return curl_exec($curl);
	}

	function _sendDataByGet($url, $data) {
	    
		//echo "$url<br/>";
		$header = array(
			'Content-Type: application/json; charset=UTF-8',
			'X-LINE-ChannelId:' . $this->channelId,
			'X-LINE-ChannelSecret:' . $this->channelSecret
		);

		//echo "<h1>Header</h1/>";
		//print_r($header);
		//echo "<br/>";
		//echo "<h1>Data</h1/>";
		//print_r($data);
		//echo "<br/>";
		

		//$content = json_encode($data);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		return curl_exec($curl);
	}
}
?>
