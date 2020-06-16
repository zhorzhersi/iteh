<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
?>
<html>
<head>
<script src="js/jquery.min.js"></script>
<link href="css/reg.css" rel="stylesheet" type="text/css">
<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css" rel="stylesheet" integrity="sha384-N8DsABZCqc1XWbg/bAlIDk7AS/yNzT5fcKzg/TwfmTuUqZhGquVmpb5VvfmLcMzp" crossorigin="anonymous">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script>
//PROVERA DOSTUPNOSTI KORISNICKOG IMENA AJAX
$(document).ready(function() {
	$("#korisnickoime").keyup(function (e) {
	
		//removes spaces from username
		$(this).val($(this).val().replace(/\s/g, ''));
		
		var korisnickoime = $(this).val();
		if(korisnickoime.length < 3){$("#user-result").html('');return;}
		
		if(korisnickoime.length >= 3){
			$.post('checkUsername.php', {'korisnickoime':korisnickoime}, function(data) {
			  $("#user-result").html(data);
			});
		}
	});	
});
</script>
<script>
$(document).ready(function() {
	$("#sifra").keyup(function (e) {
	
		//removes spaces from username
		$(this).val($(this).val().replace(/\s/g, ''));
		
		var sifra = $(this).val();
		if(sifra.length < 5){$("#pass-result").html("Sifra mora sadrzati bar pet karaktera i jedan broj.");return;}
		else{
			$.post('checkPassword.php', {'sifra':sifra}, function(data) {
			  $("#pass-result").html(data);
			});
		}


		$.get("checkPassword.php", {
                        'sifra': sifra
                    },
                    function(data) {
                        if (data == 0) {
                            
                            $("#pass-result").html("Uneta sifra mora sadrzati bar jedan broj.");
 
                        }else{
							$("#pass-result").html("Uneta sifra je dobra");
						}
                       
                    });

	});	
});


</script>
<title>ZUB ordinacija</title>
</head>
<body>

<div id="registracija">
<?php if (isset($_POST["register"])){
include ("database.php");
$db=new Database("baza");
$date=date("Y-m-d H:i:s");
$podaci=array($_POST['korisnickoime'],$_POST['sifra'],$_POST['ime'],$_POST['prezime'],$_POST['email'],$date);
if ($db->registracijaKorisnika($podaci)) {
    echo "<div style='font-size:20px;text-align: center;margin-top:1rem;'>Uspešno ste kreirali nalog.</div>";
} else {
	echo "<div style='font-size:20px;text-align: center;margin-top:1rem;'>Neuspešno ste kreirali nalog.</div>";
}
}?>
  <form method="post"  >
 <h1> Registrujte se</h1>
  <h5 style="color:#393131">Korisnicko ime</h5>
 <input type="text" id="korisnickoime"style="width:100%;" name="korisnickoime"placeholder="Korisničko ime" required>

 <div id="user-result" style="font-size:15px;color:red;"></div>

 <h5 style="color:#black">Sifra</h5>
<input type="password"  name="sifra" style="width:100%;" id="sifra" placeholder="Šifra" required>
<div id="pass-result" style="font-size:15px;color:red;"></div>
<h5 style="color:#black">Ime</h5>
 <input type="text" style="width:100%;" id="ime" name="ime"placeholder="Ime" required>
 <h5 style="color:#black">Prezime</h5>
  <input placeholder="Prezime"type="text" style="width:100%;" id="prezime"name="prezime" required>

<h5 style="color:#black">Email</h5>
  <input type="text" style="width:100%;" id="email"name="email" placeholder="Email" required>
<br><br>
<button type="submit" style=""name="register" class="btn btn-primary">Kreirajte Vas nalog</button>
<!-- <button type="submit" style=" position: relative;left: 120px;"name="register" class="btn btn-primary">Vratitte se nalogin</button> -->

<a href="index.php" style="position: relative;left: 10%;font-size:15px;color:black; align:center;"> Vratite se na login</a>
</form>
</div>

 </body>
</html>
