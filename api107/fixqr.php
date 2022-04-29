<?php
/*$servername = "localhost";
$username = "database8005";
$password = "#password";
$dbname = "database8005";*/

$price = 1;
/*$dbhandle = mysql_connect($servername, $username, $password) or die("Unable to connect to MySQL");
$selected = mysql_select_db($dbname, $dbhandle) or die("Could not select examples");
$result = mysql_query("SELECT key_value FROM configs WHERE id = 'fixqrprice'");
while ($row = mysql_fetch_array($result)) {
   $price = $row{'key_value'} + 0;
}  //echo $price; die();*/

include('inc/live_line_pay2.lib.php');
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
	"capture" => "false",
	"confirmUrlType" => "CLIENT"
);

$result = $lp->paymentsRequest($data);
$response = json_decode($result, true);
$web = $response['info']['paymentUrl']['web'];
?>
<script>
window.location = '<?=$web?>';
</script>
