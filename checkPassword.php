<?php
if (isset($_GET['sifra'])) {
    

    $sifra = $_GET["sifra"];
  
    if (preg_match('/\\d/', $sifra) == 0) {
        echo "0";
    } else {
        echo "1";
    }
}