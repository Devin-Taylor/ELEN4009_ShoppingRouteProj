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
	

</head>
<body>

	<nav>
            
            <a href="#" class="nav-toggle-btn"> Menu</a>
            
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="create_account.php">Create Account</a></li>
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
						<li><a href="/login.htm">Login</a></li>
					</ul>
				</div>

			</div>

		</header>
		<h1 id="home"> Shopping Route Recommender</h1> <br><br>
		<h1>Login or Create Account</h1> <br><br>

		<form action="" method="POST">

			<div class="alert"></div>

			<div class="row">

				<div class="column6">
					<h1>New user</h1><br><br><br><br>

					<ul>
						<h2><li>Create and save shopping lists</li></h2><br>
						<h2><li>Save your routes</li></h2><br>
						<h2><li>Manage your shopping schedule</li></h2><br>
						<h2><li>Earn rewards</li></h2>
					</ul><br><br style="line-height:28px;" />

					<!-- <a href="create_account.php"><input type="submit" class="large-fld large-btn" name="createaccount" value="Create Account"></a> -->
					<a href="create_account.php" class="large-fld large-btn">Create Account</a>

				</div>

				<div class="column6">

					<h1>Returning user</h1><br><br>

					<h2>Email address</h2>
					<input type="text" class="large-fld" name="email" value=""><br><br>

					<h2>Password</h2>
					
					<input type="password" class="large-fld" name="password" value="">
					<h4><a href="/forgot_password">(forgot your password?)</a><h4><br><br>

					<!-- <a href="index.php"><input type="submit" class="large-fld large-btn" name="login" value="Login"></a> -->
					<!-- <a href="index.php" class="large-fld large-btn">Login</a> -->
					<input type="submit" class="large-fld large-btn" name="login" value="Login">
					<?php
						if(isset($_POST['login'])){
							$db = pg_connect("host=localhost port=5432 dbname=srrec user=postgres password=srrec"); 
							$sql = "SELECT password FROM accounts WHERE email = '$_POST[email]'";
							$result = pg_query($db, $sql);
							$count = pg_num_rows($result);

							if($count == 1){
								$row = pg_fetch_row($result);
								if( str_replace(" ", "", $row[0]) == $_POST['password']) {
									header('Location: index.php');
								} else {
									echo  "Incorrect username or password";
								}
							} else {
								echo "Incorrect username or password";
							}
						}
					?>

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