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

	$sql = "CREATE VIEW EDGARS_MATCH AS SELECT * FROM EDGARS INNER JOIN LIST USING (ITEM)";
	
	$ret = pg_query($db, $sql);	
	checkError($db, $ret, "View created successfully\n");

	$sql = "CREATE VIEW WOOLWORTHS_MATCH AS SELECT * FROM WOOLWORTHS INNER JOIN LIST USING (ITEM)";
	
	$ret = pg_query($db, $sql);	
	checkError($db, $ret, "View created successfully\n");

	$sql = "CREATE VIEW ALL_OPTIONS AS SELECT * FROM EDGARS_MATCH CROSS JOIN WOOLWORTHS_MATCH";
	
	$ret = pg_query($db, $sql);	
	checkError($db, $ret, "View created successfully\n");
?>