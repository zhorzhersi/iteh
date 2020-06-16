<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
//Uzimaju se sirovi HTTP POST body podaci
$post_podaci = @file_get_contents('php://input');
require "konekcija.php";
include "jsonindent.php";
//definiše se mime type
header("Content-type: application/json");?>
	<?php
	$array['cols'][] = array('label' => 'Korisnik','type' => 'string');
    $array['cols'][] = array('label' => 'Broj usluga', 'type' => 'number');
 
$sql="SELECT korisnik,count(rezervacijaId) AS 'ukupno' FROM rezervacija r INNER JOIN usluga u ON (u.uslugaID=r.uslugaID) GROUP BY korisnik";
if (!$q=$mysqli->query($sql)){
//ako se upit ne izvrši
echo '{"greska":"Nastala je greška pri izvršavanju upita."}';
exit();
} else {
                     //ako je upit u redu
if ($q->num_rows>0){  //ako ima rezultata u bazi

$niz[] = array();
while ($red=$q->fetch_object()){ 
 $array['rows'][] = array('c' => array( array('v'=>$red->korisnik),array('v'=>(double)$red->ukupno)) );

}

$niz_json = json_encode ($array);
$niz_json = indent($niz_json);
print ($niz_json);
} else {
//ako nema rezultata u bazi
echo '{"greska":"Nema rezultata."}';
}
}?>	
<?php
$mysqli->close();
?>
