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
				
		$idUser = $_GET['idUser'];

		$result = mysqli_query($link, "SELECT * FROM order_table WHERE idUser = '$idUser'");

		if ($result) {

			while($row=mysqli_fetch_assoc($result)){
			$output[]=$row;

			}	// while

			echo json_encode($output);

		} //if

	} else echo "Welcome Sombat Food";	// if2
   
}	// if1


	mysqli_close($link);
?>