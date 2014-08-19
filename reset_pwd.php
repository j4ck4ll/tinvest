<?php
    // splošno
    require_once("includes/common.php");
;
    // preverim, če sta nastavljeni POST spremenljivki
    if(isset($_POST['username']) && isset($_POST['email']))
    {
        // izberem uporabnika in dobim podatke        
        $username = $_POST['username'];
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);    
    
        // če mail obstaja, ga pošljem
        if($row['email'] == $_POST['email'])
        {
            $recipient = $row['email'];
            $subject = "Ponastavitev gesla";
            $reset_pwd = random_string(6);
            $message = "Vaše novo geslo za Teo'$ Finance je: " . $reset_pwd;
            $message = str_replace("\n.", "\n..", $message);
            $from = "kabimel@gmail.com";
            mail($recipient, $subject, $message, $from);

            $hash = crypt($reset_pwd);
            if(mail($recipient, $subject, $message, $from) == true)
            {
                $sql = "UPDATE users SET hash='$hash' WHERE id=$id";
                mysql_query($sql);
            }
            else
            {
                apologize("Ne gre.");
            }
        }
    }
    else if(!isset($_POST['username']))
    {
        $message = "Zahtevam uporabniško ime.";
        apologize($message);
    }
    else if(!isset($_POST['email']))
    {
        $message = "Zahtevam e-mail.";
        apologize($message);
    }
    
?>
