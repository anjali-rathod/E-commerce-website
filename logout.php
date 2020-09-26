<?php
  session_start();
  session_unset(); 
  session_destroy();
  setcookie ("uid", $_SESSION['uid'], time()- (10 * 365 * 24 * 60 * 60));
  setcookie ("admin", $_SESSION['admin'], time()- (10 * 365 * 24 * 60 * 60));
  header("LOCATION: index.php");
 ?>
