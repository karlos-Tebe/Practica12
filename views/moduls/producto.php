<?php

if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}
?>

<div class="page-body gallery-page">
	<div class="row">
		<div class="col-lg-12">
			<?php
				$vistaProducto = new Controlador_MVC();
				$vistaProducto->verProductoController();
			?>
		</div>
	</div>
</div>	