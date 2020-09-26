<?php 
session_start();
require_once('includes/head_section.php') ;
if (isset($_SESSION['uid']))
{
	header("LOCATION: account.php");
}
?>
	<title>Your Blog | Sign Up </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include('includes/navbar.php') ?>

		<div class="banner">
			<div class="welcome_msg">
				<h1>Handmade Soaps</h1>
				<p> 
				   “Handmade soap can be customized any way you like with colors,<br> fragrance and the skin-loving oils and butters.”<br>
					<span> – Srika</span>
				</p>
				<a href="register.php" class="btn">Join us!</a>
			</div>
			<br>
		</div>
		<!-- Page content -->
		<div class="content">
			<div class="login_div">
				<form method="post" >
					<h2>Sign Up</h2><hr>
					<input type="text" name="name" placeholder="Full Name" required><br>
					<input type="email" name="email" placeholder="Email" required><br>
					<input type="text" name="uid" placeholder="Username" required><br>
					<input type="password" name="upd"  placeholder="Password" required><br> 
					<input type="number" name="phno"  placeholder="Phone Number" required><br> 
					<textarea name="address"  placeholder="Address" class="content_textarea" required></textarea><br> 
					<button class="btn" type="submit" name="login_btn">Sign up</button>
				</form>
				<?php
							ini_set("display_errors", 1);
							error_reporting(E_ALL);
							include "db.php";
							if (isset($_POST["login_btn"]))
							{
								sign_up($_POST["name"],$_POST["email"],$_POST["uid"],$_POST["upd"],$_POST["phno"],$_POST["address"]);
							}
				?>
				
			</div>
		</div>
		<!-- // Page content -->

		<!-- footer -->
<?php include('includes/footer.php') ?>