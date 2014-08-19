<?php

    //splošno
    require_once("includes/common.php");
    
    $id = $_SESSION['id'];
    if($_POST['submit'])
    {   
        // lookup funkcija dobi podatke o delnici, če obstaja
        $sym    = lookup($_POST['select_stock']);
        $symbol = $sym->symbol;
        $price  = $sym->price;

        

        // podatki iz baze
        $sql = "SELECT * FROM stocks WHERE id=$id AND symbol='$symbol'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);        
        $curr_quantity = $row['shares'];
        $sell_quantity = mysql_real_escape_string($_POST['num']);
        
        $sql_cash = "SELECT * FROM users WHERE id=$id";
        $result = mysql_query($sql_cash);
        $row = mysql_fetch_array($result);
        $cash = $row['cash'];

        // izračunam vsoto prodanih delnic
        $profit = $price * $sell_quantity;
        //če proda vse delnice
        if($sell_quantity == $curr_quantity)
        {
            $sql_cash_update = "UPDATE users SET cash = $cash + $profit WHERE id=$id";
            //mysql_query($sql_cash);

            // izbrišem prodane delnice iz tabele
            $sql_stocks = "DELETE FROM stocks WHERE id=$id AND symbol='$symbol'";       
            //mysql_query($sql_stocks);                    


            // dobim spremenljivke za tabelo history
            $bought = 0;
            $sym_upper = strtoupper($symbol);
            $datetime = date("Y:m:d H:i:s");
            // vstavim podatke v tabelo history
            $sql_history = "INSERT INTO history(idhistory, bought, symbol, number, price, datetime)
            VALUES($id, $bought, '$sym_upper', $sell_quantity, $price, '$datetime')";
            //mysql_query($sql_history);
        
            if(!mysql_query($sql_cash) || !mysql_query($sql_cash_update) || !mysql_query($sql_stocks) || !mysql_query($sql_history))
            {
                 echo "<span>Ups, problem s podatkovno bazo:" . mysql_error() . "</span>";
            }
        }
        //če ne proda vseh, naredim update
        else if($sell_quantity < $curr_quantity) 
        {            
            $sql_cash_update = "UPDATE users SET cash = $cash + $profit WHERE id=$id";
            mysql_query($sql_cash_update);

            $sql_stocks_update = "UPDATE stocks SET shares = shares - $sell_quantity WHERE id=$id and symbol='$symbol'";
            mysql_query($sql_stocks_update);

            $sql_history = "INSERT INTO history(idhistory, bought, symbol, number, price, datetime)
            VALUES($id, $bought, '$sym_upper', $sell_quantity, $price, '$datetime')";
            mysql_query($sql_history);
        }
        else
        {
            apologize("Nimate toliko delnic.");
        }
        // preusmerim na portfolio
        redirect("index.php");
    }
?>
<?php include("top.php"); ?>

    <div id="middle">
    <form id="frmSell" action="sell.php" method="post">
        
    <?php
        $sql = "SELECT * FROM stocks WHERE id=$id";
        $result = mysql_query($sql);

        if(mysql_num_rows($result) != 0)
        {
            echo "<p>Izberi delnico za prodajo...</p>";
            echo "<br>";
            echo "<div class=\"styled_select\">";
            echo "<select name=\"select_stock\" id=\"select_stock\">";        
            while($row = mysql_fetch_array($result))
            {                 
                echo "<option value=\"".$row['symbol']."\">".$row['symbol']."</option>\n";                
            }
            echo "</select>";
            echo "</div>";
            echo "<br>";
            echo "<br>";

            echo "<p>Koliko delnic naj prodam?</p>";
            echo "<input id=\"numShares\" type=\"number\" name=\"num\" class=\"normal_input\" min=\"0\">";
            echo "<span id=\"errorMessageNumShares\" class=\"formError\"></span>";
            echo "<br>";
            echo "<br>";
            echo "<input type=\"submit\" name=\"submit\" class=\"submit\" value=\"Prodaj\"/>";
        }
        else
        {
            echo "<p>Ne lastite si nobenih delnic.</p>";
        }
    ?>
    
    
    </form>
    </div>
    <div id="bottom">
    </div>
    <script type="text/javascript" src="js/sell.js"></script>
  <?php 
    require_once("/includes/footer.php");
 ?>