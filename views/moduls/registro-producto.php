<?php
//session_start();
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
        <strong>Exito!</strong> Producto registrado.
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
          <h2 class="text-danger"><i class="fa fa-cube" style="font-size: 36px;"></i>&nbsp;Registrar Producto</h2>
          <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i></div>
        </div>
        <div class="card-block">
          <div class="j-wrapper j-wrapper-640">
            <form method="post" class="j-pro" id="j-pro">
              <div class="j-content">

              	<!-- start codigo -->
                  <div>
                    <div>
                      <label class="j-label ">Codigo:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="codigo">
                          <i class="icofont icofont-ui-check text-danger"></i>
                        </label>
                        <input type="text" required placeholder="Codigo" id="codigo" name="codigo">
                      </div>
                    </div>
                  </div>
                <!-- end codigo -->
                
                <!-- start name -->
                  <div>
                    <label class="j-label">Nombre:</label>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="nombre">
                          <i class="icofont icofont-ui-user text-danger"></i>
                        </label>
                        <input type="text" required placeholder="Nombre" id="nombre" name="nombre">
                      </div>
                    </div>
                  </div>
                <!-- end name -->

                <!-- start precio -->
                  <div>
                    <label class="j-label">Precio:</label>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="precio">
                          <i class="fa fa-dollar text-danger"></i>
                        </label>
                        <input type="number" class="form-control" required step="any" min="1" placeholder="0.0" id="precio" name="precio">
                      </div>
                    </div>
                  </div>
                <!-- end precio -->                                

                <!-- start password -->
                  <div>
                    <div>
                      <label class="j-label ">Stock:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="stock">
                          <i class="icofont icofont-box text-danger"></i>
                        </label>
                        <input type="number" class="form-control" min="1" id="stock" name="stock" placeholder="Stock" required>
                      </div>
                    </div>
                  </div>
                <!-- end password -->

                <!-- start email -->
                  <div>
                    <div>
                      <label class="j-label">Categoria:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="email">
                          <i class="icofont icofont-envelope text-danger"></i>
                        </label>
                        <select name="categoria" required>
                        	<option value="" selected disabled>Seleciona un categoria</option>
                          <?php $categorias = CategoriaData::viewCategoriasModel('categorias'); ?>
                          <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['id']; ?>">
                              <?php echo $categoria['nombre']; ?>                                
                            </option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                <!-- end email -->

                <!-- start imagen -->
                  <div>
                    <div>
                      <label class="j-label ">Imagen:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="ruta_imagen">
                          <i class="icofont icofont-image text-danger"></i>
                        </label>
                        <input type="file" id="ruta_imagen" name=ruta_imagen" accept="">
                      </div>
                    </div>
                  </div>
                <!-- end imagen -->

                <!-- start response from server -->
                  <div class="j-response"></div>
                <!-- end response from server -->
              </div>
              <!-- end /j.content -->
              <div class="j-footer">
                  <button type="submit" name="GuardarProducto" class="btn btn-danger">Registrar <i class="fa fa-cube"></i></button>
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
//se invoca la función nuevoAlumnoController de la clase MvcController:
$registro -> nuevoProductoController();

?>
