    <?php include ("top.php");  ?>

    <div id="middle">
    <p>Vpišite delnico za nakup. Seznam vseh kratic najdete <a href="symbols.php">tukaj.</a></p>
    <?php
    require_once("includes/common.php");
    //če je obrazec potrjen
    if(isset($_POST['submit']))
    {
        //če nista nastavljeni obe vrednosti
        if(!isset($_POST['stock']) || !isset($_POST['shares']))
        {
            //prikažem napako
            echo "<span>Izpolnite vsa polja.</span>";
        }
        else
        {
            //preg_match preveri, da je $_POST['shares'] število
            if(preg_match("/^\d+$/", $_POST["shares"]))
            {
                $id = $_SESSION['id'];
                //najdem delnico
                $s = lookup($_POST['stock']);
                if(isset($s))
                {
                    //shranim simbol in ceno
                    $sym = $s->symbol;
                    $price = $s->price;
                }
                else
                {
                    //če delnica ne obstaja
                    echo "Ni podatkov delnice.";
                }

                $quantity = $_POST['shares'];
                $sql_stocks_shares = "SELECT * FROM stocks WHERE id=$id";
                $res = mysql_query($sql_stocks_shares);
                $row_stocks = mysql_fetch_array($res);
                $shares_owned = $row_stocks['shares'];
                //računam, koliko stanejo delnice
                $sql = "SELECT * FROM users WHERE id=$id";
                $result = mysql_query($sql);
                $row = mysql_fetch_array($result);                
                $cash = $row['cash'];
                $total = $quantity * $price;

                if($cash < $total)
                {
                    //če ni dovolj denarja
                    echo "<span>Imate premalo denarja za ta nakup.</span>";
                }
                else
                {
                    //drugače dodam delnice
                    $sym_upper = strtoupper($sym);
                    $sql_stocks = "INSERT INTO stocks(id, symbol, shares) VALUES ($id, '$sym_upper', $quantity)
                                    ON DUPLICATE KEY UPDATE shares = $quantity";
                    
                    //vstavim v zgodovino
                    $bought = 1;
                    $datetime = date("Y:m:d H:i:s");
                    $sql_history = "INSERT INTO history(idhistory, bought, symbol, number, price, datetime)
                                    VALUES($id, $bought, '$sym_upper', $quantity, $price, '$datetime')";                                        
                    
                    if(mysql_query($sql_stocks))
                    {
                        //posodobim količino denarja
                        $sql_users = "UPDATE users SET cash = cash - $total WHERE id=$id";
                        mysql_query($sql_users);                        
                        if(mysql_query($sql_history) == true)
                        {
                            echo "<span>Kupljeno!<br>";
                            echo "<a href=\"index.php\">Poglej portfolio</a>";
                            echo "</span>";
                        }
                        else
                        {
                            echo "<span>Zgodovine ni bilo mogoče posodobiti!</span>";
                            echo "<br>" . mysql_error();
                        }
                    }
                    else
                    {
                        echo "<span>Problem s podatkovno bazo. Poskusite ponovno.</span>";
                    }
                }
            }
            else
            {
                echo "<span>Število delnic mora biti veljavna številka.</span>";
            }
        }
    }     
?>
        <div class="form_container">
        <form name="frmBuy" id="frmBuy" class="form" action="buy.php" method="post">            

            <p>            
                <input type="text" id="stock" name="stock" class="normal_input">
                <span id="errorMessageStock" class="formError"></span>
                <p class="labels">Simbol(npr. GOOG)</p>
            </p>

            <p>
                <input type="text" id="shares" name="shares" class="normal_input">
                <span id="errorMessageShares" class="formError"></span>
                <p class="labels">Količina</p>
            </p>

            <p>
            <input type="submit" value="Kupi" name="submit" class="submit">
            </p>

        </form>
        <br>

    </div>

    <div id="bottom">

    </div>
    </div>
    
    <script type="text/javascript" src="js/buy.js"></script>
  <?php 
    require_once("/includes/footer.php");
 ?>