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
if (isset($_REQUEST['id'])){
$sql = "DELETE FROM usluga WHERE uslugaID=".$_REQUEST['id'];

if ($mysqli->query($sql) === TRUE) {
    echo "ok";
} else {
    echo "Nije ok".$_REQUEST['id'];
}

$mysqli->close();

}
?>