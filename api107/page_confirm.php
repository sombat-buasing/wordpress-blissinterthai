PAGE CONFIRM
<?php session_start();?>
<br/>
<?php
/*$servername = "localhost";
$username = "database8005";
$password = "#password";
$dbname = "database8005";*/

$price = 1; //Edit
/*$dbhandle = mysql_connect($servername, $username, $password) or die("Unable to connect to MySQL");
$selected = mysql_select_db($dbname, $dbhandle) or die("Could not select examples");
$result = mysql_query("SELECT key_value FROM configs WHERE id = 'fixqrprice'");
while ($row = mysql_fetch_array($result)) {
   $price = $row{'key_value'} + 0;
}  //echo $price; die();*/

include('inc/live_line_pay.lib.php');
$lp = new LinePay();
$lp->channelId = "1574776573"; // Edit
$lp->channelSecret = "c5a241ea242dc1433688c0f7d05353d3";  // Edit

$transactionId = $_GET['transactionId'];
//$transactionId = "2019070191435638210";
$data = array(
	"amount" => $price,
	"currency" => "THB"
);

$result = $lp->paymentsConfirm($transactionId, $data);
//$response = json_decode($result);
//echo "<h1>Response</h1>";
//print_r($response); echo "<br>";
?>


<br/><br/>
<p align="center">&nbsp;&nbsp;

<?php 

$Today = date("Y-m-d H:i");
$LimitDate = date("d-m-Y");
$ReturnCode = json_decode($result);


if ($ReturnCode->returnCode == "0000")
{
  
    $delimiter = array(' ',',','{','}','[',']','"','"');
    $replace = str_replace($delimiter, $delimiter[0], $result);
    $orderID = explode($delimiter[0], $replace);
    if($orderID[20] !=""){$_SESSION["QRCode"]=$orderID[20];} else {$_SESSION["QRCode"]="No_OderId";}
    
    //echo json_decode(json_encode($result), True);echo "<br>";    
    //$_SESSION["QRCode"]=$orderID[20];
       
    //echo "orderId : "; echo $orderID[20]; echo "<br>";
   
    echo "Office Of Academic Resources,"; echo "<br>";
    echo "Chulalongkorn University,"; echo "<br>";   
    echo iconv( 'TIS-620', 'UTF-8', "�ѹ���-���� �ѹ�֡��¡�� : "); echo $Today; echo "<br>";
    echo iconv( 'TIS-620', 'UTF-8', "������ԡ�������ѹ��� : "); echo $LimitDate; echo iconv( 'TIS-620', 'UTF-8', "  ����  08:00 - 21:00 �."); echo "<br>";
    echo iconv( 'TIS-620', 'UTF-8', "�ӹǹ�Թ : "); echo $orderID[33];  echo iconv( 'TIS-620', 'UTF-8', " �ҷ"); echo "<br>";
    
    
    echo '<img src="https://chart.googleapis.com/chart?chs=350x350&cht=qr&chl='.$_SESSION["QRCode"].'&choe=UTF-8" title="QR Code" />'; echo "<br>";
    echo iconv( 'TIS-620', 'UTF-8', "��س� Capture ���� Save �ٻ QRCode ����� ����������͡����ش��ҧ");echo "<br>";   
    echo iconv( 'TIS-620', 'UTF-8', "Please Capture Or Save QRCode Image For Access to CU Library Service"); echo "<br>";
    //echo iconv( 'TIS-620', 'UTF-8', "�������ҡ����ҹ : "); echo $Today; echo iconv( 'TIS-620', 'UTF-8', "  ����  08:00 - 21:00 �."); echo "<br>";
    echo iconv( 'TIS-620', 'UTF-8', "�ͺ�س������ԡ��"); echo "<br>";
    session_destroy();
    
    /*
    echo '<pre>'; 
    print_r($orderID); //�ʴ� Array ��ͤ���
    echo '</pre>';
    */
    
}

else 
{   
    $Imagepath= 'CULogo.jpg';    
    echo "Error Message : "; echo $ReturnCode->returnCode;  echo " : "; echo $ReturnCode->returnMessage; echo "<br>";
    echo '<img src="'.$Imagepath.'"/>'; echo "<br>";
    echo iconv( 'TIS-620', 'UTF-8', "Please Contact Library Service."); echo "<br>";
    echo iconv( 'TIS-620', 'UTF-8', "�к� Linepay �Ѵ��ͧ ��سҵԴ������˹�ҷ������ش��ҧ"); echo "<br>";
    session_destroy();
    //echo iconv( 'TIS-620', 'UTF-8', "�������ҡ����ҹ : "); echo $Today; echo iconv( 'TIS-620', 'UTF-8', "  ����  08:00 - 21:00 �."); echo "<br>";
   
    

}
?>


</p>
