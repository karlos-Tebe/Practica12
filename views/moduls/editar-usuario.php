<?php
if(isset($_GET["cambio"])){
  if($_GET["cambio"] == "true"){
  
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="alert alert-success background-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="icofont icofont-close-line-circled text-white"></i>
        </button>
        <strong>Exito!</strong> Usuario actualizado.
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
          <h2 class="text-success"><i class="fa fa-user" style="font-size: 36px;"></i>&nbsp;Editar Usuario</h2>
          <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i></div>
        </div>
        <div class="card-block">
          <div class="j-wrapper j-wrapper-640">
            <form method="post" class="j-pro" id="j-pro">
              <div class="j-content">          
      				<?php 

      				$editarUsuario = new Controlador_MVC();	
      				$editarUsuario -> editarUsuarioController();
      				$editarUsuario -> actualizarUsuarioController();

      				?>
            </form>
          </div>
        </div>
      </div>
      <!-- Register your self card end -->
    </div>
  </div>
</div>
