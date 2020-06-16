<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include ("Database.php");
$db=new Database("baza");

session_start();// Starting Session

// Storing Session (zastita u slucaju otmice sesije--proverava da li vec postoji sesija)
if (!isset($_SESSION['pokrenuta'])) { 
   session_regenerate_id(); 
   $_SESSION['pokrenuta'] = true; 
} 
//zastita od otmice sesije pomocu user agenta
if (isset($_SESSION['HTTP_USER_AGENT'])) {
	if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
		// User Agent je promenjen, prikazati login
		exit;
	}
} else {
	// Upisati informacije o User Agent-u
	$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
}

$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$db->prikaziKorisnika($user_check);
$row = $db->getResult()->fetch_object();
$login_session =$row->korisnickoime;
if(!isset($login_session)){
header('Location: index.php'); // Redirecting To Home Page
}
?>