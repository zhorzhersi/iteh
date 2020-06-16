<?php
    include_once("izgled.php");
    donjiDeo();
	//if($red->statuss!="admin"){	
?>

<h1 style="text-align:center;color:black;">Usluge</h1>

<hr>

	<?php 
        // $url = 'localhost/kuce/psi.json';
        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        // curl_setopt($curl, CURLOPT_POST, false);

        // $curl_odgovor = curl_exec($curl);
        // curl_close($curl);
        // $jsonobj = json_decode($curl_odgovor);
        $jsonobj = json_decode($db->dajUsluge());

	 ?>
	 
     <div class="container-fluid">
     <div class="row">

<?php foreach ($jsonobj as $u):  ?>

<div class="col-md-4">

    <div class="card mb-3">
  <a href="./ponudaShow.php?id=<?php echo $u->uslugaID; ?>"><h3 class="card-header"> <?php echo $u->nazivUsluge; ?></h3></a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $u->cena; ?> RSD</h5>
    
  </div>
  <img style="height: 200px; width: 100%; display: block;" src="<?php echo $u->slika; ?>" alt="Card image">
  <div class="card-body">
    <p class="card-text"><?php echo $u->opis; ?></p>
  </div>
  
 
  
</div>
</div>

<?php endforeach;


    
    ?>

</div>
</div>


    <?php
// donjiDeo();
?>



