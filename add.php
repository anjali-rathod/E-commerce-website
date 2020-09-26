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
 ?>
<?php require_once('includes/head_section.php') ?>
	<title>Srika | Account </title>
</head>
<body>
	<?php
    $h=$_SESSION["logged_in"];
        if($h=='pass' && $_SESSION["admin"]=="yes")
        {

      ?>
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
				<a class="acc" href="soapinfo.php">Update Soaps Information<br></a>
				 <a class="acc" href="personal.php">Update Personal Information</a>
				 <a class="acc" href="account.php">Back</a>
				<a class="acc" href="logout.php">LOGOUT</a>
			</div>
		</div>

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title"> New Soap Entry</h2>

			<hr>
			<?php	
				 entry();
			?>
		</div>
		<!-- // Page content -->

		<!-- footer -->
<?php include('includes/footer.php') ?>
<?php
       }
      else {
        header("LOCATION: index.php ");
      }
  ?>