<?php

    // zahtevam splošno kodo
    require_once("/includes/common.php"); 

?>
   
    <?php include ("top.php"); ?>
      
    <div id="middle">
    

<?php
    if(!isset($_SESSION['id']))
        redirect("login.php");
    else
    {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM stocks WHERE id=$id";
        $result = mysql_query($sql);
           
        if(mysql_num_rows($result) > 0) 
        {
            echo "<table id=\"stocks_tbl\">";
            echo "<tr>";
            echo "<td>Delnica</td>";
            echo "<td>Cena</td>";
            echo "<td>Količina</td>";
            echo "<td>Skupna vrednost</td>";
            echo "</tr>";

            while($row = mysql_fetch_array($result))
            {
                $stock = lookup($row['symbol']);
                echo '<tr>';
                echo '<td>';
                echo $stock->name;
                echo '</td>';
                echo '<td>';
                echo $stock->price;
                echo '</td>';
                echo '<td>';
                echo $row['shares'];
                echo '</td>';
                echo '<td>';
                $value = $stock->price * $row['shares'];
                echo $value;
                echo '</td>';
                echo '</tr>';                    
                echo '<br>';

                $total += $value;                                                    
            }

            echo '<tr>';
            echo '<td>';
            echo '</td>';
            echo '<td>';
            echo '</td>';
            echo '<td>';
            echo '</td>';
            echo '<td>';
            echo $total;
            echo '</td>';
            echo '<tr>';                    
        }
        else
        {
            echo "<span>Ne najdem delnic. Lahko jih kupite <a href=\"buy.php\">tukaj</a></span>";
            echo "<br>";
            echo "<br>";
        }
    }
        echo "</table>";
        
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $cash = $row['cash'];
        if($total > 0)
            $profit = $cash + $total - 10000.00;
        else
            $profit = $cash - 10000.00;

        $profit_percent = $profit/100;
        echo "Stanje: <b>$" . number_format(floatval($cash), 2) . "</b>";
        if($profit >= 0)
        {
            echo "<p class=\"profit\">Dobiček: $" . number_format(floatval($profit), 2) . "(" . number_format(floatval($profit_percent), 2) . "%)" . "</p>";
        }
        else
        {
            echo "<p class=\"loss\">Izguba: $" . number_format(floatval($profit), 2) . "(" . number_format(floatval($profit_percent), 2) . "%)" . "</p>";
        }

        if($row['is_admin'] == 1)
        {
            echo "<br>";
            echo "<br>";
            echo "<a href=\"admin_page.php\">Administracija</a>";
        }
    ?>
    </div>
  <?php 
    require_once("/includes/footer.php");
 ?>