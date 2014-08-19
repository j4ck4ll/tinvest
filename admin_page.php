 <?php 
  include ("top.php"); 
  require_once("includes/common.php");
  //najdem vse uporabnike
  $sql = "SELECT * FROM users";
  $result = mysql_query($sql);

 ?>
    
    <div id="middle">
      <h2>Administracija</h2>
      <?php
        echo "<div id=\"users_div\">";
        echo "<h3>Uporabniki</h3>";
       //ustvarim povezave za odstranitev uporabnikov
        while($row = mysql_fetch_array($result))
        {
            $id = $row['id'];
            
            echo "<div class=\"remove_user_div\">";
            echo "<ul>";
            echo "<li>". $row['username'] ."</li>";

            echo "<a href=\"delete_user.php?id={$id}\" class=\"remove_user_link\">Odstrani</a>";            
            echo "</ul>";
           echo "</div>";
        }
echo "</div>";

echo "<div id=\"cash_div\">";
echo "<form id=\"frm_cash\" method=\"post\" action=\"add_cash.php\">";
echo "<h3>Denar</h3>";

echo "<p>Izberi uporabnika...</p>";
            echo "<br>";
            echo "<div class=\"styled_select\">";
            echo "<select name=\"select_user\" id=\"select_user\">";

            //najdem vse uporabnike
            $result = mysql_query("SELECT * FROM users");
            while($row = mysql_fetch_array($result))
            {                 
                echo "<option value=\"".$row['username']."\">".$row['username']."</option>\n";                
            }
            echo "</select>";
            //za prikaz v primeru napake
            echo "<span id=\"errorMessageUser\" class=\"formError\"></span>";
            echo "</div>";
//obrazec za vnos denarja
echo "<p>";
echo "<input type=\"text\" id=\"add_cash_amount\" name=\"add_cash_amount\" class=\"normal_input\" >";
echo "<span id=\"errorMessageCash\" class=\"formError\"></span>";
echo "<p class=\"labels\">Nakazilo</p>";
echo "</p>";

echo "<p>";
echo "<input type=\"submit\" id=\"submit\" name=\"submit\" class=\"normal_input\" value=\"Potrdi\" >";
echo "</p>";
echo "</form>";          
echo "</div>";

echo "<div id=\"comments_div\">";
echo "<h3>Komentarji</h3>";
echo "<a href=\"comments.php\">Preglej komentarje</a>";
echo "</div>";        
?>
    </div>
  <script type="text/javascript" src="js/add_cash.js"></script>
  <?php 
  require_once("/includes/footer.php");
 ?>