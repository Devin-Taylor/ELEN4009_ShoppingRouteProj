<?php
	// generic error check function
	function checkError($db, $ret, $string){
		if(!$ret){
	      echo pg_last_error($db);
	   } else {
	      echo $string;
	   }
	}
	
	// connect to database
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

   ////////////////////////////////////////////////////////////////
   /////////////// CREATE ALL THE RAW DATA TABLES /////////////////
   ////////////////////////////////////////////////////////////////

   $table = "ACCOUNTS";
	
   	$sql =<<<EOF
   		CREATE TABLE $table
   		(NAME CHAR(30) NOT NULL,
   		PASSWORD CHAR(20) NOT NULL,
   		EMAIL CHAR(50));
EOF;

	$ret = pg_query($db, $sql);
	checkError($db, $ret, "$table created successfully\n");

   $table = "SHOPS";

	$sql =<<<EOF
		CREATE TABLE $table
		(NAME CHAR(50) NOT NULL,
		LOCATION POINT);
EOF;
	
	$ret = pg_query($db, $sql);
	checkError($db, $ret, "$table created successfully\n");

   $table = "EDGARS";

  	$sql =<<<EOF
	  CREATE TABLE $table
	  (SHOP CHAR(50) NOT NULL,
	  ITEM CHAR(50) NOT NULL,
	  PRICE FLOAT NOT NULL);
EOF;

	$ret = pg_query($db, $sql);
	checkError($db, $ret, "$table created successfully\n");

	$table = "WOOLWORTHS";

	$sql =<<<EOF
		CREATE TABLE $table
		(SHOP CHAR(50) NOT NULL,
		ITEM CHAR(50) NOT NULL,
		PRICE FLOAT NOT NULL);
EOF;
	
	$ret = pg_query($db, $sql);
	checkError($db, $ret, "$table created successfully\n");

	$table = "MAKRO";

	$sql =<<<EOF
		CREATE TABLE $table
		(SHOP CHAR(50) NOT NULL,
		ITEM CHAR(50) NOT NULL,
		PRICE FLOAT NOT NULL);
EOF;
	
	$ret = pg_query($db, $sql);
	checkError($db, $ret, "$table created successfully\n");

	$table = "LIST";

	$sql =<<<EOF
		CREATE TABLE $table
		(ITEM CHAR(50) NOT NULL);
EOF;
	
	$ret = pg_query($db, $sql);
	checkError($db, $ret, "$table created successfully\n");

   	////////////////////////////////////////////////////////////////////
	///////// LOAD DATA FROM TEXT FILES INTO TABLES ////////////////////
	////////////////////////////////////////////////////////////////////

   $data = "COPY ACCOUNTS FROM 'accounts.txt' (DELIMITER('\t'))";

   $ret = pg_query($db, $data);
   checkError($db, $ret, "Data added\n");

   $data = "COPY SHOPS FROM 'shops.txt' (DELIMITER('\t'))";

   $ret = pg_query($db, $data);
   checkError($db, $ret, "Data added\n");

   $data = "COPY EDGARS FROM 'edgars.txt' (DELIMITER('\t'))";

   $ret = pg_query($db, $data);
   checkError($db, $ret, "Data added\n");

   $data = "COPY WOOLWORTHS FROM 'woolworths.txt' (DELIMITER('\t'))";

   $ret = pg_query($db, $data);
   checkError($db, $ret, "Data added\n");

   $data = "COPY MAKRO FROM 'makro.txt' (DELIMITER('\t'))";

   $ret = pg_query($db, $data);
   checkError($db, $ret, "Data added\n");

   $data = "COPY LIST FROM 'list.txt' (DELIMITER('\t'))";

   $ret = pg_query($db, $data);
   checkError($db, $ret, "Data added\n");
   
   // close the database connection
   pg_close($db);
?>