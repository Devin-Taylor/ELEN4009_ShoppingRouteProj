<?php
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

   function checkError($db, $ret, $string){
		if(!$ret){
	      echo pg_last_error($db);
	   } else {
	      echo $string;
	   }
	}

	$array = pg_copy_to($db, "LIST");

	for($i = 0; $i < 6; $i++){

		$sql =<<<EOF
   		CREATE TABLE $array[$i]
   		(SHOP CHAR(300) NOT NULL,
   		PRICE CHAR(20) NOT NULL);
EOF;
		$ret = pg_query($db, $sql);
		checkError($db, $ret, "created successfully\n");
		$item = (string)$array[$i];
		$it = trim($item);
		$params = array($it);
		$ret = pg_query_params($db, "INSERT INTO $array[$i] SELECT shop, price FROM EDGARS where ITEM = $1", $params);
		$ret = pg_query_params($db, "INSERT INTO $array[$i] SELECT shop, price FROM WOOLWORTHS where ITEM = $1", $params);
		$ret = pg_query_params($db, "INSERT INTO $array[$i] SELECT shop, price FROM MAKRO where ITEM = $1", $params);
		checkError($db, $ret, "added woolworths successfully\n");

	}

	$sql = "CREATE TABLE MATCHES AS SELECT milk.shop AS m_shop, shirt.shop AS s_shop, tv.shop AS t_shop, coalesce(milk.price::float) + coalesce(shirt.price::float) + coalesce(tv.price::float) AS total_price FROM milk CROSS JOIN shirt CROSS JOIN tv";

	$ret = pg_query($db, $sql);

	// get the locations of the stores

	



?>