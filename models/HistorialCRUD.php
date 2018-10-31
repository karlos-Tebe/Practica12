<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class HistorialData extends DBConnector{

	# METODO PARA REGISTRAR EN EL HISTORIAL
	#-------------------------------------
	public static function newHistorialModel($HistorialModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (producto, usuario, fecha, nota, referencia, cantidad) VALUES (:producto, :usuario, CURDATE(), :nota, :referencia, :cantidad)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":producto", $HistorialModel["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $HistorialModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nota", $HistorialModel["nota"], PDO::PARAM_INT);
		$stmt->bindParam(":referencia", $HistorialModel["referencia"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $HistorialModel["cantidad"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE HISTORIAL
	#-------------------------------------

	public static function viewHistorialModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN HISTORIAL
	#------------------------------------
	public static function deleteHistorialModel($HistorialModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $HistorialModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA OBTENER HISTORIAL DE UN PRODUCTO ESPECIFICO
	#------------------------------------
	public static function getHistorialProductoModel($HistorialModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE producto = :producto");
		$stmt->bindParam(":producto", $HistorialModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetchAll();
		}else{
			return "error";
		}
		$stmt->close();
	}	

}
?>
