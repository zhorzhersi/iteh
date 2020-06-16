<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include('izgled.php');
?>
<head>
<script>
$(document).ready(function(){
	$(".tabela").dataTable().makeEditable({
		sDeleteURL: "otkaziRez.php",
        sDeleteHttpMethod: "GET",
		language: {
  sUrl: "DataTables-1.10.4/i18n/serbian.json"
},
		aoColumns: [ //sprecava izmenu polja
            null,
            null,
            null,
            null ,
			null,
			null,
			null,
			null
        ]
	});
});
</script>
<style type="text/css">
.row_selected td {
    background-color: #d3d3d3 !important; /* Add !important to make sure override datables base styles */
}
.tabela{
text-align:center;
}
th{
text-align:center;
}
#DataTables_Table_0_wrapper{
border-radius:10px;
font-family:Trebuchet MS;
font-size:12px;
background-color:rgba(250, 250, 250, 0.7);
width:80%;

}
</style>
</head>
<body>
 <?php

?>


<h1 id="sveRezervacije">Sve rezervacije</h1>  
<table class="tabela display"  width="100%">
<thead>
<tr>
<th>Id Rezervacije</th>
<th>Korisnik</th>
<th>Ime usluge</th>
<th>Opis usluga</th>
<th>Datum</th>
<th>Slika</th>
</tr>
</thead>
<tbody>
<?php
$db->dajSveRezervacije($login_session);
if ($db->getResult()->num_rows > 0) {
    while($row=$db->getResult()->fetch_object()) {
	?>
<tr id="<?php echo $row->rezervacijaId;?>">

	<td><?php echo $row->rezervacijaId;?></td>
	<td><?php echo $row->korisnik;?></td>
	<td><?php echo $row->nazivUsluge?></td>
	<td><?php echo $row->opis;?></td>
	<td><?php echo $row->datum;?></td>
	<td><img style="width:100px;"src="<?php echo $row->slika;?>"></td>

</tr>
<?php
	
	}
}
	
?>
</tbody>
</table>
<button id="btnDeleteRow" class="btn btn-danger"  style="padding:20px;position:relative;left:130px;top:20px;">
<span class="glyphicon glyphicon-circle-arrow-down"></span> Otkaži rezervaciju</button>
<?php donjiDeo(); ?>