<?php
	session_start();
	include('db.php') ;
	if (isset($_COOKIE["uid"]))
	{
		$_SESSION["logged_in"]="pass";
		$_SESSION["uid"]=$_COOKIE["uid"];
		$_SESSION["admin"]=$_COOKIE["admin"];
		$_SESSION["uno"]=uno($_SESSION["uid"]);
	}
	if((isset($_SESSION["logged_in"]))&&($_SESSION["logged_in"]=='pass'))
	{
				header("LOCATION: account.php");

	}	
	else
	{
?>
<?php require_once('includes/head_section.php') ?>
	<title>Srika | Home </title>
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
			<div class="login_div">
				<form action="index.php" method="post" >
					<h2>Login</h2>
					<br>
					<?php

						if(isset($_SESSION["error"]))
						{
							echo('<p id="e">'.$_SESSION["error"]."</p>\n");
							unset($_SESSION["error"]);
						}
						if(isset($_SESSION["success"]))
						{
							echo('<p id="g">'.$_SESSION["success"]."</p>\n");
							unset($_SESSION["success"]);
						}
					?>
					<input type="text" name="uid" placeholder="Username" required><br>
					<input type="password" name="upd"  placeholder="Password" required><br> 
					<label><b>Remember me </b></label><input type="checkbox" name="remember" id="remember"/>
					<button class="btn" type="submit" name="login_btn">Sign in</button>
				</form>
				<?php
					ini_set("display_errors", 1);
					error_reporting(E_ALL);

					if (isset($_POST['uid']) && isset($_POST['upd']))
					{
						$row=login($_POST['uid'],$_POST['upd']);
						if ($row === false)
						{
							$_SESSION["error"]="Incorrect password.";
							header("LOCATION: index.php");
						}
						else
						{
							$_SESSION["uid"]=$_POST['uid'];
							$_SESSION["admin"]=admin($_SESSION["uid"]);
							$_SESSION["uno"]=uno($_SESSION["uid"]);
							$_SESSION["success"]="Login success";
							$_SESSION["logged_in"]="pass";
							if (!empty($_POST['remember']))
							{
								setcookie ("uid", $_POST['uid'], time()+ (10 * 365 * 24 * 60 * 60));
								setcookie ("admin", $_POST['admin'], time()+ (10 * 365 * 24 * 60 * 60));
							}
							header("LOCATION: account.php");
						}
					}
				?>

			</div>
		</div>

		<!-- Page content -->
		<div class="content">
		<section id="soap">
			<img src="static/images/soap1.jpg">
			<p>
				All-natural handmade soaps created with 100% pure simple ingredients.<br> A pleasure to use. They leave your skin feeling clean, <br>smelling great, smooth, silky soft, radiantly healthy! 
			</p>
		</section><hr>
		<section id="price">
			<div id="p1">
				<h3>Lavender Goat Milk</h3>
				<h5>Lavender essential oil</h5>
				<h5>70rs</h5>
				<h5>Best before 6 months</h5>
			</div>
			<div id="p2">
				<h3>Aloe Vera Tea Tree</h3>
				<h5>Tea tree essential oil</h5>
				<h5>80rs</h5>
				<h5>Best before 6 months</h5>
			</div>
			<div id="p3">
				<h3>Coffee Scrub</h3>
				<h5>Coffee essential oil</h5>
				<h5>100rs</h5>
				<h5>Best before 6 months</h5>
			</div>
		</section>
	</div>
		<!-- // Page content -->

		<!-- footer -->
<?php include('includes/footer.php') ?>

<?php
	}

?>