<?php 
$respuesta = "Unknown";
if (isset($_SESSION['user'])) {
  $respuesta = UsuarioData::editarUsuarioModel($_SESSION['user'],'usuarios');
  $respuesta = $respuesta['nombre'].' '.$respuesta['apellidos'];
}
 ?>
<nav class="navbar header-navbar pcoded-header">
  <div class="navbar-wrapper">

    <div class="navbar-logo">
      <a class="mobile-menu" id="mobile-collapse" href="#!">
        <i class="ti-menu"></i>
      </a>
      <a class="mobile-search morphsearch-search" href="#">
            <i class="ti-search"></i>
      </a>
      <a href="index.php" >
        <!--img class="img-fluid" src="./default/assets/images/logo.png" alt="Theme-Logo" /-->
        <i class="icofont icofont-box" style="font-size: 40px;"></i><h4>Sys Inventory</h4>

      </a>
      <a class="mobile-options">
            <i class="ti-more"></i>
        </a>
    </div>

    <div class="navbar-container container-fluid">
      <ul class="nav-left">
        <li>
                          <div class="sidebar_toggle">
                            <a href="javascript:void(0)"><i class="ti-menu"></i></a>
                          </div>
        </li>                        
        <li>
          <a href="#!" onclick="javascript:toggleFullScreen()">
            <i class="ti-fullscreen"></i>
          </a> 
        </li>                       
      </ul>
      <ul class="nav-right">                                                        
        <li class="user-profile header-notification">
          <a class="text-primary" href="#!">
            <img src="./default/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
            <span><?php echo $respuesta; ?></span>
            <i class="ti-angle-down"></i>
          </a>
          <ul class="show-notification profile-notification">                      
            <li>
              <a class="text-info" href="index.php?action=perfil">
                <i class="ti-user"></i> Perfil
              </a>
            </li>                                    
            <li>
              <a class="text-danger" href="index.php?action=salir">
                <i class="ti-power-off"></i> Salir
              </a>
            </li>
          </ul>
        </li>
      </ul>              
    </div>
  </div>
</nav>