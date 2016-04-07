<?php
	// create database connection
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
	// get only the stores variables from the table created in database_permutations.php
   	$ret = pg_query($db, "SELECT m_shop, s_shop, t_shop FROM MATCHES");
	$num_rows = pg_num_rows($ret);
	$num_cols = pg_num_fields($ret);
	// create empty array to populate
	$allCoords = [[]];
	// iterate over all routes and get geolocation of store from database 
	// i represents a route
	// j represents a stop/waypoint on that route
	for($i = 0; $i < $num_rows; $i++){
		// get next row from table --> successive calls means next row is obtained
		$rows = pg_fetch_array($ret);
		for($j = 0; $j < $num_cols; $j++){
			// convert to correct format for postgresqp
			$item = (string)$rows[$j];
			$it = trim($item);
			$params = array($it);
			// get geolocation
			$test = pg_query_params($db, "SELECT location FROM SHOPS WHERE name = $1", $params);
			// get corresponding geolocation from database
			$temp = pg_fetch_result($test, 0, 0);
			// add location to array
			$allCoords[$i][$j] = $temp;
		}
	}
	// close the database connection
   	pg_close($db);
?>