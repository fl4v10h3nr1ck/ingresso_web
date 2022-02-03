 <?php


class Gandalf{


	
	public function usuarioAtual(){
		
		include_once IGRSS_PATH_ABS.'usuarios/BeanUsuario.class.php';
		
		if(array_key_exists("usuario", $_SESSION) && $_SESSION['usuario']!=null)
			return unserialize($_SESSION['usuario']);
	
		return null;
	}
	
	
}


?>