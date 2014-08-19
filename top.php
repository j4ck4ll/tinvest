<!DOCTYPE html>

  <head>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>Teo'$ Finance</title>
  </head>

  <body>
<div id="top">
      <a href="index.php"><img id="title" height="110" src="images/TInvest Logo.jpg" width="1010"></a>
      <br>
      <?php
      //na login strani ne prikažem navigacije 
       if($_SERVER['REQUEST_URI'] != "/tinvest/login.php")
          include("navigation.php");
    ?>
    </div>