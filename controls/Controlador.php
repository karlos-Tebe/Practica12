<?php 

/**
* Clase controlador que permite la funcionabilidad del sistema 
* por medio de MVC.
*/
class Controlador_MVC
{
	// Metodo que permite mostrar la plantilla de la pagina
	public function showPage()
	{
		include "views/template.php";
	}

	// Metodo que permite el control de los enlaces y las vistas finales.
	public function linksController()
	{
		if(isset( $_GET['action'])){ // Se obtiene el valor de la variable action
			$enlaces = $_GET['action'];		
		}else{ // De lo contrario se le asigna el valor index
			$enlaces = "index";
		}

		// Obtenemos la respuesta del modelo
		$respuesta = Pages::linksModel($enlaces); 

		include $respuesta;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Total de Registros  en la BD +++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function DataBaseTablesCounterController()
	{
		$usuarios = UsuarioData::viewUsuariosModel("usuarios");
		$productos = ProductoData::viewProductosModel("productos");
		$historial = HistorialData::viewHistorialModel("historial");
		$categorias = CategoriaData::viewCategoriasModel("categorias");

		$counter = array(
				'usuarios'=>count($usuarios),
				'productos'=>count($productos),
				'historial'=>count($historial),
				'categorias'=>count($categorias)
			);

		return $counter;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para el Tipo de Sesion ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function SessionController()
	{
		if(isset($_POST["SubmitUsuario"])){
			
				$datosController = array( 
					"usuario"=>$_POST["usuarioIngreso"], 
					"password"=>$_POST["passwordIngreso"]
				);

				$this->ingresoUsuarioController($datosController);

		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteUsuarioController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = UsuarioData::deleteUsuarioModel($datosController, "usuarios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de usuarios
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=usuarios';
			  	</script>";
			}
		}
	}

	# REGISTRO DE USUARIOS
	#------------------------------------
	public function nuevoUsuarioController(){

		if(isset($_POST["GuardarUsuario"])){
			//Recibe a traves del método POST el name (html) de username y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre, apellidos, username, password):
			$datosController = array(
				'nombre' =>$_POST['nombre'],
				'apellidos'=>$_POST['apellidos'],
				'usuario'=>$_POST['usuario'],				
				"password"=>$_POST['password1'],
				"email"=>$_POST['email'],
				'ruta_imagen'=>$_POST['ruta_imagen']
			);

			//Se le dice al modelo models/UsuarioCrud.php (UsuarioData::registroUsuarioModel),que en la clase "UsuarioData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = UsuarioData::newUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-usuario&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------
	public function vistaUsuariosController(){

		$respuesta = UsuarioData::viewUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card bg-light">

        <div class="card-header">
            <h1 class="card-title text-success"><i class="icofont icofont-brand-myspace" style="font-size:32px;">&nbsp;</i>Usuarios</h1>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Usuario</th>						
						<th>Password</th>
						<th>E-Mail</th>
						<th>Registrado</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $usuario){
				echo'<tr>
					<td><span class="badge badge-success">'.$usuario["id"].'</span></td>
					<td>'.$usuario["nombre"].'</td>
					<td>'.$usuario["apellidos"].'</td>
					<td>'.$usuario["usuario"].'</td>
					<td><span class="badge badge-success">'.crypt($usuario["password"],'YYL').'</span></td>
					<td>'.$usuario["email"].'</td>
					<td>'.$usuario["fecha_registro"].'</td>					
					<td><a href="index.php?action=editar-usuario&idUsuario='.$usuario["id"].'"><i class="fa fa-gear fa-spin text-info"></i></a></td>
					<td><a href="index.php?action=eliminar-usuario&idUsuarioBorrar='.$usuario["id"].'"><i class="icofont icofont-ui-delete text-danger"></i></a></td>
					</tr>
				';
				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-success" href="index.php?action=registro-usuario">
	        	<i class="fa fa-user-plus"></i> Nuevo Usuario
	    	</a>
		</div>

		</div>';
	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController($datosController)
	{
			$respuesta = UsuarioData::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["usuario"] == $datosController["usuario"] && $respuesta["password"] == $datosController["password"]){
				//session_start();
				// Se crea la sesion
				$_SESSION['user'] = $respuesta['id'];
				$_SESSION["validar"] = true;
				$_SESSION["password"] = $respuesta["password"];
				
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=fallo';
			  	</script>";
			}
	}

	#EDITAR USUARIOS
	#------------------------------------
	public function editarUsuarioController(){

		$datosController = $_GET["idUsuario"];
		$respuesta = UsuarioData::editarUsuarioModel($datosController, "usuarios");

		echo'
		<input type="hidden" name="pwUser" id="pwUser" value="'.$respuesta['password'].'">        	
		<input type="hidden" name="ruta_imagen" id="ruta_imagen" value="'.$respuesta['ruta_imagen'].'">
		<!-- start id -->
          	<div>
            	<label class="j-label">ID:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="idUsuarioEditar">
	                  		<i class="fa fa-hashtag text-success"></i>
	                	</label>
	                	<input type="text" readonly id="idUsuarioEditar" name="idUsuarioEditar" value="'.$respuesta['id'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end id -->

		<!-- start nombre -->
          	<div>
            	<label class="j-label">Nombre:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="nombreUsuarioEditar">
	                  		<i class="fa fa-user text-success"></i>
	                	</label>
	                	<input type="text" required id="nombreUsuarioEditar" name="nombreUsuarioEditar" placeholder="Nombre" value="'.$respuesta['nombre'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end nombre -->

        <!-- start apellidos -->
        	<div>
	            <label class="j-label">Apellidos:</label>
	            <div class="j-unit">
	              	<div class="j-input ">
	              		<label class="j-icon-right" for="idUsuarioEditar">
		                  	<i class="fa fa-user text-success"></i>
		                </label>
	                	<input type="text" required id="apellidosUsuarioEditar" name="apellidosUsuarioEditar" placeholder="Apellidos" value="'.$respuesta['apellidos'].'">
	              </div>
	            </div>
          	</div>
        <!-- end apellidos -->

        <!-- start usuario -->
          	<div>
            	<label class="j-label">Usuario:</label>
            	<div class="j-unit">
              		<div class="j-input "> 
              			<label class="j-icon-right" for="idUsuarioEditar">
                			<i class="icofont icofont-tick-mark text-success"></i>
		        		</label>                       
                		<input type="text" required id="usuarioUsuarioEditar" name="usuarioUsuarioEditar" placeholder="Usuario" value="'.$respuesta['usuario'].'">
              		</div>
            	</div>
          	</div>
        <!-- end usuario --> 

        <!-- start email -->
          	<div>
            	<label class="j-label">E-Mail:</label>
            	<div class="j-unit">
              		<div class="j-input ">  
              			<label class="j-icon-right" for="idUsuarioEditar">
                			<i class="fa fa-envelope text-success"></i>
		        		</label>                       
                		<input type="text" required id="emailUsuarioEditar" name="emailUsuarioEditar" placeholder="E-Mail" value="'.$respuesta['email'].'">
              		</div>
            	</div>
          	</div>
        <!-- end email -->     
			
		<!-- start response from server -->
        <div class="j-response"></div>
        <!-- end response from server -->
      </div>
      <!-- end /j.content -->
      <div class="j-footer">
        <button type="submit" name="UsuarioEditar" class="btn btn-success">Actualizar  <i class="icofont icofont-ui-rotation"></i></button>
      </div>
		    		
		<!--div class="input-group mb-3">
	        <div class="input-group-prepend">
	          <span class="input-group-text"><i class="fa fa-key"></i></span>
	        </div>
				<input type="password" id="PW1" name="password1Editar" placeholder="Nueva contraseña" class="form-control">
		</div>
		

		<div class="input-group mb-3">
	        <div class="input-group-prepend">
	          <span class="input-group-text"><i class="fa fa-key"></i></span>
	        </div>
				<input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña anterior" class="form-control">
		</div>
		<script type="text/javascript">
			document.getElementById("oldPassword").onchange = function(e){
				var id = document.getElementById("pwUser");
				if(this.value != id.value ){
					alert("Error a confirmar contraseña anterior.");
					this.focus();
					this.value = "";
				}
			};
		</script-->
		';

	}

	#ACTUALIZAR USUARIOS
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["UsuarioEditar"])){

			$datosController = array( 
				"id"=>$_POST["idUsuarioEditar"],
				"nombre"=>$_POST["nombreUsuarioEditar"],
				"apellidos"=>$_POST["apellidosUsuarioEditar"],
				"usuario"=>$_POST["usuarioUsuarioEditar"],
				"password"=>$_POST["pwUser"],
		        "email"=>$_POST["emailUsuarioEditar"],
		        "ruta_imagen"=>$_POST["ruta_imagen"]
		    );
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=editar-usuario&idUsuario=".$_POST["idUsuarioEditar"]."&cambio=true';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para PRODUCTOS  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR PRODUCTO
	#------------------------------------
	public function deleteProductoController(){
		// Obtenemos el ID del alumno a borrar
		if(isset($_GET["idProductoBorrar"])){
			$datosController = $_GET["idProductoBorrar"];
			// Mandamos los datos al modelo de la alumno a eliminar
			$respuesta = ProductoData::deleteProductoModel($datosController, "productos");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de productos
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=productos';
			  	</script>";
			}
		}
	}

	# VISTA DE PRODUCTOS
	#------------------------------------

	public function vistaProductosController(){

		$respuesta = ProductoData::viewProductosModel("productos");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card">

        <div class="card-header">
            <h3 class="card-title text-danger"><i class="fa fa-cubes" style="font-size:36px;">&nbsp;</i>Productos</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Categoria</th>
						<th>Registrado</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $producto){
				$categoria = CategoriaData::editCategoriaModel($producto["categoria"],"categorias");
				echo'
				<tr>
					<td><span class="badge bg-danger">'.$producto["id"].'</span></td>
					<td>'.$producto["codigo"].'</td>
					<td>'.$producto["nombre"].'</td>
					<td><span class="badge bg-danger">$'.$producto["precio"].'</span></td>
					<td>'.$categoria['nombre'].'</td>
					<td>'.$producto['fecha_registro'].'</td>
					<td><a href="index.php?action=editar-producto&idProducto='.$producto["id"].'"><i class="fa fa-gear fa-spin text-info"></i></a></td>
					<td><a href="index.php?action=eliminar-producto&idProducto='.$producto["id"].'"><i class="icofont icofont-ui-delete text-danger"></i></a></td>				
				</tr>';

				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-danger" href="index.php?action=registro-producto">
        		<i class="fa fa-cube" style="font-size:30px;"></i> Nuevo Producto
    		</a>
		</div>

		</div>';
	}

	# REGISTRO DE PRODUCTOS
	#------------------------------------
	public function nuevoProductoController(){

		if(isset($_POST["GuardarProducto"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"codigo"=>$_POST['codigo'],
				"nombre"=>$_POST['nombre'],
				"precio"=>$_POST['precio'],
				"stock"=>$_POST['stock'],
				"categoria"=>$_POST['categoria'],
				"ruta_imagen"=>$_POST['ruta_imagen']
			);

			//Se le dice al modelo models/crud.php (ProductoData::newProductoModel),que en la clase "ProductoData", la funcion "newProductoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "productos":
			$respuesta = ProductoData::newProductoModel($datosController, "productos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-producto&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	#EDITAR PRODUCTO
	#------------------------------------
	public function editarProductoController(){

		$datosController = $_GET["idProducto"];
		$respuesta = ProductoData::editarProductoModel($datosController, "productos");
		$categorias = CategoriaData::viewCategoriasModel("categorias");
		echo'		       
		<input type="hidden" name="ruta_imagen" id="ruta_imagen" value="'.$respuesta['ruta_imagen'].'">
		<!-- start id -->
          	<div>
            	<label class="j-label">ID:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="idProductoEditar">
	                  		<i class="fa fa-hashtag text-danger"></i>
	                	</label>
	                	<input type="text" readonly id="idProductoEditar" name="idProductoEditar" value="'.$respuesta['id'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end id -->

        <!-- start codigo -->
        	<div>
	            <label class="j-label">Codigo:</label>
	            <div class="j-unit">
	              	<div class="j-input ">
	              		<label class="j-icon-right" for="codigoProductoEditar">
		                  	<i class="fa fa-barcode text-danger"></i>
		                </label>
	                	<input type="text" required id="codigoProductoEditar" name="codigoProductoEditar" placeholder="Codigo" value="'.$respuesta['codigo'].'">
	              </div>
	            </div>
          	</div>
        <!-- end codigo -->

		<!-- start nombre -->
          	<div>
            	<label class="j-label">Nombre:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="nombreProductoEditar">
	                  		<i class="fa fa-cube text-danger"></i>
	                	</label>
	                	<input type="text" required id="nombreProductoEditar" name="nombreProductoEditar" placeholder="Nombre" value="'.$respuesta['nombre'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end nombre -->

        <!-- start precio -->
          	<div>
            	<label class="j-label">Precio:</label>
            	<div class="j-unit">
              		<div class="j-input "> 
              			<label class="j-icon-right" for="precioProductoEditar">
                			<i class="fa fa-dollar text-danger"></i>
		        		</label>                       
                		<input type="number" step="any" class="form-control" required id="precioProductoEditar" name="precioProductoEditar" placeholder="0.0" value="'.$respuesta['precio'].'">
              		</div>
            	</div>
          	</div>
        <!-- end precio --> 

        <!-- start categorias -->
          	<div>
            	<label class="j-label">Categoria:</label>
            	<div class="j-unit">
              		<div class="j-input ">  
              			<label class="j-icon-right" for="categoriaProductoEditar">
                			<i class="fa fa-ticket text-danger"></i>
		        		</label>                       
                		<select required id="categoriaProductoEditar" name="categoriaProductoEditar">';
			                foreach ($categorias as $categoria) {
			                	if ($respuesta['categoria']==$categoria['id']) {
			                		echo "<option value=".$categoria['id']." selected >".$categoria['nombre']."</option>";
			                	}else{
			                		echo "<option value=".$categoria['id'].">".$categoria['nombre']."</option>";
			                	}
			                }
               	echo	'</select>
              		</div>
            	</div>
          	</div>
        <!-- end email -->     
			
		<!-- start response from server -->
        <div class="j-response"></div>
        <!-- end response from server -->
      </div>
      <!-- end /j.content -->
      <div class="j-footer">
        <button type="submit" name="ProductoEditar" class="btn btn-danger">Actualizar  <i class="icofont icofont-ui-rotation"></i></button>
      </div>
		';

	}

	#ACTUALIZAR PRODUCTO
	#------------------------------------
	public function actualizarProductoController(){

		if(isset($_POST["ProductoEditar"])){

			$datosController = array( 
				"id"=>$_POST["idProductoEditar"],
				"codigo"=>$_POST["codigoProductoEditar"],
				"nombre"=>$_POST["nombreProductoEditar"],
				"precio"=>$_POST["precioProductoEditar"],
				"categoria"=>$_POST["categoriaProductoEditar"]
		    );
			
			$respuesta = ProductoData::actualizarProductoModel($datosController, "productos");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=editar-producto&idProducto=".$_POST["idProductoEditar"]."&cambio=true';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	# EDITAR STOCK DE UN PRODUCTO
	#------------------------------------
	public function editarStockProductoController(){
		$button = '';
		$icono = '';
		$color = '';
		$mode = '';
		if(isset($_GET["modo"])){
			if($_GET["modo"] == "plus"){
				echo "<center><h3 class='text-success'>Añadir a Stock</h3></center>";
				$button = 'Añadir';
				$icono = 'icofont icofont-check-circled';
				$color = 'success';
				$mode = '+';
			}
			if($_GET["modo"] == "less"){
				echo "<center><h2 class='text-danger'>Eliminar de Stock</h2></center>";
				$button = 'Eliminar';
				$icono = 'icofont icofont-close-circled';
				$color = 'danger';
				$mode = '-';
			}
		}
		$datosController = $_GET["idProducto"];
		$respuesta = ProductoData::editarProductoModel($datosController, "productos");

		echo'        		
		<!-- start id -->
	        <input type="hidden" id="idProducto" name="idProducto" value="'.$respuesta['id'].'">
        <!-- end id -->
        <!-- start mode -->
	        <input type="hidden" id="mode" name="mode" value="'.$mode.'">
        <!-- end mode -->
		<!-- start nombre -->
          	<div>
            	<label class="j-label">Producto:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="nombreProducto">
	                  		<i class="fa fa-ticket text-'.$color.'"></i>
	                	</label>
	                	<input type="text" readonly id="nombreProducto" name="nombreProducto" placeholder="Nombre" value="'.$respuesta['nombre'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end nombre -->

        <!-- start stock -->
          <div>
            <label class="j-label">Stock:</label>
            <div class="j-unit">
	            <div class="j-input">
	            	<label class="j-icon-right" for="stockProductoEditar">
	            		<i class="icofont icofont-file-sql text-'.$color.'"></i>
	            	</label>
	            	<input type="number" class="form-control" min="1" required id="stockProductoEditar" name="stockProductoEditar" placeholder="0">
	            </div>
            </div>
          </div>
        <!-- end stock --> 

        <!-- start referencia -->
          	<div>
            	<label class="j-label">Referencia:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="referencia">
	                  		<i class="icofont icofont-paper text-'.$color.'"></i>
	                	</label>
	                	<input type="text" required id="referencia" name="referencia" placeholder="Referencia" >
	              	</div>
            	</div>
          	</div>
        <!-- end referencia -->   
			
		<!-- start response from server -->
        <div class="j-response"></div>
        <!-- end response from server -->
      </div>
      <!-- end /j.content -->
      <div class="j-footer">
        <button type="submit" name="StockEditar" class="btn btn-'.$color.'">'.$button.' <i class="'.$icono.'"></i></button>
      </div>';
	}
	
	# ACTUALIZAR STOCK DE UN PRODUCTO Y REGISTRAR AL HISTORIAL
	#------------------------------------
	public function actualizarStockProductoController(){
		if (isset($_POST['StockEditar'])) {
			$datosController = $_GET["idProducto"];
			$producto = ProductoData::editarProductoModel($datosController, "productos");
			$usuario = UsuarioData::editarUsuarioModel($_SESSION['user'], "usuarios");
			if ($_POST['mode']=="+") {				

				$stockController1 = array(
					'id'=>$producto['id'],
					'stock'=> (int)($producto['stock']+$_POST['stockProductoEditar'])
				);

				$respuesta1 = ProductoData::ProductoStockModel($stockController1, "productos");

				$historialController1 = array(
					'producto'=>$producto['id'],
					'usuario'=>$usuario['id'],
					'nota'=> $usuario['nombre']." AGREGÓ ".$_POST['stockProductoEditar']." elemento(s) al inventario.",
					'referencia'=>$_POST['referencia'],
					'cantidad'=>$_POST['stockProductoEditar']
				);

				$respuesta2 = HistorialData::newHistorialModel($historialController1, "historial");

				if($respuesta2 == "success"){
					echo "<script type='text/javascript'>
				    	window.location = 'index.php?action=producto&idProducto=".$producto['id']."';
				  	</script>";
				}else{
					echo "error";
				}
			}else{

				$stock = 0;
				if ((int)$_POST['stockProductoEditar'] > (int)$producto['stock']) {
					$stock = $producto['stock'];
				}else{
					$stock = (int)($producto['stock']-$_POST['stockProductoEditar']);
				}

				$stockController2 = array(
					'id'=>$producto['id'],
					'stock'=> $stock
				);

				$respuesta3 = ProductoData::ProductoStockModel($stockController2, "productos");

				$historialController2 = array(
					'producto'=>$producto['id'],
					'usuario'=>$usuario['id'],
					'nota'=> $usuario['nombre']." ELIMINÓ ".$_POST['stockProductoEditar']." elemento(s) del inventario.",
					'referencia'=>$_POST['referencia'],
					'cantidad'=>$_POST['stockProductoEditar']
				);

				$respuesta4 = HistorialData::newHistorialModel($historialController2, "historial");

				if($respuesta4 == "success"){
					echo "<script type='text/javascript'>
				    	window.location = 'index.php?action=producto&idProducto=".$producto['id']."';
				  	</script>";
				}else{
					echo "error";
				}
			}
		}
	}

	# VER DETALLES DE UN PRODUCTO
	#------------------------------------
	public function verProductoController(){
		$datosController = $_GET["idProducto"];
		$respuesta = ProductoData::editarProductoModel($datosController, "productos");
		$imagen = "./default/assets/images/gallery-grid/masonry-2.jpg";
		if($respuesta['ruta_imagen']){
			$imagen = "./productos/".$respuesta['ruta_imagen'];
		}
		echo'
		<div class="card background-secondary">
			<div class="card-header">
				<h2 class="text-danger"><i class="fa fa-cube"></i> '.$respuesta["nombre"].'<h2>
			</div>
    		<div class="card-block">
    			<div class="row">
		            <div class="col-lg-4">
		            	<div class="grid">
						    <figure class="effect-apollo">
						        <img src="'.$imagen.'">
						        <figcaption>
						            <h2><i class="fa fa-cubes"></i> '.$respuesta["stock"].'</h2> 
						            <p>'.$respuesta["codigo"].'</p>
						        </figcaption>
						    </figure>
						</div>
					</div>
					<div class="col-lg-8">
						<br>
						<div class="row">
							<div class="col-lg-3">
								<div>
									<div class="input">
										<a href="index.php?action=stock&modo=plus&idProducto='.$respuesta["id"].'" class="btn btn-success">Agregar stock <i class="icofont icofont-check-circled"></i></a>
									</div>
								</div>
							</div>
							<div class="col-lg-1"></div>
							<div class="col-lg-3">
								<div>
									<div class="input">
										<a href="index.php?action=stock&modo=less&idProducto='.$respuesta["id"].'" class="btn btn-danger">Quitar stock <i class="icofont icofont-close-circled"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>					
		        </div>
		        <hr color="white">
    		</div>
    		<!-- /.card-block -->
		</div>';
		$this->getHistorialProductoController($datosController);
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para CATEGORIAS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	# BORRAR CATEGORIA
	#------------------------------------
	public function deleteCategoriaController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idCategoriaBorrar"])){
			$datosController = $_GET["idCategoriaBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = CategoriaData::deleteCategoriaModel($datosController, "categorias_tutorias");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de categorias
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=categorias';
			  	</script>";
			}
		}
	}

	# REGISTRO DE UNA NUEVA CATEGORIA
	#------------------------------------
	public function nuevaCategoriaController(){

		if(isset($_POST["GuardarCategoria"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"nombre"=>$_POST['nombreCategoria'],
				"descripcion"=>$_POST['descripcionCategoria']
			);

			//Se le dice al modelo models/crud.php (CategoriaData::newCarreraModel),que en la clase "CategoriaData", la funcion "newCategoriaModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = CategoriaData::newCategoriaModel($datosController, "categorias");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-categoria&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE CATEGORIAS
	#------------------------------------
	public function vistaCategoriasController(){

		$respuesta = CategoriaData::viewCategoriasModel("categorias");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card">

        <div class="card-header">
            <h1 class="card-title text-warning"><i class="fa fa-ticket" style="font-size:26px;">&nbsp;</i>Categorias</h1>
        </div>

		<div class="card-body p-1">
		<div id="categorias_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			<div class="row">
              		<div class="col-sm-12 col-md-6">
              			<div class="dataTables_length" id="categorias_length">
              				<label>Mostrar 
              					<select name="categorias_length" aria-controls="tabla-categorias" class="form-control form-control-sm">
              					<option value="10">10</option>
              					<option value="25">25</option>
              					<option value="50">50</option>
              					<option value="100">100</option>
              					</select> registros.
              				</label>
              			</div>
              		</div>
              		<div class="col-sm-12 col-md-6">
              			<div id="example1_filter" class="dataTables_filter">
              			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla-categorias"></label>
              			</div>
              		</div> 
            </div>
			<table id="tabla-categorias" class="table table-bordered table-striped dataTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Registrado</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $categoria){
				echo'
				<tr>
					<td> <span class="badge bg-warning">'.$categoria["id"].'</span></td>
					<td>'.$categoria["nombre"].'</td>
					<td>'.$categoria["descripcion"].'</td>
					<td>'.$categoria["fecha_registro"].'</td>
					<td><a href="index.php?action=editar-categoria&idCategoria='.$categoria["id"].'"><i class="fa fa-gear fa-spin text-info"></i></a></td>
					<td><a href="index.php?action=eliminar-categoria&idCategoria='.$categoria["id"].'"><i class="icofont icofont-ui-delete text-danger"></i></a></td>				
				</tr>';

				}
				echo '</tbody>
			</table>
			</div>
		</div>

		<div class="card-footer">
			<a class="btn btn-warning" href="index.php?action=registro-categoria">
        		<i class="fa fa-ticket">+</i> Nueva Categoria
    		</a>
		</div>

		</div>';
	}

	#EDITAR CATEGORIA
	#------------------------------------
	public function editarCategoriaController(){

		$datosController = $_GET["idCategoria"];
		$respuesta = CategoriaData::editCategoriaModel($datosController, "categorias");

		echo'        		
		<!-- start id -->
          	<div>
            	<label class="j-label">ID:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="idCategoriaEditar">
	                  	<i class="fa fa-hashtag text-warning"></i>
	                	</label>
	                	<input type="text" readonly id="idCategoriaEditar" name="idCategoriaEditar" value="'.$respuesta['id'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end id -->

		<!-- start nombre -->
          	<div>
            	<label class="j-label">Nombre:</label>
            	<div class="j-unit">
	              	<div class="j-input">
	                	<label class="j-icon-right" for="nombreCategoriaEditar">
	                  	<i class="fa fa-ticket text-warning"></i>
	                	</label>
	                	<input type="text" required id="nombreCategoriaEditar" name="nombreCategoriaEditar" placeholder="Nombre" value="'.$respuesta['nombre'].'">
	              	</div>
            	</div>
          	</div>
        <!-- end nombre -->

        <!-- start descripcion -->
          <div>
            <label class="j-label">Descripcion:</label>
            <div class="j-unit">
              <div class="j-input ">                        
                <textarea required placeholder="Descripcion" id="descripcion" name="descripcionCategoriaEditar">'.$respuesta['descripcion'].'</textarea>
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
        <button type="submit" name="CategoriaEditar" class="btn btn-warning">Actualizar <i class="icofont icofont-ui-rotation"></i></button>
      </div>';
	}

	#ACTUALIZAR CATEGORIA
	#------------------------------------
	public function actualizarCategoriaController(){

		if(isset($_POST["CategoriaEditar"])){

			$datosController = array( 
				"id"=>$_POST["idCategoriaEditar"],
		        "nombre"=>$_POST["nombreCategoriaEditar"],
		        "descripcion"=>$_POST['descripcionCategoriaEditar']
		    );
			
			$respuesta = CategoriaData::updateCategoriaModel($datosController, "categorias");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=editar-categoria&idCategoria=".$_POST["idCategoriaEditar"]."&cambio=true';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para HISTORIAL ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR HISTORIAL
	#------------------------------------
	public function deleteHistorialController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idHistorialBorrar"])){
			$datosController = $_GET["idHistorialBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = MaestroData::deleteMaestroModel($datosController, "maestros");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de maestros
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=maestros';
			  	</script>";
			}
		}
	}

	# REGISTRO DE HISTORIAL
	#------------------------------------
	public function nuevoHistorialController(){

		if(isset($_POST["GuardarMaestro"])){
			//Recibe a traves del método POST el name (html) de no_empleado, carrera, nombre, apellidos, email y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (username, password):
			$datosController = array( 
				"no_empleado"=>$_POST['no_empleado'],
				"carrera"=>$_POST['carrera'],
				"nombre"=>$_POST['nombre'],
				"apellidos"=>$_POST['apellidos'],
				"email"=>$_POST['email'],
				"password"=>$_POST['password']
			);

			//Se le dice al modelo models/MaestroCrud.php (MaestroData::registroMaestroModel),que en la clase "MaestroData", la funcion "registroMaestroModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = MaestroData::newMaestroModel($datosController, "maestros");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE HISTORIAL
	#------------------------------------
	public function vistaHistorialController(){

		$respuesta = MaestroData::viewMaestrosModel("maestros");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card ">

        <div class="card-header bg-primary">
            <h3 class="card-title"><i class="fa fa-users" style="font-size:32px;">&nbsp;</i>Maestros</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-bordered table-striped dataTable">
				<thead>
					<tr>
						<th>No. Emp.</th>
						<th>Carrera</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Password</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $maestro){
				$carrera = CarreraData::editarCarreraModel($maestro["carrera"],"carreras");
				echo'<tr>
					<td><span class="badge bg-primary">'.$maestro["no_empleado"].'</span></td>
					<td>'.$carrera["abrev"].'</td>
					<td>'.$maestro["nombre"].'</td>
					<td>'.$maestro["apellidos"].'</td>
					<td>'.$maestro["email"].'</td>
					<td>'.crypt($maestro["password"],'YYL').'</td>
					<td><a href="index.php?action=editar-maestro&idMaestro='.$maestro["no_empleado"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=maestros&idBorrar='.$maestro["no_empleado"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
					</tr>
				';
				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-primary" href="index.php?action=registro-maestro">
	        	<i class="fa fa-user-plus"></i> Nuevo Maestro
	    	</a>
		</div>

		</div>';
	}

	# OBTENER HISTORIAL DE UN PRODUCTO ESPECIFICO
	#------------------------------------
	public function getHistorialProductoController($datosController){

		$respuesta = HistorialData::getHistorialProductoModel($datosController, "historial");

		echo'
		<div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class=""><i class="icofont icofont-clip-board text-info"></i>HISTORIAL</h3>
                    </div>
                    <div class="card-block">
                        <div class="main-timeline">
                            <div class="cd-timeline cd-container">';
                            if($respuesta!="error" && count($respuesta)>0){
                            	foreach ($respuesta as $historial) {
                            		echo '
	                            	<div class="cd-timeline-block">
	                                    <div class="cd-timeline-icon bg-warning">
	                                        <i class="icofont icofont-ui-file"></i>
	                                    </div>
	                                    <!-- cd-timeline-img -->
	                                    <div class="cd-timeline-content card_main">
	                                        <div class="p-20">
	                                            <div class="timeline-details">
	                                            	<a href="#">
	                                                    <i class="icofont icofont-paper"></i>
	                                                    <span>Ref: '.$historial['referencia'].'</span>
	                                                </a>
	                                                <a href="#">
	                                                    <i class="fa fa-cubes"></i>
	                                                    <span>Cantidad: '.$historial['cantidad'].'</span>
	                                                </a>
	                                            </div>
	                                        </div>
	                                        <div class="p-1">
	                                            <p>
	                                            '.$historial['nota'].'
	                                            </p>
	                                        </div>
	                                        <span class="cd-date"><i class="icofont icofont-ui-calendar"></i> '.$historial['fecha'].'
	                                        </span>
	                                    </div>
	                                    <!-- cd-timeline-content -->
	                                </div>
	                                <!-- cd-timeline-block -->  ';
                            	}
                            }else{                            
                            	echo '
                            	<div class="cd-timeline-block">
                                    <div class="cd-timeline-icon bg-warning">
                                        <i class="icofont icofont-ui-file"></i>
                                    </div>
                                    <!-- cd-timeline-img -->
                                    <div class="cd-timeline-content card_main">                                     
                                        <div class="p-20">
                                            <p>
                                            Sin Acciones
                                            </p>
                                        </div>
                                        <span class="cd-date">Sin movimientos</span>
                                    </div>
                                    <!-- cd-timeline-content -->
                                </div>
                                <!-- cd-timeline-block -->  ';
                            }
        echo'                                                             
                            </div>
                            <!-- cd-timeline -->
                        </div>
                    </div>
                </div>
            </div>
        </div>';
	}


}
?>
