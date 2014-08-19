<?php

    /******************     
     Pomožne funkcije
     ******************/
    
    /*
     * void
     * apologize($message)
     *
     * Opravičilo uporabniku, prikaže stran z opravičilom
     */

    function apologize($message)
    {
        // zahtevam datoteko za opravičilo
        require_once("apology.php");

        // izhod
        exit;
    }


    /*
     * void
     * dump($variable)
     *
     * Prikaz spremenljivke (za debugging)
     */

    function dump($variable)
    {
        //dump spremenljivke
        require("dump.php");

        // exit, da lahko vidim, kaj je sprintalo
        exit;
    }


    /*
     * void
     * logout()
     *
     * Odjavi trenutnega uporabnika, povzeto iz Example #1 na
     * http://us.php.net/manual/en/function.session-destroy.php.
     */

    function logout()
    {
        // unsetam spremenljivke seje
        $_SESSION = array();

        // potek piškotka
        if (isset($_COOKIE[session_name()]))
        {
            if (preg_match("{^(/[^/]+/pset7/)}", $_SERVER["REQUEST_URI"], $matches))
                setcookie(session_name(), "", time() - 42000, $matches[1]);
            else
                setcookie(session_name(), "", time() - 42000);
        }

        // uničim sejo
        session_destroy();
    }


    /*
     * stock
     * lookup($symbol)
     *
     * Vrne podatke o delnici, če obstaja, drugače NULL.
     */

    function lookup($symbol)
    {
        // zavrnem simbole, ki se začnejo z ^
        if (preg_match("/^\^/", $symbol))
            return NULL;

        // zavrnem simbole z vejicami
        if (preg_match("/,/", $symbol))
            return NULL;

        // odprem povezavo z Yahoo-jem
        if (($fp = @fopen(YAHOO . $symbol, "r")) === false)
            return NULL;

        // downloadam prvo vrstico CSV datoteke
        if (($data = fgetcsv($fp)) === false || count($data) == 1)
            return NULL;

        // zaprem povezavo z Yahoo-jem
        fclose($fp);

        // zagotovim, da je delnica najdena (če je, cena ni 0.00)
        if ($data[2] == 0.00)
            return NULL;

        // instanciram Stock objekt (definiran v stock.php)
        $stock = new Stock();

        // zapomnim si podatke o delnici
        $stock->symbol = $data[0];
        $stock->name = $data[1];
        $stock->price = $data[2];
        $stock->time = strtotime($data[3] . " " . $data[4]);
        $stock->change = $data[5];
        $stock->open = $data[6];
        $stock->high = $data[7];
        $stock->low = $data[8];

        // vrnem delnico
        return $stock;
    }


    // pridobi simbole delnic iz CSV datoteke
    function getSymbols()
    {        
        $row = 1;
        $fp = fopen("extra/companylist.csv", "r");
        if($fp !== FALSE)
        {
            while (($data = fgetcsv($fp, ",")) !== FALSE)
            {
                //TODO?
                echo $data[0];
                echo " - ";
                echo $data[1];
                echo "<br>";
                $row++;
            }
        }
        // zaprem datoteko CSV
        fclose($fp);
    }


    /*
     * void
     * redirect($destination)
     * 
     * preusmeri uporabnika na določeno stran, podano v $destination
     */

    function redirect($destination)
    {
        // če je URL
        if (preg_match("/^http:\/\//", $destination))
            header("Location: " . $destination);

        // če je absolutna pot
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (@$_SERVER["HTTPS"]) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // če je relativna pot
        else
        {
            // prirejeno z http://www.php.net/header
            $protocol = (@$_SERVER["HTTPS"]) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // izhod, ker preusmerjam
        exit;
    }

?>
