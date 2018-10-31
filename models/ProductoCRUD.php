<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class ProductoData extends DBConnector{

	# METODO PARA REGISTRAR NUEVO PRODUCTO
	#-------------------------------------
	public static function newProductoModel($ProductoModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (codigo, nombre, fecha_registro, precio, stock, categoria, ruta_imagen) VALUES (:codigo, :nombre, CURDATE(), :precio, :stock, :categoria, :ruta_imagen)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":codigo", $ProductoModel["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $ProductoModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $ProductoModel["precio"]);
		$stmt->bindParam(":stock", $ProductoModel["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":categoria", $ProductoModel["categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":ruta_imagen", $ProductoModel["ruta_imagen"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE PRODUCTOS
	#-------------------------------------

	public static function viewProductosModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	# METODO PARA BORRAR UN PRODUCTO
	#------------------------------------
	public static function deleteProductoModel($ProductoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $ProductoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN PRODUCTO
	#------------------------------------
	public static function editarProductoModel($ProductoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $ProductoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN PRODUCTO
	#------------------------------------
	public static function actualizarProductoModel($ProductoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET codigo=:codigo, nombre=:nombre, precio=:precio, categoria=:categoria WHERE id = :id");
		$stmt->bindParam(":codigo", $ProductoModel["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $ProductoModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $ProductoModel["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $ProductoModel["categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $ProductoModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}


	# METODO PARA ACTUALIZAR STOCK DE UN PRODUCTO
	#------------------------------------
	public static function ProductoStockModel($ProductoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET stock=:stock WHERE id=:id");
		$stmt->bindParam(":stock", $ProductoModel["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $ProductoModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}
?>
