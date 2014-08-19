<?php

  //require common code
  //require_once("includes/common.php");

?>

<?php include("top.php"); ?>

    <div id="middle">
    <p>Vnesite uporabniško ime in e-mail. Poslali vam bomo novo geslo.</p>
      <form action="reset_pwd.php" method="post">

         <p>
          <input name="username" type="text">
          <p class="labels">Uporabniško ime:</p>
         </p>
          
          <p>
            <input name="email" type="text">
            <p class="labels">Email</p>
          </p>           

          <input type="submit" class="submit" value="Reset">
          
      </form>
    </div>

    <div id="bottom">
      ali se <a href="register.php">registrirajte</a> kot nov uporabnik
      <br>
    </div>

  </body>
</html>
