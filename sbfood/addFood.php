<?php
header("content-type:text/javascript;charset=utf-8");
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
$link = mysqli_connect('blissinterthai.co.th', 'cp496355_sombatb', 'batman20', "cp496355_inventory");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    
    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
	}

if (isset($_GET)) {
	if ($_GET['isAdd'] == 'true') {
				
		$idShop = $_GET['idShop'];
		$NameFood = $_GET['NameFood'];
		$PathImage = $_GET['PathImage'];
		$Price = $_GET['Price'];
		$Detail = $_GET['Detail'];

		$sql = "INSERT INTO `foodtable`(`id`, `idShop`, `NameFood`, `PathImage`, `Price`, `Detail`) VALUES (null, '$idShop', '$NameFood', '$PathImage', '$Price', '$Detail')";

		$result = mysqli_query($link, $sql);

		if ($result) {
			echo "true";
		} else {
			echo "false";
		}

	} else echo "Welcome SOMBAT Food";
   
}
	mysqli_close($link);
?>