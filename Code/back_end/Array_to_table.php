<?php

	$host 			= "host = localhost";
	$port 			= "port = 5432";
	$dbname 		= "dbname = srrec";
	$credentials 	= "user=postgres password=srrec";
	
	$conn = pg_connect("$host $port $dbname $credentials") or die ("Error : Unable to open database\n");
	if($conn){
		echo "Opened database successfully\n";
	}

	// $result = pg_query($conn, "SELECT * FROM ShoppingList")
	$dbname = "srrec";
	$array = pg_copy_to( $conn, "LIST");
	echo "\nList read from DB: ", implode(", ", $array);

	$item = readline("Delete item: ");
	$ret = pg_query($conn, "DELETE FROM LIST WHERE ITEM = '$item'");
	if(!$ret) {
		echo "Error: Action not implemented!";
	}

	// for ($i = 0; $i < sizeof($array); $i++) {
	// 	echo "Element from array: ", $array[$i];
	// 	if ($array[$i] == $item) {
	// 		echo "Item removed: ", $array[$i];
	// 		array_splice($array, $i, 1);
	// 		break;
	// 	}
	// }
	$array = pg_copy_to( $conn, "LIST");
	// $array = array_diff($array, $item);
	// unset($array[$pos]);
	echo "\nNew list of items: ", implode(", ", $array);

	$item = readline("Add item: ");
	$ret = pg_query($conn, "INSERT INTO LIST VALUES ('$item')");

	// $array = array("milk", "pocket_pussy", "soap", "bleach", "hack_saw", "plastic_tarp", "shovel", "cable_ties", "rope");
	// echo "\nNew list of items: ", implode(", ", $array);

	// array_splice($array, 1, 1);
	// echo "\nNew list afetr splice: ", implode(", ", $array);

	// pg_copy_from($conn, "LIST", $array);

?>