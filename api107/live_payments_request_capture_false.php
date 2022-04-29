<h1>Payments Request</h1>

<?php
include('inc/live_line_pay.lib.php');
$lp = new LinePay();
$lp->channelId = "1435042280";
$lp->channelSecret = "0fc84c5b5efc2fd47130cd97a9d6c4bf";

$serverName = $_SERVER["SERVER_NAME"];
$serverPort = $_SERVER["SERVER_PORT"];
$url = dirname("http://" . $serverName . ":" . $serverPort . $_SERVER["REQUEST_URI"]);

$orderId = date("YmdHis");
$data = array(
	"productName" => "Cony Doll",
	"productImageUrl" => $url . "/img/product.png",
	"amount" => 1,
	"currency" => "THB",
	"orderId" => $orderId,
	"confirmUrl" => $url . "/page_confirm.php",
	"cancelUrl" => $url . "/page_cancel.php",
	"capture" => "true",
	"confirmUrlType" => "CLIENT"
);

$result = $lp->paymentsRequest($data);
$response = json_decode($result, true);

$returnCode = $response['returnCode'];
$transactionId = $response['info']['transactionId'];
$web = $response['info']['paymentUrl']['web'];
$app = $response['info']['paymentUrl']['app'];

echo "<h1>Response</h1>";

echo "returnCode = $returnCode<br/>";
echo "transactionId = $transactionId<br/>";
echo "web = <a href='$web'>$web</a><br/>";
echo "app = <a href='$app'>$app</a><br/><br/>";

print_r($response);
?>
