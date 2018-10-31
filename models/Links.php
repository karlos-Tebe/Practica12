<?php 

class Pages{
	
	public static function linksModel($links){

		if($links == "ver-productos" || $links == "ver-usuarios" || $links == "ver-categorias" 
			|| $links == "registro-producto" || $links == "registro-usuario" 
			|| $links == "registro-categoria" || $links == "registro-historial"
			|| $links == "editar-producto" || $links == "editar-categoria" || $links == "editar-usuario"
			|| $links == "eliminar-producto" || $links == "eliminar-usuario" || $links == "eliminar-categoria"
			|| $links == "salir" || $links == "producto" || $links == "stock" )
		{
			$module =  "views/moduls/".$links.".php";
		}else if($links == "ingresar"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "login"){
			$module =  "views/moduls/login.php";
		}else if($links == "ok"){
			$module =  "views/moduls/inicio.php?";
		}else if($links == "fallo"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "cambio"){
			$module =  "views/moduls/inicio.php";
		}else{
			$module =  "views/moduls/inicio.php";
		}
		return $module; 
	}
}

?>