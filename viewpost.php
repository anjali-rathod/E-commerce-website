<?php 
session_start();
require_once('includes/head_section.php') ?>
	<title>Srika | Soap </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include('includes/navbar.php') ?>

		<!-- Page content -->
		<div class="content">
			<?php
				ini_set("display_errors", 1);
				error_reporting(E_ALL);
				include('db.php') ;
				view_post($_GET['id']);
			?>
		</div>
		<!-- // Page content -->

		<!-- footer -->
<?php include('includes/footer.php') ?>