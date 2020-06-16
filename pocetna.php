<?php
include_once('izgled.php');

?>


<br>
<div class="jumbotron" style=" background-color:rgba(50, 115, 220,0)">
  <h1 class="display-3">ZUB ordinacija</h1>
  
  <hr class="my-4">
  <p><h3>Administratorski deo</h3></p>
  <p class="lead">


  </p>
</div>

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