
<?php
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "php_logs.log");
include('izgled.php');


if($red->status=="admin"){
?>
    <!--Ucitava se API biblioteka za Google Charts-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">  
    // Ucitava se API za vizuelizaciju 
    google.load('visualization', '1', {'packages':['corechart']});  
    // Šalje povratni poziv kada se ucita API
    google.setOnLoadCallback(crtajGrafik);
    // Funkcija šalje asinhrono JSON podatke, koje PHP fajl podaci.php generiše iz baze
    function crtajGrafik() {
      var jsonData = $.ajax({
      url: "http://localhost/zub/analizaIznajmljivanja.php",
      dataType:"json",
      async: false
    }).responseText;  
    // Kreira se tabela sa podacima na osnovu poslatih JSON podataka
    var data = new google.visualization.DataTable(jsonData);
    //data.setColumns([0,1]);
    var options = {'title':'Analiza po broju zakazanih termina',
	    titleTextStyle: {
		textAlign: 'center',	
	fontSize: 22},
	  'width':800,
      'height':500,
	  };
 var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data,  options);

  }
   
</script>

</head>

<body>

<div id="chart" >
<div id="chart_div"></div>
</div> 
</body>
<?php
}
donjiDeo();
?>

