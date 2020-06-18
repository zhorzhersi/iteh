<?php
include_once("session.php");
include_once('database.php');

$db->prikaziKorisnika($login_session);
$red=$db->getResult()->fetch_object();

gornjiDeo($login_session,$red->status);

function gornjiDeo($user,$status){
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");

?>
<!DOCTYPE html>
<head>
<title>ZUB ordinacija </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>




<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .mySlides {display:none;}
    </style>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script src="js/jquery-1.11.2.min.js"></script>
<script src="DataTables-1.10.4/media/js/jquery.dataTables.min.js"></script>
<script src="jeditable/jquery.jeditable.js"></script>
<script src="DataTables-1.10.4/extensions/editable/jquery.dataTables.editable.js"></script>
      

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">ZUB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php 
 if($status!='admin'){?>
  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      
        <a class="nav-link" href="profil.php">Početna strana</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ponuda.php">Ponuda</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="kontakt.php"> Kontakt </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="istorijaRezervacija.php">Moje rezervacije</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Odjavi se</a>
      </li>
      </ul>
      <span class="nav-item" text-align="right">
        <a class="nav-link" href="profil.php"><?php echo "Ulogovani ste kao ".$user?></a>
      </span>
  </div>
</nav>


<?php
}else{?>
  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      
        <a class="nav-link" href="pocetna.php">Početna strana</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="urediPonudu.php">Uredi ponudu</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="dodajUslugu.php">Dodaj uslugu </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="spisakRezervacija.php">Sve rezervacije</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="grafik.php">Statistika</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Odjavi se</a>
      </li>
      </ul>
      <span class="nav-item" text-align="right">
        <a class="nav-link" href="profil.php"><?php echo "Ulogovani ste kao ".$user?></a>
      </span>
  </div>
</nav>
<?php } ?>
<div class="jumbotronC" style="background-image: url('img/bg.jpg');">
<br>
<br>
   <div class="jumbotron" style="margin-left:150px; margin-right:150px; background-color:rgba(50, 115, 220,0)">
  <div class="container">
   <div class="row">
  
  <div class="col-md-2 col-ld-2"></div>
  <div class="col-md-7 col-ld-7">

  <?php
  
}


function donjiDeo(){
    ?>
</div>
  <div class="col-md-2 col-ld-2">
</div>
  </div>
</div>
</div>

</body>

</html>



    <?php
}
  ?>
  