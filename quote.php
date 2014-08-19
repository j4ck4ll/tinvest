<?php

    // require common code
    require_once("includes/common.php");

?>

<?php include("top.php"); ?>

    <div id="middle">
      <form action="quote2.php" method="post">
        <table>
          <tr>
            <td>Simbol:</td>
            <td><input name="symbol" type="text"></td>
          </tr>
            <td colspan="2"><input type="submit" value="Poglej delnico"></td>
          </tr>
        </table>
      </form>
    </div>

    <div id="bottom">
      or <a href="login.php">register</a> for an account
    </div>

  </body>

</html>
