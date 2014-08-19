<?

    // splošna koda
    require_once("includes/common.php");
    
    // preverim POST spremenljivke
    if(empty($_POST['symbol']))
    {
        $message = "Vnesite simbol delnice."        ;
        apologize($message);
    }
    
    $symbol = $_POST['symbol'];
    $stock = lookup($symbol);
    
    if($stock)
    {
        ?>
        <div id="stock">
            <p>Kažem podatke o delnici: <b><?php echo $stock->symbol; ?></b></p>
            <br>
            <p>Naziv: <b><?php echo $stock->name; ?></b></p>
            <p>Cena: <b><?php echo number_format(floatval($stock->price), 2); ?></b></p>                        
        </div>
        <?php
    }
    else
    {
        echo "No data received.";
    }
    

?>
