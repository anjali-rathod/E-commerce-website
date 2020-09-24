<?php
session_start();
 require_once('includes/head_section.php'); ?>
	<title>Srika | Newsletter </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include('includes/navbar.php'); ?>

		<!-- banner -->
		<div class="banner">
			<div class="welcome_msg">
				<h1>Handmade Soaps</h1>
				<p>“Handmade soap can be customized any way you like with colors,<br> fragrance and the skin-loving oils and butters.” <br>
					<span>― Srika</span>
				</p>
			</div>
			<div class="login_div">
				<form method="post">
					
					<button class="btn" type="submit" name="subscribe">Subscribe Me</button>
				</form>
				<?php 
			if($_SESSION["logged_in"]=='pass')
			{
				include 'db.php';
				if (isset($_POST["subscribe"]))
				{
					newsletter($_SESSION["uno"]);
				}
			}
			else
			{
				echo "<div id='e'>Please Login to subscribe</div>";
			}
		?>
			</div>
		</div> 

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">All Products</h2>
			<hr>
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
		<!-- footer -->
<?php include('includes/footer.php'); ?>