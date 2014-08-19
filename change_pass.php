<?php

    // zahtevam splošno kodo
    require_once("includes/common.php");
    if(isset($_POST['submit']))
    {  
      //če ni nastavljena katera vrednost, preusmerim nazaj
      if(!isset($_POST['pass']) || !isset($_POST['pass2']) || !isset($_POST['pass3']))
          redirect("change_pass.php");
      else
      {
        //dobim podatke o uporabniku
          $id = $_SESSION['id'];
          $sql = "SELECT * FROM users WHERE id=$id";
          $result = mysql_query($sql);
          $row = mysql_fetch_array($result);
          $pwd = $row['hash'];
          //sanitiram vnosna polja
          $pass = mysql_real_escape_string($_POST['pass']);
          $pass2 = mysql_real_escape_string($_POST['pass2']);
          $pass3 = mysql_real_escape_string($_POST['pass3']);
          $hash = crypt($pass2);
          //preverim ujemanje gesel in hash vrednosti
          if($pwd != $hash && $pass2 == $pass3 && !empty($hash) && !empty($pass) && !empty($pass2) && !empty($pass3))
          {            
            //posodobim polje
              $sql = "UPDATE users SET hash='$hash' WHERE id=$id";
              mysql_query($sql);
              redirect("login.php");            
          }
          //drugače prikažem napake
          else if($pwd == $hash)
          {
              $message = "Novo geslo je enako staremu.";
              apologize($message);
          }
          else if($pass2 != $pass3)
          {
              $message = "Potrdite novo geslo.";
              apologize($message);
          }
          else if(empty($pass) || empty($pass2) || empty($pass3))
          {
              $message = "Izpolnite vsa polja.";
              apologize($message);
          }
      }
    }

?>

    <?php include ("top.php"); ?>

    <div id="middle">      
      <div id="form_container">
      <form id="frmChangePass" name="pass_form" method="post" action="change_pass.php">
      <table id="pass_tbl">
      
      <p>
       <input type="password" name="pass" id="pass" class="normal_input"></input>
       <span id="errorMessageChangePass" class="formError"></span> 
       <p class="labels">Trenutno geslo</p>
      </p>
       
       <p>
       <input type="password" name="pass2" id="pass2" class="normal_input"></input>
       <span id="errorMessageChangePass2" class="formError"></span>   
      <p class="labels">Novo geslo</p>
       </p>
  
      <p>
        <input type="password" name="pass3" id="pass3" class="normal_input"></input>
        <span id="errorMessageChangePass3" class="formError"></span> 
        <p class="labels">Ponovi novo geslo</p>
      </p>                    
      
       <input type="submit" value="Spremeni" class="submit" name="submit"></input>
       
       </table>
     </form>
     </div>
    </div>

    <div id="bottom">
    </div>
    <script src="js/change_pass.js"></script>        
  </body>
</html>
