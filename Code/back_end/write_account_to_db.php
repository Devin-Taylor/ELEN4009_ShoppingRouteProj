<?php
$db = pg_connect("host=localhost port=5432 dbname=srrec user=postgres password=srrec");  
$query = "INSERT INTO accounts VALUES ('$_POST[fullname]','$_POST[password]',  
'$_POST[email]')";  
$result = pg_query($query);   
?> 