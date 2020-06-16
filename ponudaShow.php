<?php 

    header('Access-Control-Allow-Origin: *');

    include_once('izgled.php');
    donjiDeo();

    $uslugaID = $_GET['id'];

    $ponistavam = $_SESSION['login_user'];

    $jsonobj = json_decode($db->dajUsluge());

    if(isset($_POST['rezervisi'])){
        // echo "ponistavam ispite";
        $db->zakaziTermin($ponistavam, $uslugaID, $_POST['datum']);
    }

?>

<div class="container-fluid">
    <div class="row">
    


<?php foreach ($jsonobj as $u):  ?>

<?php if($u->uslugaID == $uslugaID){ ?>

<div class="col-md-8 offset-md-2">


  <div class="konverzija" style="margin-top: -6rem; margin-bottom: 4rem;">
    <h2>Konverzija</h2>

<form action="ponudaShow.php?id=<?php echo $id; ?>" method="GET">
<input type="hidden" name="id" value="<?php echo $uslugaID; ?>">
    Iznos: <br><input type = "number" id="iznos" name = "iznos"/><br>
    Iz valute:<select id="izvalute" name ="izvalute">
      <option value="EUR">EUR</option>
      <option value="USD">USD</option>
      <option value="RSD">RSD</option>
      <option value="CHF">CFH</option>
    </select>
    <br>
    U valutu:<select id="uvalutu" name ="uvalutu">
      <option value="EUR">EUR</option>
      <option value="USD">USD</option>
      <option value="RSD">RSD</option>
      <option value="CHF">CFH</option>
    </select> <br>
    <input type = "submit" id="konvertuj" value="konvertuj">
     <p id="rezultat">Rezultat: <span id="rezultatspan"></span></p>
  </form>

     <?php if (!empty ($_GET['iznos'])&&!empty ($_GET['izvalute'])&&!empty ($_GET['uvalutu'])){?>

      <?php
      $iznos = $_GET['iznos'];
      $izvalute = $_GET['izvalute'];
      $uvalutu = $_GET['uvalutu'];
      $url = 'https://api.kursna-lista.info/0e0156083e1ccc17dc40319ca542628a/konvertor/'.$izvalute.'/'.$uvalutu.'/'.$iznos;
      //echo $url; //ispiisuje url he he
      $curl = curl_init($url);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, false);
      $curl_odgovor = curl_exec($curl);
      curl_close($curl);
      $parsiran_json = json_decode ($curl_odgovor);

      ?>
      <h2>Rezultat:</h2>
      <p><?php echo $iznos;?> <?php echo $izvalute;?> vredi <?php echo $parsiran_json->result->value;?> <?php echo $uvalutu;?>.</p>

      <?php
      }
      ?>


  </div>
  


    <div class="card mb-3">
  <a href="./ponudaShow?id=<?php echo $u->uslugaID; ?>"><h3 class="card-header"> <?php echo $u->nazivUsluge; ?></h3></a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $u->cena; ?> RSD</h5>
    
  </div>
  <img style="height: 500px; width: 100%; display: block;" src="<?php echo $u->slika; ?>" alt="Card image">
  <div class="card-body">
    <p class="card-text"><?php echo $u->opis; ?></p>
  </div>
  
 
  
</div>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Zakazite termin</h4>
   <?php
    if ($u->dostupnost=="da"){
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
 $(function() {
    // $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $('input[name ="datum"]').datepicker();

  });
  </script>
<form method="post" class="forma" style="margin-left:1cm;margin-right:1cm;float: left;">
<input type="text" id="datepicker<?php echo $u->uslugaID; ?>" name="datum" placeholder="Datum koji zelite" style="color:black;padding:7px;margin-right:1cm;" required>
<input type="submit" class="btn btn-primary" name="rezervisi" value="Zakazi termin">
</form>

<?php
}
else{//ako nema dostupnog datuma
?>	
<legend><h2 style="text-align:center;color:red;">Ovaj termin nije dostupan!</h2></legend> 
<?php
}
?>
  </div>
</div>

</div>
<?php  } ?>

<?php endforeach; ?>
</div>
</div>