
<?php
// Clase para devolver una conexion a una base de datos especifica.
class DBConnector
{
	
	public static function connect()
	{
		// Devuelve la conexion a la base de datos.
		$tmp_conn = new PDO("mysql:host=localhost;dbname=practica12;","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
		return $tmp_conn;
	}

}

?>
