
<?php require_once('includes/head_section.php') ?>
	<title>Srika | Forgot Password </title>
</head>
<body>
	
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include('includes/navbar.php') ?>


		<!-- banner -->
		<div class="banner">
			<div class="welcome_msg">
				<h1>Handmade Soaps</h1>
				<p> 
				   “Handmade soap can be customized any way you like with colors,<br> fragrance and the skin-loving oils and butters.” <br>
					<span>― Srika</span>
				</p>
				<a href="register.php" class="btn">Join us!</a>
			</div>
		</div>
		<!-- Page content -->
		<div class="content">
			<h2 class="content-title"> Reset Your Password Here!</h2>

			<hr>
			<div class="login_div">
				<form method="post" >
					<input type="text" name="uid" placeholder="User ID" required><br>
					<input type="email" name="email" placeholder="Email" required><br>
					<input type="password" name="upd" placeholder="New Password" required><br>
					<input type="password" name="upd1"  placeholder="Confirm Password" required><br> 
					<button class="btn" type="submit" name="login_btn">Reset Password</button>
				</form>
				<?php
					ini_set("display_errors", 1);
					error_reporting(E_ALL);
					include "db.php";
						if (isset($_POST["login_btn"]))
						{
							if ($_POST["upd"]===$_POST["upd1"])
							{
								forgot($_POST["uid"],$_POST["email"],$_POST["upd"]);
							}
							else
							{
								echo '<p id="e">Password mismatch !</p>';
							}
						}			
				?>
				
			</div>
		</div>
		<!-- // Page content -->

		<!-- footer -->
<?php include('includes/footer.php') ?>
