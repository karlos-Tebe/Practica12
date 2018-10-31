<?php

if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}
?>

<div class="page-body text-center ">
  <div class="row">
    <div class="col-sm-12">

      <!-- Register your self card start -->
      <div class="card ">
        <div class="card-header">
          <h1 class="text-info"><i class="fa fa-database" style="font-size: 36px;"></i>&nbsp;Stock</h1>
          <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i></div>
        </div>
        <div class="card-block">
          <div class="j-wrapper j-wrapper-640">
            <form method="post" class="j-pro md-float-material" id="j-pro">
              <div class="j-content">
				<?php
					$vistaStock = new Controlador_MVC();
					$vistaStock -> editarStockProductoController();
					$vistaStock -> actualizarStockProductoController();
				?>
			</form>
          </div>
        </div>
      </div>
      <!-- Register your self card end -->
    </div>
  </div>
</div>