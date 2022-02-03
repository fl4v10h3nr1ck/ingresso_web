<?php


include_once IGRSS_PATH_ABS.'login/Gandalf.class.php';	

include_once IGRSS_CMS_PATH_ABS.'Comuns.class.php';

include_once IGRSS_BD_PATH_ABS."BdUtil.class.php";




	
abstract class Base{


public $gandalf;



	function __construct() {
		
		$this->gandalf = new Gandalf;
	}


	
	
	function dependencias(){}


	
	function conteudo(){}
	

	
	
	final function erro($msg){
		
		return "
		
			<div class='erro' align='center'>
				<img src='".AGRCL_PATH_IMGS."erro.png' id='icon'>
				<br><br>".$msg."
				<br><br><br><a href='".AGRCL_PATH_SMP."'>Voltar à tela principal</a>
				<br><br><a href='".AGRCL_PATH_SMP."'>Entrar em contato com o suporte técnico</a>
			</div>
		
		";	
	}
	
	
	
}	

?>