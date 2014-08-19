
<?php
    // require common code
    require_once("includes/common.php");
    include ("top.php");
    
?>
    <div id="middle">
    <table id="history">
        <tr>
          <td>Kupljeno/prodano</td>
          <td>Delnica</td>
          <td>Količina</td>
          <td>Cena</td>
          <td>Čas</td>
        </tr>
    <?php
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM history WHERE idhistory=$id ORDER BY datetime DESC";
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result))
            {
               echo "<tr>";
               echo "<td>";
                if($row['bought'] == 1)
                  echo "Kupljeno";
                else
                  echo "Prodano";
               echo "</td>";
               echo "<td>";
                   echo $row['symbol'];
               echo "</td>";
               echo "<td>";
                   echo $row['number'];
               echo "</td>";
               echo "<td>";
                   echo $row['price'];
               echo "</td>";
               echo "<td>";
                   echo $row['datetime'];
               echo "</td>";
               echo "</tr>";
            }
    ?>
     </table>
    </div>

    <div id="bottom">      
    </div>
  <?php 
  require_once("/includes/footer.php");
 ?>