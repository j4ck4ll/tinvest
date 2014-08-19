<?php

    // zahtevam splošno kodo
    require_once("includes/common.php");

    if(isset($_POST['submit']))
    {
      // izognem se SQL injekciji
      $username = mysql_real_escape_string($_POST["username"]);

      // dobim podatke iz baze
      $sql = "SELECT * FROM users WHERE username='$username'";
      $result = mysql_query($sql);

      // če je uporabnik najden, preverim geslo
      if (mysql_num_rows($result) == 1)
      {
          $row = mysql_fetch_array($result);

          // primerjam hash vrednost s hash vrednostjo v bazi
          if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
          {
              // zapomnim si, da je prijavljen tako, da shranim njegov id v spremenljivko seje
              $_SESSION["id"] = $row["id"];

              // preusmerim ga na portfolio
              redirect("index.php");
          }
      }
      else
      {
        // drugače sporočim napako
        apologize("Neveljavno uporabniško ime ali geslo!");
      }
  }

?>


    <?php include ("top.php"); ?>
    
    <div id="middle">
      <h2>PRIJAVA |</h2>
      <form id="frmLogin" action="login.php" method="post">
        <p>            
          <input type="text" id="username" name="username" class="normal_input"><span id="errorMessageUsername" class="formError"></span>        
          <p class="labels">Uporabniško ime</p>
        </p>

        <p>
          <input type="password" id="password" name="password" class="normal_input"><span id="errorMessagePassword" class="formError"></span>         
          <p class="labels">Geslo</p>
        </p>        
        <p>            
          <input type="submit" name="submit" class="submit" value="Vstopi">
        </p>
      </form>
      
    </div>

    <div id="bottom">
      ali se <a href="register.php">registrirajte</a>            
    </div>
  <script type="text/javascript" src="js/login.js"></script>
  </body>

</html>
