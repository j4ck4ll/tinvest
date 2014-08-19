<?php

/************************************************
// večnamenska koda, uporabljena na večini strani
// pravzaprav session.php + database.php
*************************************************/


    // prikaže napake in opozorila, ne pa obvestil
    ini_set("display_errors", true);
    error_reporting(E_ALL ^ E_NOTICE);

    //omogočim seje, omejim piškotke na /tinvest/
    if (preg_match("{^(/tinvest/)}", $_SERVER["REQUEST_URI"], $matches))
        session_set_cookie_params(0, $matches[1]);
    session_start();

    // zahtevam pomožne datoteke
    require_once("constants.php");
    require_once("helpers.php");
    require_once("stock.php");

    // zahtevam avtentikacijo za večino strani
    if (!preg_match("{/(:?login|logout|register|)\d*\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (!isset($_SESSION["id"]))
            redirect("login.php");
    }

    // povezava z bazo
    if (($connection = @mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD)) === false)
        apologize("Nimam povezave z bazo.");

    // izbira baze
    if (@mysql_select_db(DB_NAME, $connection) === false)
        apologize("Nisem mogel izbrati baze (" . DB_NAME . ").");

?>
