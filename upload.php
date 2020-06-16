<?php 
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include ('izgled.php');

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["slika"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Proverava da li se radi o slici ili nekom drugom fajlu
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["slika"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
    echo "<div class='alert alert-danger'><p id=\"1\">Odabrani fajl nije slika!</p></div>";
        $uploadOk = 0;
    }
    // print_r($_POST);
}

// Proverava velicinu slike ne sme veca od 6mb
if ($_FILES["slika"]["size"] > 6000000) {
echo "<div class='alert alert-danger'><p id=\"1\">Slika je prevelika!</p></div>";

    $uploadOk = 0;
}
// Dozvoli samo formate ispod
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "<div class='alert alert-danger'><p id=\"1\">Slika mora biti JPG,JPEG,PNG ili GIF format!</p></div>";
    $uploadOk = 0;
}
// Ako je promenljiva $uploadOK=0 znaci da nije prosla svaka provera i da nije uspeo uplaod
if ($uploadOk == 0) {
echo "<div class='alert alert-danger'><p id=\"1\">Slika nije postavljena! Slika će biti po defaultu!</p></div>";
// ako je sve ok pokusaj upload
} else {
    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
echo "<div class='alert alert-success'><p id=\"1\">Slika ". basename( $_FILES["slika"]["name"]). " je uspešno postavljena.</p></div>";
$uploadOk=1;
    } else {
        echo "Doslo je do greske.";	
    }
}
if($uploadOk==0){
//ako nije uploadovano nista postavi default sliku za sliku auta
$target_file="img/default.jpg";}
$podaci=array($_POST["ime"],$_POST["cena"],$_POST["opis"],$_FILES["slika"],$_POST["kategorijaID"],$target_file,$red->korisnickoime);
if ($db->ubaciUslugu($podaci)) {
    echo "<div class='alert alert-success'><p id=\"2\">Uspešno dodavanje nove usluge u ponudu.</p></div>";
} else {
//ako nije uspelo dodavanje psa, a prethodno je uploadovana neka slika	
if($target_file!="img/default.jpg"){
//obrisi tu sliku iz foldera	
// unlink($target_file);
}
 echo "<div class='alert alert-danger'><p id=\"2\">Neuspesno dodavanje usluge!!!</p></div>";
}
donjiDeo();

?>

