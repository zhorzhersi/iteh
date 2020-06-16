<?php
include_once('izgled.php');

?>

<?php
	if($red->status!="admin"){	
?>
	  

<br>
<div class="jumbotron" style=" background-color:rgba(50, 115, 220,0)">
  <h1 class="display-3">ZUB ordinacija</h1>
  
  <hr class="my-4">
  <p>Hvala na ukazanom poverenju! 10 godina sa vama</p>
  <p class="lead">


<div class="w3-content w3-display-container">
  <img class="mySlides" src="img/slika1.jpg" style="width:100%">
  <img class="mySlides" src="img/slika2.jpg" style="width:100%">
  <img class="mySlides" src="img/slika3.jpg" style="width:100%">

  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

  </p>
</div>
<?php
}
else{

include("pocetna.php");
}
?>

<script>

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}

</script>


</body>
</html>