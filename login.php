<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include ("database.php");
$db=new Database("baza");
session_start(); // Starting Session

$error=''; 
if (isset($_POST['login'])) {
if (empty($_POST['korisnickoime']) || empty($_POST['sifra'])) {
$error = "Morate uneti korisnicko ime i sifru!";
}
else
{

$username=$_POST['korisnickoime'];
$password=$_POST['sifra'];
// To protect MySQL injection for Security purpose      
$username = stripslashes($username);
$password = stripslashes($password);
// SQL query to fetch information of registerd users and finds user match.
$db->login($password,$username);
if ($db->getResult()->num_rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profil.php"); // Redirecting To Other Page
} else {
$error = "Pogresno ste uneli korisnicko ime ili sifru!";
}

}
}
?>