<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="robots" content="index,follow">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>SSRec - Shopping Route Recommender</title>

	<link href="../css/1140.css" rel="stylesheet" type="text/css">
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="../css/sidenav.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
	<!-- /*<style>
		select:invalid { color: gray; }
	</style>*/ -->

</head>
<body>

        <nav>
            
            <a href="#" class="nav-toggle-btn"> Menu</a>
            
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            
        </nav>


	<div class="container12">

		<header>

			<div class="row">

				<div class="column7" id="header-nav">

					<a href="http://localhost:3000"><img src="../images/logo.png" ></a>

				</div>

				<div class="column5">
					<ul>
						<li><a href="./login.htm">Login</a></li>
					</ul>
				</div>

			</div>

		</header>
		<h1 id="home"> Shopping Route Recommender</h1> <br><br>

		<form action="" method="POST">

			<div class="alert"></div>

			<div class="row">

				<div class="column6">
					<h1> Add Items</h1>
					<input type="text" class="large-fld" name="additems" value="" placeholder="item 1,item 2,item 3..."><br><br>

					<h1> Remove Items </h1>
					<input type="text" class="large-fld" name="removeitems" value="" placeholder="item 1,item 2,item 3..."><br><br>

					<h1> Load List</h1>
					<!-- Will pull data from database of the user to update this list -->
					<select name="shoppinglist" class="large-fld">
					  <option value="" disabled selected >Select</option>
					  <option value="list1">Weekly List</option>
					  <option value="list2">Standard Items</option>
					  <option value="list3">Christmas List</option>
					  <option value="list4">Hanuka List</option>
					</select>

				</div>

				<div class="row">

					<div class="column12">
							<br><br>
							<input type="submit" class="large-fld large-btn" name="genlist" value="Update List">
					</div>
				</div>

				

				<div class="column6">

					<h1> Add Location</h1>
					<input type="text" class="large-fld" name="addlocation" value="" placeholder="location..."><br><br>


					<h1> Preferred Optimisation</h1>
					<select name="optimisation" class="large-fld" required>
					  <option value="" disabled selected>Select</option>
					  <option value="opt1">Shortest Total Distance</option>
					  <option value="opt2">Least Total Costs</option>
					  <option value="opt3">Shortest Total Time</option>
					</select>


					<!-- <input type="checkbox" name="distance" value=""> Least Total Distance<br>
					<input type="checkbox" name="cost" value=""> Least Total Cost<br>
					<input type="checkbox" name="time" value=""> Least Total Time<br> -->


				</div>

			</div>
			<div class="row">

				<div class="column12">
						<br><br>
						<input type="submit" class="large-fld large-btn" name="genroute" value="Generate Route">
				</div>
			</div>

	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    
    (function() {
        
        var bodyEl = $('body'),
            navToggleBtn = bodyEl.find('.nav-toggle-btn');
        
        navToggleBtn.on('click', function(e) {
            bodyEl.toggleClass('active-nav');
            e.preventDefault();
        });
    })(); 
    
</script>

</body>
</html>

<?php

	$host 			= "host = localhost";
	$port 			= "port = 5432";
	$dbname 		= "dbname = srrec";
	$credentials 	= "user=postgres password=srrec";
	
	$conn = pg_connect("$host $port $dbname $credentials") or die ("Error : Unable to open database\n");
	// if($conn){
	// 	echo "Opened database successfully\n";
	// }

	$array = explode(',', $_POST['additems']);
	pg_copy_from($conn, "LIST", $array);

	// $array = pg_copy_to( $conn, "LIST");
	// echo "\nList read from DB: ", implode(", ", $array);

	// $item = readline("Delete item: ");
	$array = explode(',', $_POST['removeitems']);
	// echo "\nItems to be removed: ", implode(",", $array);
	for($i=0;$i < sizeof($array); $i++) {
		$ret = pg_query($conn, "DELETE FROM LIST WHERE ITEM = '$array[$i]'");
		// if(!$ret) {
		// 	echo "Error: Action not implemented!";
		// }
	}

	// $array = pg_copy_to( $conn, "LIST");
	// echo "\nNew list of items: ", implode(", ", $array);

	// $item = readline("Add item: ");
	// $ret = pg_query($conn, "INSERT INTO LIST VALUES ('$item')");

	// $array = array("milk", "pocket_pussy", "soap", "bleach", "hack_saw", "plastic_tarp", "shovel", "cable_ties", "rope");
	// echo "\nNew list of items: ", implode(", ", $array);

	// array_splice($array, 1, 1);
	// echo "\nNew list afetr splice: ", implode(", ", $array);

	// pg_copy_from($conn, "LIST", $array);

?>