<?php
    require_once("includes/common.php");
    
    if(!isset($_POST['pass']) || !isset($_POST['pass2']) || !isset($_POST['pass3']) || !isset($_POST['submit']))
        redirect("change_pass.php");
    else
    {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $pwd = $row['hash'];
        
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        $pass3 = $_POST['pass3'];
        $hash = crypt($pass2);
        
        if($pwd != $hash && $pass2 == $pass3 && !empty($hash) && !empty($pass) && !empty($pass2) && !empty($pass3))
        {            
            $sql = "UPDATE users SET hash='$hash' WHERE id=$id";
            mysql_query($sql);
            redirect("login.php");            
        }
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
?>
