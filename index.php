<?php
//Upravljanje greskama
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");

include('login.php');
if(isset($_SESSION['login_user'])){
header("location: profil.php");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css" rel="stylesheet" integrity="sha384-N8DsABZCqc1XWbg/bAlIDk7AS/yNzT5fcKzg/TwfmTuUqZhGquVmpb5VvfmLcMzp" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<title>ZUB ordinacija</title>
</head>
<body>
<!--
<img src="img/pocetna.jpg" style="display: block; margin-left: auto; margin-right: auto; border: 2px solid yellow; border-radius: 20px;" width="1280" height="480"/>
-->

<div class="login-box">
<h1> Login </h1>

<form method="post" >
<h5 style="color:black">Korisnicko ime</h5>
<input type="text" id="korisnickoime" style="width:100%" placeholder="Korisničko ime" name="korisnickoime" style="background:none; color:black">
<br>
<h5 style="color:black">Sifra</h5>
<input type="password" placeholder="Šifra" style="width:100%;" name="sifra" style="background:none; color:black">
<br><br>
<button type="submit" name="login" value="Uloguj se" class="btn btn-primary">Uloguj se</button>
</form>
<a href="registracija.php">Nemate nalog? Registrujte se...</a>
<?php 
if($error=="Pogresno ste uneli korisnicko ime ili sifru!"||$error=="Morate uneti korisnicko ime i sifru!"){
echo "<div style='font-size:20px; color:black;'>".$error. "</div>";}
?>	

</div><!--login box zatvoren -->
 </body>
</html>