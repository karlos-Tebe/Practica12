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
        <strong>Exito!</strong> Usuario registrado.
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
          <h2 class="text-success"><i class="fa fa-user-plus" style="font-size: 36px;"></i>&nbsp;Registrar Usuario</h2>
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
                          <i class="icofont icofont-ui-user text-success"></i>
                        </label>
                        <input type="text" required placeholder="Nombre(s)" id="nombre" name="nombre">
                      </div>
                    </div>
                  </div>
                <!-- end nombre -->

                <!-- start apellidos -->
                  <div>
                    <label class="j-label">Apellidos:</label>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="apellidos">
                          <i class="icofont icofont-ui-user text-success"></i>
                        </label>
                        <input type="text" required placeholder="Apellidos" id="apellidos" name="apellidos">
                      </div>
                    </div>
                  </div>
                <!-- end apellidos -->                

                <!-- start usuario -->
                  <div>
                    <div>
                      <label class="j-label ">Usuario:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="usuario">
                          <i class="icofont icofont-tick-mark text-success"></i>
                        </label>
                        <input type="text" required placeholder="Usuario" id="usuario" name="usuario">
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
                        <label class="j-icon-right" for="PW1">
                          <i class="icofont icofont-lock text-success"></i>
                        </label>
                        <input type="password" id="PW1" name="password1" placeholder="Contraseña" required>
                      </div>
                    </div>
                  </div>
                <!-- end password -->

                <!-- start Confirm password -->
                  <div>
                    <div>
                      <label class="j-label ">Confirmar Contraseña:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="password">
                          <i class="icofont icofont-lock text-success"></i>
                        </label>
                        <input type="password" id="PW2" name=password2" placeholder="Confirmar contraseña" required>
                      </div>
                    </div>
                  </div>
                <!-- end Confirm password -->

                <!-- start email -->
                  <div>
                    <div>
                      <label class="j-label">Email:</label>
                    </div>
                    <div class="j-unit">
                      <div class="j-input">
                        <label class="j-icon-right" for="email">
                          <i class="icofont icofont-envelope text-success"></i>
                        </label>
                        <input type="email" id="email" name="email" placeholder="E-Mail" required class="form-control">
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
                          <i class="icofont icofont-image text-success"></i>
                        </label>
                        <input type="file" id="ruta_imagen" name="ruta_imagen" accept="/*.imagen">
                      </div>
                    </div>
                  </div>
                <!-- end imagen -->

                <script type="text/javascript">
                  document.getElementById("PW2").onchange = function(e){
                    var PW1 = document.getElementById("PW1");
                    if(this.value != PW1.value ){
                      alert("Contraseñas no coinciden.");
                      PW1.focus();
                      this.value = "";
                    }
                  };
                </script>

                <!-- start response from server -->
                  <div class="j-response"></div>
                <!-- end response from server -->
              </div>
              <!-- end /j.content -->
              <div class="j-footer">
                  <button type="submit" name="GuardarUsuario" class="btn btn-success">Registrar <i class="fa fa-user"></i></button>
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
$registro -> nuevoUsuarioController();

?>