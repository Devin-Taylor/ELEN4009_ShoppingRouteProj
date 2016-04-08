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
						<li><a href="/login.php">Login</a></li>
					</ul>
				</div>

			</div>

		</header>
		<h1 id="home"> Shopping Route Recommender</h1> <br><br>
		<h1>Create Account</h1> <br><br>

		<form action="" method="POST">

			<div class="alert"></div>

			<div class="row">

				<div class="column6">
					<h2> Full Name</h2>
					<input type="text" class="large-fld" name="fullname" value="" required><br><br>

					<h2>Email</h2>
					<input type="text" class="large-fld" name="email" value="" required><br><br>

					<h2>Password</h2>
					<input type="password" class="large-fld" name="password" value="" required><br><br>

					<h2>Confirm password</h2>
					<input type="password" class="large-fld" name="confirm_password" value="" required><br><br>

				</div>

				<div class="column6">

					<img src="../images/captcha.png" align="middle" style="width:520px;height:200px;"><br><br style="line-height:30px;" />

					<h2>Enter the text in the image above</h2>
					
					<input type="text" class="large-fld" name="text" value=""><br><br><br style="line-height:30px;" />

					<input type="submit" class="large-fld large-btn" name="createaccount" value="Create Account">

					<?php
						if(isset($_POST['createaccount']) && !empty($_POST['fullname']) && !empty($_POST['password']) ) {
							if($_POST['password'] == $_POST['confirm_password']) {
								$db = pg_connect("host=localhost port=5432 dbname=srrec user=postgres password=srrec");  
								$query = "INSERT INTO accounts VALUES ('$_POST[fullname]','$_POST[password]', '$_POST[email]')";  
								$result = pg_query($query);
								header('Location: index.php');
							} 
							else {
								echo "Error: Passwords do not match!";
							}
							
						}
					?> 

				</div>
			</div>
		</form>
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