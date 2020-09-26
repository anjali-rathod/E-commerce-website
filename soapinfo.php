<?php
  session_start();
  if ($_SESSION["admin"]=="yes")
    {
 ?>
<?php require_once('includes/head_section.php') ?>
	<title>Your Blog | Account </title>
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
				  “Handmade soap can be customized any way you like with colors,<br> fragrance and the skin-loving oils and butters.”<br>
					<span>― Srika</span>
				</p>
			</div>
			<div class="account">
				<h2 class="acc">Hi <?php echo $_SESSION["uid"] ?> ,Your Promo code is &nbsp; <u><?php echo $_SESSION["uid"] ?></u></h2>
				 <a class="acc" href="personal.php">Update Personal Information</a>
				 <a class="acc" href="account.php">Back</a>
				<a class="acc" href="logout.php">LOGOUT</a>
			</div>
		</div>
		<div class="content">
			<h2 class="content-title"> All Soaps</h2>

			<hr>
			<?php
			ini_set("display_errors", 1);
				 error_reporting(E_ALL);
				 include('db.php') ;		
				 soap_info();
			?>
		</div>
		<!-- footer -->
<?php include('includes/footer.php') ?>
<?php
       }
      else {
        header("LOCATION: account.php ");
      }
  ?>