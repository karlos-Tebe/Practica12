<?php 
	//session_start();
	if(!isset($_SESSION["validar"])){
		header("Location: index.php?action=admin");
		exit();
	}

?>

<div class="col-lg-12">		
<?php

	$vistaPagos = new Controlador_MVC();
	$vistaPagos -> vistaCategoriasController();
	
?>
</div>
