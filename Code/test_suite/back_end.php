<?php

	// test 1 - establishing database connection
	$host 			= "host = localhost";
	$port 			= "port = 5432";
	$dbname 		= "dbname = srrec";
	$credentials 	= "user=postgres password=srrec";

	$db = pg_connect("$host $port $dbname $credentials");
   if(!$db){
      echo "TEST: unable to establish connection with $dbname\n";
   } else {
      echo "TEST: successfully established connection with $dbname\n";
   }
   pg_close($db);

   	// test 2 - creating table
   	$host 			= "host = localhost";
	$port 			= "port = 5432";
	$dbname 		= "dbname = srrec";
	$credentials 	= "user=postgres password=srrec";

	$db = pg_connect("$host $port $dbname $credentials");

   $table = "TEST_TABLE";

  	$sql =<<<EOF
	  CREATE TABLE $table
	  (SHOP CHAR(50) NOT NULL,
	  ITEM CHAR(50) NOT NULL,
	  PRICE FLOAT NOT NULL);
EOF;
	
	$ret = pg_query($db, $sql);
	if(!$ret){
		echo "TEST: could not create the table\n";
	} else {
		echo "TEST: table created successfully\n";
	}
   	pg_close($db);

   	// test 3 - edditing database
   	$host 			= "host = localhost";
	$port 			= "port = 5432";
	$dbname 		= "dbname = srrec";
	$credentials 	= "user=postgres password=srrec";

	$db = pg_connect("$host $port $dbname $credentials");

 	$sql = "INSERT INTO TEST_TABLE VALUES ('test', 'test_item', 20.00)";

   	$ret = pg_query($db, $sql);
  	if(!$ret){
		echo "TEST: could not edit TEST_TABLE\n";
	} else {
		echo "TEST: successfully added to TEST_TABLE\n";
	}
   	pg_close($db);
?>