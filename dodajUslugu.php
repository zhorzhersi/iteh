<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");

include_once("izgled.php");

?>


<body>
       
<h1>Dodaj uslugu </h1>
<hr>

<div id="dodavanje">
  <form role="form" action="upload.php" method="post" enctype="multipart/form-data">
 
 <div class="form-group">
      <label for="ime">Naziv usluge:</label>
      <input name="ime"type="text" class="form-control" id="ime" placeholder="Unestite naziv usluge" required>
    </div>
    <div class="form-group">
	 <label for="kategorije">Kategorija usluge:</label><br>
  <select id="kategorijaID" name="kategorijaID" style="width:100%;color:black;padding:10px;"> 
  <?php
  $db->dajKategorije();
  

      while($red=$db->getResult()->fetch_object()){?>
    <option value='<?php echo $red->kategorijaID; ?>'>
    <?php echo $red->naziv; ?></option>
    <?php
    }
    ?>
</select>

 </div>
 
 <div class="form-group">
      <label for="cena">Cena:</label>
      <input name="cena"type="text" class="form-control" id="starost" placeholder="Unesite cenu" required>
    </div>
    
	<div class="form-group">
      <label for="opis">Opis:</label>
      <input name="opis"type="text" class="form-control" id="opis" placeholder="Unesite opis usluge" required>
    </div>
		
	Fotografija <br>
  <input type="file" name="slika" id="fileToUpload">
  <br>
  <br>
  <button type="submit" name="submit" class="btn btn-secondary">Dodaj novu uslugu</button>

  </form>
</div>


<?php donjiDeo();?>
