<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
session_start();
if(session_destroy()) 
{
header("Location: index.php"); 
}

?>