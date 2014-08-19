<?php

    /***********************************************************************
     * Stock.php
     * Definira razred (strukturo) za delnico.
     * Začetne vrednosti nastavi na NULL.
     **********************************************************************/


    class Stock
    {
        // simbol delnice
        public $symbol = NULL;

        // ime delnice
        public $name = NULL;

        // cena 
        public $price = NULL;

        // nazadnje prodano/kupljeno
        public $time = NULL;

        // odstotek spremembe v zadnjem delovnem dnevu
        public $change = NULL;

        // zadnji delovni dan - začetna cena
        public $open = NULL;

        // max cena
        public $high = NULL;

        // min cena
        public $low = NULL;
    }

?>
