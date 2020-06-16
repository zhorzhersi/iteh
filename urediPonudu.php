<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include_once('izgled.php');
?>

 <script>
$(document).ready(function(){
	$(".tabela").dataTable().makeEditable({
		sUpdateURL: "izmeniUslugu.php",
		sDeleteURL: "brisiIzPonude.php",
        sDeleteHttpMethod: "GET",
		
	});
});
</script>
<style>

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
	if($red->status=="admin"){	
		
?>
<h1> Uredi ponudu </h1>
<table class="tabela display" >
<thead>
<tr>
<th>ID</th>
<th>Naziv usluge</th>
<th>Kategorija</th>
<th>Cena</th>
<th>Opis usluge</th>
<th>Slika</th>
<th>Dostupnost usluge</th>
</tr>
</thead>
<tbody>
<?php
$db->prikaziUsluge();
if ($db->getResult()->num_rows > 0) {
    while($row = $db->getResult()->fetch_object()) {
	?>
<tr id="<?php echo $row->uslugaID;?>">

	<td><?php echo $row->uslugaID;?></td>
	<td><?php echo $row->nazivUsluge;?></td>
	<td><?php echo $row->naziv;?></td>
	<td><?php echo $row->cena;?></td>
	<td><?php echo $row->opis;?></td>
	<td><img style="width:100px;"src="<?php echo $row->slika;?>"/></td>
	<td><?php echo $row->dostupnost;?></td>
</tr>
<?php
	
	}
}
?>
</tbody>
</table>
<button id="btnDeleteRow" class="btn btn-warning" style="margin-left:4cm;font:Verdana;font-size:20px;">
<span class="glyphicon glyphicon-remove"></span> Ukloni uslugu iz ponude</button>
</body>
<?php
	}
	donjiDeo();
	?>
