<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
require 'flight/Flight.php';

Flight::register('db', 'Database', array('baza'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci );

Flight::route('/', function(){


});

Flight::route('GET /usluge.json', function(){
	header ("Content-Type: application/json; charset=utf-8");?>{"usluga":<?php
	$db = Flight::db();
	$db->dajUsluge();
	$niz=array();
	while ($red=$db->getResult()->fetch_object()){
		$niz[] = $red;
	}
	$json_niz = json_encode ($niz,JSON_UNESCAPED_UNICODE);
	echo indent($json_niz);
	?> }<?php
	return false;
});

Flight::route('GET /korisnici.json', function(){
	header ("Content-Type: application/json; charset=utf-8");?>{"korisnici":<?php
	$db = Flight::db();
	$db->dajKorisnike();
	$niz=array();
	while ($red=$db->getResult()->fetch_object()){
		$niz[] = $red;
	}
	$json_niz = json_encode ($niz,JSON_UNESCAPED_UNICODE);
	echo indent($json_niz);
	?> }<?php
	return false;
});

Flight::route('GET /korisnici.xml', function(){
	
//definiše se mime type
header("Content-type: application/xml");
//konekcija ka bazi
$db = Flight::db();
$db->dajKorisnike();

//kreiranje XMLDOM dokumenta
$dom = new DomDocument('1.0','utf-8');

//dodaje se koreni element
 $korisnici = $dom->appendChild($dom->createElement('korisnici'));

//izvršavanje upita
if (!$q=$db->getResult()){
//ako se upit ne izvrši
  //dodaje se element <greska> u korenom elementu <proizvodi>
 $greska = $korisnici->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Došlo je do greške pri izvršavanju upita"));
} else {
//ako je upit u redu
if ($q->num_rows>0){
//ako ima rezultata u bazi
$niz = array();
while ($red=$q->fetch_object()){
  
 $korisnik = $korisnici->appendChild($dom->createElement('korisnik'));

 
 $korisnickoime = $korisnik->appendChild($dom->createElement('korisnickoime'));
 
 $korisnickoime->appendChild($dom->createTextNode($red->korisnickoime));

 
 $sifra = $korisnik->appendChild($dom->createElement('sifra'));

 $sifra->appendChild($dom->createTextNode($red->sifra));


$ime = $korisnik->appendChild($dom->createElement('ime'));

$ime->appendChild($dom->createTextNode($red->ime));


$prezime = $korisnik->appendChild($dom->createElement('prezime'));

$prezime->appendChild($dom->createTextNode($red->prezime));


$email = $korisnik->appendChild($dom->createElement('email'));

$email->appendChild($dom->createTextNode($red->email));


$datumregistracije = $korisnik->appendChild($dom->createElement('datumregistracije'));

$datumregistracije->appendChild($dom->createTextNode($red->datumregistracije));


$status = $korisnik->appendChild($dom->createElement('status'));

$status->appendChild($dom->createTextNode($red->status));
 
}
} else {
//ako nema rezultata u bazi
  //dodaje se element <greska> u korenom elementu <proizvodi>
 $greska = $proizvodi->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Nema unetih korisnika"));
}
}
//cuvanje XML-a
$xml_string = $dom->saveXML(); 
echo $xml_string;
//zatvaranje konekcije.

	return false;
});

Flight::route('GET /usluge/@uslugaID.json', function($id){
	header ("Content-Type: application/json; charset=utf-8");?>{"usluge":<?php
	$db = Flight::db();
	$db->traziPremaId($id);
	$niz=array();
	while ($red=$db->getResult()->fetch_object()){
		$niz[] = $red;
	}
	$json_niz = json_encode ($niz,JSON_UNESCAPED_UNICODE);
	echo indent($json_niz);
	?> }<?php
	return false;
});





Flight::route('POST /rezervisi', function(){
	header ("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	
	$podaci_json = Flight::get("json_podaci");
	$podaci = json_decode ($podaci_json);
	if ($podaci == null){
	$odgovor["poruka"] = "Niste prosledili podatke";
	$json_odgovor = json_encode ($odgovor);
	echo $json_odgovor;
	return false;
	} else {
	if (!property_exists($podaci,'usluga')||!property_exists($podaci,'datum')||!property_exists($podaci,'korisnik')){
			$odgovor["poruka"] = "Niste prosledili sve...";
			$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
	
	} else {
			$podaci_query = array();
			foreach ($podaci as $k=>$v){
				$v = "'".$v."'";
				$podaci_query[$k] = $v;
			}
			if ($db->insert("rezervacija", "uslugaID, korisnik, datum", array($podaci_query["usluga"], $podaci_query["korisnik"],$podaci_query["datum"]))
			&& ($db->updateDostupnost($podaci_query["usluga"]))
			){
				$odgovor["poruka"] = '<div class="alert alert-success">Uspešno ste rezervisali psa!'.$podaci_query["usluga"].'</div>';
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			} else {
				$odgovor["poruka"] = '<div class="alert alert-danger">Već ste rezervisali ovaj datum!</div>';
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
	}
	}	
	}
);


Flight::route('PUT /usluga/@id', function($id){
	header ("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci_json = Flight::get("json_podaci");
	$podaci = json_decode ($podaci_json);
	if ($podaci == null){
	$odgovor["poruka"] = "Niste prosledili podatke";
	$json_odgovor = json_encode ($odgovor);
	echo $json_odgovor;
	} else {
	if (!property_exists($podaci,'opis')||!property_exists($podaci,'naziv')){
			$odgovor["poruka"] = "Niste prosledili korektne podatke";
			$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
	
	} else {
			$podaci_query = array();
			foreach ($podaci as $k=>$v){
				$v = "'".$v."'";
				$podaci_query[$k] = $v;
			}
			if ($db->update(array($id,$podaci->opis,$podaci->naziv))){
				$odgovor["poruka"] = "Ova usluga je izmenjena!";
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			} else {
				$odgovor["poruka"] = "Usluga nije izmenjena!";
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
	}
	}	

});
Flight::route('DELETE /korisnici/@id', function($id){
		header ("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		if ($db->delete("korisnici", array("korisnickoime"),array($id))){
				$odgovor["poruka"] = "Profil je obrisan!";
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
		} else {
				$odgovor["poruka"] = "Profil nije obrisan!";
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
		
		}		
				
});


Flight::start();
?>
