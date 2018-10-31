<?php

if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

if(isset($_GET["resp"])){
  if($_GET["resp"] == "ok"){
     ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="alert alert-success background-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="icofont icofont-close-line-circled text-white"></i>
        </button>
        <strong>Exito!</strong> Categoria registrada.
      </div>
    </div>
  </div>
  <?php
  }
}
?>

<div class="page-body">
  <div class="row">
    <div class="col-sm-12">

      <!-- Register your self card start -->
      <div class="card">
        <div class="card-header">
          <h2 class="text-warning"><i class="fa fa-ticket" style="font-size: 36px;"></i>&nbsp;Registrar Categoria</h2>
          <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i></div>
        </div>
        <div class="card-block">
          <div class="j-wrapper j-wrapper-640">
            <form method="post" class="j-pro" id="j-pro">
              <div class="j-content">
                
                <!-- start nombre -->
                  <div>
                    <label class="j-label">Nombre:</label>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="nombre">
                          <i class="fa fa-ticket"></i>
                        </label>
                        <input type="text" required id="nombreCategoria" name="nombreCategoria" placeholder="Nombre">
                      </div>
                    </div>
                  </div>
                <!-- end nombre -->

                <!-- start descripcion -->
                  <div>
                    <label class="j-label">Descripcion:</label>
                    <div class="j-unit">
                      <div class="j-input ">                        
                        <textarea required placeholder="Descripcion" id="descripcionCategoria" name="descripcionCategoria"></textarea>
                      </div>
                    </div>
                  </div>
                <!-- end descripcion -->                

                <!-- start response from server -->
                  <div class="j-response"></div>
                <!-- end response from server -->
              </div>
              <!-- end /j.content -->
              <div class="j-footer">
                   <button type="submit" name="GuardarCategoria" class="btn btn-warning">Guardar <i class="fa fa-ticket"></i></button>
              </div>
              <!-- end /j.footer -->
            </form>
          </div>
        </div>
      </div>
      <!-- Register your self card end -->
    </div>
  </div>
</div>

	   
	  
	  

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevaCategoriaController();

?>