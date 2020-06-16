<?php
include_once('izgled.php');

?>

<?php
	if($red->status!="admin"){	
?>
	  

<br>
<div class="jumbotron" >



<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2832.3951835176144!2d20.473021615534467!3d44.772748179098905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a705762824603%3A0xd25f20d59ad94e55!2z0IjQvtCy0LUg0JjQu9C40ZvQsCAxNjQsINCR0LXQvtCz0YDQsNC0!5e0!3m2!1ssr!2srs!4v1580817840382!5m2!1ssr!2srs" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
	      
          <div class="col-sm-3">
      <?php include 'sidebar2.php'; ?>
  </div>

  
</div>

  </p>
</div>
<?php
}
else{
include("admin.php");
}
?>




</body>
</html>