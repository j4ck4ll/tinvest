<div class="links">
        <ul>
            <li>
            <?php 
                if(isset($_SESSION['id']))
                {
                    $id = $_SESSION['id'];
                    $sql = "SELECT * FROM users WHERE id=$id";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_array($result);
                    if($row['is_admin'] == 1)
                    {
                    echo "<a href=\"admin_page.php\">ADMINISTRACIJA |</a>";
                    }
                }
             ?>                
            <a href="index.php">PORTFOLIO |</a>
            <a href="profile.php">PROFIL |</a>
            <a href="buy.php">KUPI |</a>
            <a href="sell.php">PRODAJ |</a> 
            <a href="history.php">ZGODOVINA |</a>
            <a href="comments.php">KOMENTIRAJ |</a> 
            <a href="logout.php" id="logout">ODJAVA</a>
            </li>
          
        </ul>
      </div>