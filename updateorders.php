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
	<title>Srika | Cart </title>
</head>
<body>
	<?php
    $h=$_SESSION["logged_in"];
        if($h=='pass')
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
				<a class="acc" href="orderplaced.php">Place order</a>
				<?php
				 if($_SESSION["admin"]=="yes")
				 {
				 	echo '<a class="acc" href="add.php">Add Soap</a>';
				 	echo '<a class="acc" href="soapinfo.php">Update Soaps Information<br></a>';
				 }
				 ?>
				 <a class="acc" href="personal.php">Update Personal Information</a>
				<a class="acc" href="logout.php">LOGOUT</a>
			</div>
		</div>

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title"> In your cart</h2>

			<hr>
			<?php	
			 ini_set("display_errors", 1);
			 error_reporting(E_ALL);
			 update_order();
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