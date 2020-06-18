<?php
// error_reporting(E_ALL | E_STRICT);
// ini_set("display_errors", 0);
// ini_set("log_errors", 1);
// ini_set("error_log", "php_logs.log");...

define('SALT', '!"#$%&/()=$%DFGBHJfghJ$%677$%');
class Database {
	private $hostname = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "baza";
	private $dblink;
	private $result = true;
	private $records;
	private $affectedRows;


	function __construct($dbname)
	{
		$this->$dbname = $dbname;
		$this->Connect();
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
	function __destruct()
	{
	$this->dblink->close();
	//echo "Konekcija prekinuta";
	}
	
	function Connect()
	{
		$this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
		if($this->dblink->connect_errno)
		{
			printf("Konekcija neuspesna: %s\n",  $mysqli->connect_error);
			exit();
		}
		$this->dblink->set_charset("utf8");
	}

	
function dajRezervacije($login_session){
	$sql = "SELECT * FROM rezervacija r INNER JOIN usluga u ON (r.uslugaID=u.uslugaID) JOIN kategorije on (kategorije.kategorijaID=u.kategorijaID) WHERE korisnik='".$login_session."'";
	$this->ExecuteQuery($sql);
	}
	function dajSveRezervacije(){
		$sql = "SELECT * FROM rezervacija r INNER JOIN usluga u ON (r.uslugaID=u.uslugaID) INNER JOIN korisnici k ON (r.korisnik=k.korisnickoime) JOIN kategorije ka on (ka.kategorijaID=u.kategorijaID)";
	
		$this->ExecuteQuery($sql);
		}		

	function traziPremaId($id) {
		
		$this->dblink->query("SET NAMES 'utf8'");
		$podatak=mysqli_real_escape_string($this->dblink,$id);
		$q = "SELECT * FROM usluga u JOIN kategorije ka ON ka.kategorijaID=u.kategorijaID WHERE uslugaID=$id";
		$this->ExecuteQuery($q);
	}	
	
	function prikaziUsluge() {
		$q = "SELECT * FROM usluga join kategorije k on (k.kategorijaID=usluga.kategorijaID)";
		$this->ExecuteQuery($q);
	}	

	function login($podatak,$podatak1) {
		$podatak =  $this->dblink->real_escape_string($podatak);
$podatak1 =  $this->dblink->real_escape_string($podatak1);
$podatak = md5(SALT . md5($podatak));
		$q = "select * from korisnici where sifra='$podatak' AND korisnickoime='$podatak1'";
		$this->ExecuteQuery($q);
	}
	function prikaziKorisnika($podatak) {
		$this->dblink->set_charset("utf8");
		$podatak= $this->dblink->real_escape_string($podatak);
		$q = "SELECT * FROM korisnici WHERE korisnickoime='$podatak'";
		$this->ExecuteQuery($q);
	}

	function delete ($table,  $keys, $values)
{
$delete = "DELETE FROM ".$table." WHERE ".$keys[0]." = '".$values[0]."'";

if ($this->ExecuteQuery($delete))
return true;
else return false;
}

function insert ($table, $rows, $values)
{
$query_values = implode(',',$values);
$insert = 'INSERT INTO '.$table;  
            if($rows != null)  
            {  
                $insert .= ' ('.$rows.')';   
            }  
			$insert .= ' VALUES ('.$query_values.')';
			
if ($this->ExecuteQuery($insert))
return true;
else return false;
}
	public function registracijaKorisnika($podaci)
	{	

$prvi=mysqli_real_escape_string($this->dblink,$podaci[0]);
$drugi=mysqli_real_escape_string($this->dblink,$podaci[1]);
$drugi = md5(SALT . md5($drugi));
$treci=mysqli_real_escape_string($this->dblink,$podaci[2]);
$cetvrti=mysqli_real_escape_string($this->dblink,$podaci[3]);
$peti=mysqli_real_escape_string($this->dblink,$podaci[4]);
$sesti=mysqli_real_escape_string($this->dblink,$podaci[5]);
$sql = "INSERT INTO korisnici (korisnickoime, sifra,ime, prezime,email, datumregistracije) VALUES 
('". $prvi."', '".$drugi."', '".$treci."', '". $cetvrti."', '". $peti."', '". $sesti."')";
if ($this->ExecuteQuery($sql))
return true;
else return false;
 }

 function update($data) {
	$query = "UPDATE usluga SET opis='". $data[1]. "',naziv='".$data[2]."' WHERE uslugaID ='" .$data[0]."'";	
		
	if($this->ExecuteQuery($query))
	{
		return true;
	}
	else
	{
		return false;
	}
	$mysqli->close();
}

function updateDostupnost($uslugaID) {
	$query = "UPDATE usluga SET dostupnost='ne' WHERE uslugaID =" .$uslugaID;	
		
	if($this->ExecuteQuery($query))
	{
		return true;
	}
	else
	{
		return false;
	}
	$mysqli->close();
}

	function ubaciUslugu ($podaci){

		$naziv=mysqli_real_escape_string($this->dblink,$podaci[0]);
		$cena=mysqli_real_escape_string($this->dblink,$podaci[1]);
		$opis=mysqli_real_escape_string($this->dblink,$podaci[2]);
		$slika=mysqli_real_escape_string($this->dblink, $podaci[3]['name']);
		$kategorijaID=mysqli_real_escape_string($this->dblink,$podaci[4]);

		$slika = "img/" . $slika; 

		#$sql = "INSERT INTO pas (ime, rasaId, opis,starost,velicina,pol, slika) VALUES ('". $ime."', '". $rasa."','". $opis."','". $starost."','". $velicina."','". $pol."','". $slika."')";
		// $sql = "INSERT INTO usluga (nazivUsluge, cena, opis,slika,kategorijaID) VALUES ('".$naziv."', ".$cena.",'". $opis."','". $slika."','". $kategorijaID."')";

		$sql = "INSERT INTO usluga (nazivUsluge, cena, opis, slika, kategorijaID) VALUES ('$naziv', '$cena', '$opis', '$slika', '$kategorijaID')";

		// echo $sql;
		if ($this->ExecuteQuery($sql))
			return true;
		else 
			return false;
	}
function dajKategorije() {
	$q = "SELECT * FROM kategorije";
	$this->ExecuteQuery($q);
}


function dajKorisnike() {
		
	$q = "SELECT * FROM korisnici";	
	$this->ExecuteQuery($q);	
}


function dajUsluge(){
	$query = "SELECT * FROM usluga";
	$result = $this->dblink->query($query);

	$dbdata = array();

	while ( $row = $result->fetch_assoc())  {
		$dbdata[]=$row;
	}

	//Print array in JSON format
	return json_encode($dbdata);
}

function zakaziTermin($itsaprank, $uslugaID, $datum){
	$sql = "INSERT INTO rezervacija (korisnik, uslugaID, datum) VALUES ('$itsaprank', '$uslugaID', '$datum')";
	// $result = $this->dblink->query($query);
	$this->ExecuteQuery($sql);
}


	function ExecuteQuery($query)
	{
		if($this->result = $this->dblink->query($query)){
			if (isset($this->result->num_rows)) $this->records         = $this->result->num_rows;
				if (isset($this->dblink->affected_rows)) $this->affected        = $this->dblink->affected_rows;
					// echo "Uspesno izvrsen upit";
					return true;
		}	
		else{
			return false;
		}
	}
}
?>

<?php
include('jsonindent.php');
?>
