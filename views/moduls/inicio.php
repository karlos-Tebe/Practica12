<?php

if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}

?>

<div class="page-header card">
  <div class="row align-items-end">
    <div class="col-lg-12">
      <div class="page-header-title">
        <i class="icofont icofont-box bg-c-green" style="font-size: 50px;"></i>
        <div class="d-inline">
          <h1 class="text-success">Inventario</h1>          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-block">
        <div class="row">
          
          <div class="col-lg-12">

            <?php 
            $productos = ProductoData::viewProductosModel("productos"); 
            ?>
    

              <div class="row">
          
              <?php foreach ($productos as $producto => $p): ?>
                
              <div class="col-lg-3">
                <div class="card gallery-desc">
                  <div class="masonry-media">
                    <a class="media-middle" href="index.php?action=producto&idProducto=<?php echo $p['id']; ?>">
                      <img class="img-fluid" src="default/assets/images/gallery-grid/masonry-2.jpg" alt="masonary">
                    </a>
                  </div>
                  <div class="card-block">
                    <h6 class="job-card-desc"><?php echo $p['nombre']; ?></h6>
                      <div class="job-meta-data">                        
                        <h3><i class="fa fa-cubes"></i><?php echo $p['stock']; ?></h3> &nbsp;
                        <h6><i class="fa fa-barcode"></i><?php echo $p['codigo']; ?></h6>
                      </div>
                  </div>
                </div>
              </div>

              <?php endforeach ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>