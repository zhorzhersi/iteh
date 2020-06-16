<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include ("Database.php");
$db=new Database("baza");


//check we have username post var
if(isset($_POST["korisnickoime"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
}
	//trim and lowercase username
	$username =  strtolower(trim($_POST["korisnickoime"])); 
	
	//sanitize username
	$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db
	$db->prikaziKorisnika($username);
	//return total count
	$username_exist = mysqli_num_rows($db->getResult()); //total records
	
	//if value is more than 0, username is not available
	if($username_exist) {
		die('Korisničko ime je zauzeto!');
		
	}else{
		die('Korisničko ime je slobodno!');
	}
}
?>

