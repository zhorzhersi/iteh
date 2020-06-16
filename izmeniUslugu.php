<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include "konekcija.php";
$mysqli = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
if ($mysqli->connect_error) {
    die("err");
} 

switch ($_REQUEST ['columnId']){
	case 1:
		
		$sql = "UPDATE usluga SET naziv='".$_REQUEST['value']."' WHERE uslugaID='".$_REQUEST['id']."'";
	break;
	case 3:
		$sql = "UPDATE usluga SET cena='".$_REQUEST['value']."' WHERE uslugaID='".$_REQUEST['id']."'";
	break;
	case 4:
		$sql = "UPDATE usluga SET opis='".$_REQUEST['value']."' WHERE uslugaID='".$_REQUEST['id']."'";
	break;
	case 5:
		$sql = "UPDATE usluga SET slika='".$_REQUEST['value']."' WHERE uslugaID='".$_REQUEST['id']."'";
	break;
	case 6:
		$sql = "UPDATE usluga SET dostupnost='".$_REQUEST['value']."' WHERE uslugaID='".$_REQUEST['id']."'";
	break;
	case 2:
		$sql = "UPDATE usluga SET kategorijaID='".$_REQUEST['value']."' WHERE uslugaID='".$_REQUEST['id']."'";
	break;
	

}
if ($mysqli->query($sql) == TRUE) {
    echo $_REQUEST["value"];
} else {
    echo "Nije izvrseno!";
}

$mysqli->close();

?>