<?php
  session_start();
  $h=$_SESSION["logged_in"];
    if($h=='pass')
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
				<h1>Today's Inspiration</h1>
				<p> 
				   “We have to dare to be ourselves, <br>
				   however frightening or strange that self may prove to be.”<br>
					<span>― May Sarton</span>
				</p>
			</div>
			<div class="account">
				<h2 class="acc">Hi <?php echo $_SESSION["uid"] ?> ,Your Promo code is &nbsp; <u><?php echo $_SESSION["uid"] ?></u></h2>
				<?php
				 if($_SESSION["admin"]=="yes")
				 {
				 	echo '<a class="acc" href="updateorders.php">Update Order Status</a>';
				 	echo '<a class="acc" href="add.php">Add Soap</a>';
				 	echo '<a class="acc" href="soapinfo.php">Update Soaps Information<br></a>';
				 }
				 ?>
				 <a class="acc" href="account.php">Back</a>
				<a class="acc" href="logout.php">LOGOUT</a>
			</div>
		</div>
		<div class="content">
			<h2 class="content-title"> YOUR CREDENTIALS</h2>

			<hr>
			<?php
				ini_set("display_errors", 1);
				error_reporting(E_ALL);
				 include('db.php') ;		
				 personal_info($_SESSION["uid"],$_SESSION["uno"]);
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