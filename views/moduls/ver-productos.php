<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

?>

<div class="col-lg-12">	
<?php

	$vistaProductos = new Controlador_MVC();
	$vistaProductos -> vistaProductosController();
	
?>
</div>