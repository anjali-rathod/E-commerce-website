<?php
session_start();
 require_once('includes/head_section.php'); ?>
  <title>Srika | Customize </title>
</head>
<body>
  <!-- container - wraps whole page -->
  <div class="container">
    <!-- navbar -->
    <?php include('includes/navbar.php'); ?>

    <div class="content">
      <h2 class="content-title">Personalize Your Own Soap</h2>
      <hr>
     
      
      <p id="qz">It is important to choose the right product for your skin type.
      <br>Srika offers you an option to customize your soap as per your requirement.<br>
      Please select all the fields and add your PERSONALIZED SOAP to the cart ! ! 
      <br><br><br>Our customized soaps costs you <b> <span id="rs">R 150</span></b> each!<br></p>
    <br>
<div id="main">
  <form name="MY FORM" id="qf" method="post">
      <ul>
        <li><label>1.What is your choice of base?</label><br></li>
        <li><input type="radio" name="q1" value="Goat Milk - ">Goat Milk</br></li>
        <li><input type="radio" name="q1" value="Olive Oil- ">Olive oil</br></li>
        <li><input type="radio" name="q1" value="Aloe Vera - ">Aloe Vera</br></li>
        <li><input type="radio" name="q1" value="Glycerin - ">Glycerin</br></li>
        <li><input type="radio" name="q1" value="Cocunut Milk - ">Cocunut Milk</br></li>
      </ul>
    <br>

      <ul>
        <li><label>2.What is your choice of essential oil?</label><br></li>
        <li><input type="radio" name="q2" value="Tea Tree - ">Tea Tree</br></li>
        <li><input type="radio" name="q2" value="PepperMint - ">Peppermint</br></li>
        <li><input type="radio" name="q2" value="Lavender - ">Lavender</br></li>
        <li><input type="radio" name="q2" value="Orange - ">Orange</br></li>
        <li><input type="radio" name="q2" value="Lemon - ">Lemon</br></li>
        <li><input type="radio" name="q2" value="Coffee - ">Coffee</br></li>
      </ul>
    <br>
      
      <ul>
        <li><label>3.Would you prefer fragrance?</label><br></li>
        <li><input type="radio" name="q3" value="Floral - ">Mild and Floral</br></li>
        <li><input type="radio" name="q3" value="Citrus - ">Citrus and Fresh</br></li>
        <li><input type="radio" name="q3" value="None - ">None</br></li>
    </ul>
    <br>

      <ul>
        <li> <label>4.What is your choice of soap shape?</label><br></li>
      <li><input type="radio" name="q4" value="Heart ">Heart</br></li>
      <li><input type="radio" name="q4" value="Square ">Square</br></li>
      <li><input type="radio" name="q4" value="Circel ">Circle</br></li>
      <li><input type="radio" name="q4" value="Oval ">Oval</br></li>
      <li><input type="radio" name="q4" value="Coffe Bean ">Coffee Bean</br></li>
      </ul>
    <br>

      <input class="btn" type ="submit" value="Add this to cart" name='doit'>
      </form>
    </div>
    <?php
        include "db.php";
        if (isset($_POST["doit"]))
          { 
            if (isset($_SESSION["logged_in"]))
            { 
              if ( (!isset($_POST["q1"])) || (!isset($_POST["q2"])) )
              {
                echo "<p id='e'>Please Select essential oil and base ATLEAST !!<p>";
              }
              else
              {
                customize($_SESSION["uno"],$_POST["q1"],$_POST["q2"],$_POST["q3"],$_POST["q4"]);
              }
            }
            else
            {
              echo "<p id='e'>Please LOGIN !!<p>";
            }
        }
        
      ?>
    </div>
    <!-- footer -->
<?php include('includes/footer.php'); ?>