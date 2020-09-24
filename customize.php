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
      Please select all the fields and add your PERSONALIZED SOAP to the cart ! ! </p>
    <br>
<div id="main">
  <form name="MY FORM" id="qf" method="post">
      <ul>
        <li><label>1.What is your choice of base?</label><br></li>
        <li><input type="radio" name="q1" value="goat">Goat Milk</br></li>
        <li><input type="radio" name="q1" value="olive">Olive oil</br></li>
        <li><input type="radio" name="q1" value="aloe">Aloe Vera</br></li>
        <li><input type="radio" name="q1" value="glycerin">Glycerin</br></li>
        <li><input type="radio" name="q1" value="coconut">Cocunut Milk</br></li>
      </ul>
    <br>

      <ul>
        <li><label>2.What is your choice of essential oil?</label><br></li>
        <li><input type="radio" name="q2" value="tea">Tea Tree</br></li>
        <li><input type="radio" name="q2" value="peppermint">Peppermint</br></li>
        <li><input type="radio" name="q2" value="lavender">Lavender</br></li>
        <li><input type="radio" name="q2" value="orange">Orange</br></li>
        <li><input type="radio" name="q2" value="lemon">Lemon</br></li>
        <li><input type="radio" name="q2" value="coffee">Coffee</br></li>
      </ul>
    <br>
      
      <ul>
        <li><label>3.Would you prefer fragrance?</label><br></li>
        <li><input type="radio" name="q3" value="floral">Mild and Floral</br></li>
        <li><input type="radio" name="q3" value="citrus">Citrus and Fresh</br></li>
        <li><input type="radio" name="q3" value="no">None</br></li>
    </ul>
    <br>

      <ul>
        <li> <label>4.What is your choice of soap shape?</label><br></li>
      <li><input type="radio" name="q4" value="heart">Heart</br></li>
      <li><input type="radio" name="q4" value="square">Square</br></li>
      <li><input type="radio" name="q4" value="circle">Circle</br></li>
      <li><input type="radio" name="q4" value="oval">Oval</br></li>
      <li><input type="radio" name="q4" value="bean">Coffee Bean</br></li>
      </ul>
    <br>

      <input class="btn" type ="submit" value="Add this to cart">
      </form>
    </div>
    </div>
    <!-- footer -->
<?php include('includes/footer.php'); ?>