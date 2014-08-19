<?php

    // splošna koda
    require_once("includes/common.php");

    if(isset($_POST['submit']))
    {
      if(!empty($_POST['username']) ||!empty($_POST['password']) || !empty($_POST['email']))
      {
        //preverim email z regularnim izrazom in preg_match
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
          if(preg_match($regex, $_POST['email']))
          {
            if($_POST['password'] == $_POST['password2'])
            {
              // izogibanje SQL injekciji
              $username = mysql_real_escape_string($_POST["username"]);
              $email = mysql_real_escape_string($_POST["email"]);
              $password = mysql_real_escape_string($_POST["password"]);      
              $hash = crypt($password);


              $sql = "INSERT INTO users(username, email, hash, cash) 
                      VALUES ('$username', '$email', '$hash', 10000.0000)";
              $result = mysql_query($sql);

              // če je uspešno, shranim id
              $id = mysql_insert_id();
          
          // če ni uspešno, se opravičim
            if(!$result)
            {
                $message = "Ne morem ustvariti novega uporabnika.";
                apologize($message);
            }
            else
            {        
                //$_SESSION['id'] = $id;
                redirect("login.php");
            }
          }
          else
            apologize("Gesli se ne ujemata.");
        }
        else
          apologize("Vnesite veljaven e-mail.");
      }
      else
        apologize("Izpolnite vsa polja.");
    }

?>
   <?php include ("top.php"); ?>

    <div id="middle">
      <h2>Registracija</h2>
      <form id="frmRegister" action="register.php" method="post">
        <p >          
          <input id="username" name="username" type="text" class="normal_input">
          <span id="errorMessageUsername" class="formError"></span>
          <p class="labels">Uporabniško ime</p>
        </p>
        
         <p>           
           <input id="email" name="email" type="email" class="normal_input">
           <span id="errorMessageEmail" class="formError"></span>
           <p class="labels">E-mail</p>
         </p>
           
         <p>                     
          <input id="password" name="password" type="password" class="normal_input">
          <span id="errorMessagePassword" class="formError"></span>
          <p class="labels">Geslo</p>
         </p>
         
           <p>            
           <input id="password2" name="password2" type="password" class="normal_input">
           <span id="errorMessagePassword2" class="formError"></span>  
          <p class="labels">Ponovi geslo</p>
           </p>

           <input id="submit" name="submit" type="submit" class="submit" value="Registracija">
          
      </form>
    </div>

    <div id="bottom">
      ali <a href="login.php">se prijavi</a> s svojim uporabniškim imenom in geslom
    </div>
  <script type="text/javascript" src="js/register.js"></script>
  </body>

</html>
