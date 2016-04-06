<?php
	// create connection to database
	$host 			= "host = localhost";
	$port 			= "port = 5432";
	$dbname 		= "dbname = srrec";
	$credentials 	= "user=postgres password=srrec";
	$db = pg_connect("$host $port $dbname $credentials");
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }
   // generic function to check database connection errors
   function checkError($db, $ret, $string){
		if(!$ret){
	      echo pg_last_error($db);
	   } else {
	      echo $string;
	   }
	}
	// read in the shopping list values as an array from the database
	$array = pg_copy_to($db, "LIST");
	$array_size = sizeof($array);
	// iterate over all shopping list item, create table for each item, and find shops that have each item
	for($i = 0; $i < $array_size; $i++){
		// create table
		$sql =<<<EOF
   		CREATE TABLE $array[$i]
   		(SHOP CHAR(300) NOT NULL,
   		PRICE CHAR(20) NOT NULL);
EOF;
		$ret = pg_query($db, $sql);
		checkError($db, $ret, "item table created successfully\n");
		// get shopping list item into format that postgresql understand so can make query
		$item = (string)$array[$i];
		$it = trim($item);
		$params = array($it);
		// add rows to shopping list item table --> each row is a shop and the price of the item at that shop
		$ret = pg_query_params($db, "INSERT INTO $array[$i] SELECT shop, price FROM EDGARS where ITEM = $1", $params);
		$ret = pg_query_params($db, "INSERT INTO $array[$i] SELECT shop, price FROM WOOLWORTHS where ITEM = $1", $params);
		$ret = pg_query_params($db, "INSERT INTO $array[$i] SELECT shop, price FROM MAKRO where ITEM = $1", $params);
		checkError($db, $ret, "added shop to tables successfully\n");
	}

	// creates a tables which contains all possible permutations of the items in the shopping list
	$sql = "CREATE TABLE MATCHES AS SELECT milk.shop AS m_shop, shirt.shop AS s_shop, tv.shop AS t_shop, coalesce(milk.price::float) + coalesce(shirt.price::float) + coalesce(tv.price::float) AS total_price FROM milk CROSS JOIN shirt CROSS JOIN tv";
	// queries database to add table to database
	$ret = pg_query($db, $sql);
	// close the database connection
   	pg_close($db);
?>