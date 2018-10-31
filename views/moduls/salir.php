<!-- Container-fluid starts -->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">       
        
        <div class="auth-box common-img-bg">
          <div class="row m-b-20">
        <div class="col-md-12">        
            <h3 class="text-center text-danger">
            	<i class="ti-power-off" style="font-size: 30px;"></i>            	            
            </h3>
        </div>
          </div>
          <div class="row m-b-20">
            <div class="col-md-12"> 
              <center>
        			<?php
        				//session_start();
        				if (isset($_SESSION['validar'])) {
        					$_SESSION['validar'] = null;
        					$_SESSION["rol"] = null;
        					$_SESSION["password"] = null;
        					session_destroy();
        			?>
			        <h5>Ha salido de la aplicacion.</h5>
        			<?php
        			  }else{
        			?>
        			<h5>No ha ingresado a la aplicacion.</h5>
        			<?php
        				}
        			?>
              </center>
 		        </div>
          </div>
          <div class="input-group">
          	<a href="index.php?action=ingresar" class="btn btn-block btn-outline-danger">
                Login&nbsp;<i class="fa fa-lock"></i>     
            </a>
          </div>
	      </div>
  	  <!-- /.auth-box -->

    </div>
    <!-- end of col-sm-12 -->
    </div>
    <!-- end of row -->
</div>
<!-- end of container-fluid -->

