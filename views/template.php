<?php 
   session_start();
?>
<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" class="js flexbox flexboxlegacy canvas canvastext webgl touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths cssscrollbar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="#">
  <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
  <meta name="author" content="#">
  
  <title>Sistema de Inventario</title>

  <!-- Favicon icon -->
  <link rel="icon" href="./default/assets/images/favicon.ico" type="image/x-icon">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
  <!-- Required Fremwork -->
  <link rel="stylesheet" type="text/css" href="./bower_components/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" type="text/css" href="./bower_components/font-awesome/css/font-awesome.min.css">
  <!-- themify-icons line icon -->
  <link rel="stylesheet" type="text/css" href="./default/assets/icon/themify-icons/themify-icons.css">
  <!-- ico font -->
  <link rel="stylesheet" type="text/css" href="./default/assets/icon/icofont/css/icofont.css">
  <!-- flag icon framework css -->
  <link rel="stylesheet" type="text/css" href="./default/assets/pages/flag-icon/flag-icon.min.css">
  <!-- Menu-Search css -->
  <link rel="stylesheet" type="text/css" href="./default/assets/pages/menu-search/css/component.css">
  <!-- hover-effect.css -->
  <link rel="stylesheet" type="text/css" href="./default/assets/pages/hover-effect/normalize.css">
  <link rel="stylesheet" type="text/css" href="./default/assets/pages/hover-effect/set2.css">
  <!-- Style.css -->
  <link rel="stylesheet" type="text/css" href="./default/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="./default/assets/css/jquery.mCustomScrollbar.css">
  <!-- jpro forms css -->
  <link rel="stylesheet" type="text/css" href="./default/assets/pages/j-pro/css/j-pro-modern.css">
  <!-- Time line css -->
  <link rel="stylesheet" type="text/css" href="./default/assets/pages/timeline/style.css">

</head>
<body>
  <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

  <?php 
    /* Navegacion */
 
    
    if(isset($_SESSION["validar"])){
      // Si hay sesion se muestra navegacion de administrador
        include_once 'moduls/Admin-navigation.php';
    }
   ?>

 
        <div class="pcoded-main-container" style="margin-top: 80px;">
          <div class="pcoded-wrapper">            
            <?php 
              if(isset($_SESSION["validar"])){
                // Si hay sesion se muestra navegacion de administrador
                  include_once 'moduls/Navigation.php';
              }
             ?>
            <div class="pcoded-content"> 
              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                    
                     <?php 
                          # Controladores 
                          $controler = new Controlador_MVC();;
                          $controler -> linksController();;
                      ?>
                    
                  </div>
                  <!-- /.page-wrapper -->
                </div>
                <!-- /.main-body -->
              </div> 
              <!-- /.pcoded-inner-content -->
            </div>
            <!-- /.pcoded-content -->
          </div>
        </div>
        <!-- /.pcoded-main-container -->
  
  </div> <!-- /.pcoded-container navbar-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="./bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="./bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="./bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="./bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="./bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="./bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="./bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- am chart -->
    <script src="./default/assets/pages/widget/amchart/amcharts.min.js"></script>
    <script src="./default/assets/pages/widget/amchart/serial.min.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="./bower_components/chart.js/js/Chart.js"></script>
    <!-- Todo js -->
    <script type="text/javascript" src="./default/assets/pages/todo/todo.js "></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="./bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="./bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="./bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="./bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- Custom js -->
   
    <script type="text/javascript" src="./default/assets/js/SmoothScroll.js"></script>
    <script src="./default/assets/js/pcoded.min.js"></script>
    <script src="./default/assets/js/demo-12.js"></script>
    <script src="./default/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="./default/assets/js/script.min.js"></script>
    <!-- j-pro js -->
    <script type="text/javascript" src="./default/assets/pages/j-pro/js/jquery.ui.min.js"></script>
    <script type="text/javascript" src="./default/assets/pages/j-pro/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="./default/assets/pages/j-pro/js/jquery.j-pro.js"></script>   
</body>
</html>
