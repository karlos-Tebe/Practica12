<div class="page-body text-center ">
  <div class="row">
    <div class="col-sm-12">

      <!-- Register your self card start -->
      <div class="card common-img-bg">
        <div class="card-header">
          <h2><i class="fa fa-user-plus" style="font-size: 36px;"></i>&nbsp;Login</h2>
          <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i></div>
        </div>
        <div class="card-block">
          <div class="j-wrapper j-wrapper-640">
            <form method="post" class="j-pro md-float-material" id="j-pro">
              <div class="j-content">

                <!-- start usuario -->
                  <div>
                    <div>
                      <label class="j-label ">Usuario:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="usuarioIngreso">
                          <i class="icofont icofont-user"></i>
                        </label>
                        <input type="text" required id="usuarioIngreso" name="usuarioIngreso" placeholder="Usuario">
                      </div>
                    </div>
                  </div>
                <!-- end usuario -->

                <!-- start password -->
                  <div>
                    <div>
                      <label class="j-label ">Contraseña:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="passwordIngreso">
                          <i class="fa fa-lock"></i>
                        </label>
                        <input type="password" required id="passwordIngreso" name="passwordIngreso" placeholder="Contraseña">
                      </div>
                    </div>
                  </div>
                <!-- end password -->
                
                <!-- start response from server -->
                <div class="j-response"></div>
                <!-- end response from server -->
              </div>
              <!-- end /j.content -->
              <div class="j-footer">
                  <button type="submit" name="SubmitUsuario" class="btn btn-dark">Ingresar <i class="fa fa-chevron-circle-right"></i></button>
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

$ingreso = new Controlador_MVC();
$ingreso -> SessionController();

if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		     ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="alert alert-danger background-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="icofont icofont-close-line-circled text-white"></i>
        </button>
        <strong>Error!</strong> Falló al ingresar.
      </div>
    </div>
  </div>
  <?php
	}
}

?>
