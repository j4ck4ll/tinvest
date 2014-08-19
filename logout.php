<?php

    // splošna koda
    require_once("includes/common.php"); 

    // odjavim trenutnega uporabnika, če obstaja
    logout();

?>

    <?php include ("top.php"); ?>

    <div id="middle">
      kthxbai
    </div>

    <div id="bottom">
      ponovna <a href="login.php">prijava</a> ali <a href="register.php">registracija</a>
    </div>

  </body>

</html>
