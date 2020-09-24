<?php
session_start();
 require_once('includes/head_section.php'); ?>
  <title>Srika | Quiz </title>
</head>
<body>
  <!-- container - wraps whole page -->
  <div class="container">
    <!-- navbar -->
    <?php include('includes/navbar.php'); ?>

    <!-- banner
    <div class="banner">
      <div class="welcome_msg">
        <h1>Today's Inspiration</h1>
        <p> 
           “Blogging is good for your career. <br>
           A well-executed blog sets you apart as an expert in your field.” <br>
          <span>― Penelope Trunk</span>
        </p>
        <a href="register.php" class="btn">Join us!</a>
      </div>
    </div> -->

    <!-- Page content -->
    <div class="content">
      <h2 class="content-title">Quiz</h2>
      <hr>
     
      
      <p id="qz">It is important to choose the right product for your skin type.
      <br>To help you with this,we've put together this quick quiz to help you determine the right product.</br>
      Simply answer each of the following questions to see a personalized product list for you!</p>
    <br>
<div id="main">
  <form id="qf" method="post">
      <ul>
        <li><label>1.What is your skin type?</label><br></li>
        <li><input type="radio" name="q1" value="oily">Oily</br></li>
        <li><input type="radio" name="q1" value="dry">Dry/Sensitive</br></li>
        <li><input type="radio" name="q1" value="normal">Normal</br></li>
        <li><input type="radio" name="q1" value="notsure">Not Sure</br></li>
      </ul>
    <br>

      <ul>
      <li><label>2.Do you like exfoliation in your soap?</label><br></li>
      <li><input type="radio" name="q2" value="smooth">No,I prefer totally smooth soap bars</br></li>
      <li><input type="radio" name="q2" value="scrub">Some scrub would be nice</br></li>
      </ul>
    <br>

      <ul>
        <li> <label>4.What is your skin concern?</label><br></li>
      <li><input type="radio" name="q4" value="acne">Acne</br></li>
      <li><input type="radio" name="q4" value="ageing">Anti-ageing</br></li>
      <li><input type="radio" name="q4" value="refreshing">Need refreshing Skin</br></li>
      </ul>
    <br>

      <input class="btn" type ="submit" value="Generate Personalized List" name="generate">
      </form>
      
    </div>
    <?php 
        include "db.php";
        if (isset($_POST["generate"]))
        {
          if (!isset($_POST["q1"]) || !isset($_POST["q2"]) || !isset($_POST["q4"]))
          {
            echo "<div id='e'>Please select an answer from all question ! ! !</div>";
          }
          else
          {
            quiz($_POST["q1"],$_POST["q2"],$_POST["q4"]);
          }
        }
      ?>
    </div>
    <!-- footer -->
<?php include('includes/footer.php'); ?>