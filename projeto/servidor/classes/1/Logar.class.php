<?php

	
final class Logar extends Base{



	public function get(){
	
		$subquery = "";
		$token = "";

	
		if(array_key_exists("params", $_POST) && strlen($_POST["params"])>0){
		
			$parans = json_decode($_POST["params"]);
		
			if(is_object($parans))
			$subquery  =" and nome='".$parans->nome."' and senha='".hash('sha256', $parans->senha)."'";	
			
		}
	
		if(strlen($subquery)==0)
		return '{"status":"ERRO", "erro":"USER_INV", "msg":""}';	
	
		include_once getcwd().'/bd/BdOp.class.php';
	
		$bd = new BdOp();
	
		$reg = $bd->get("select * from usuarios where status>0 ".$subquery);
	
		if(count($reg)>0){
			
			$retorno  ='{"status":"OK", "msg":"", "valores":[';	
		
			$valor = $reg[0];
		
			$valores=array();  	
			$valores[] 				= array("id_remoto", 		"int", 	$valor["id_usuario"]);
			$valores[] 				= array("nome", 			NULL, 	$this->preparaStringParaEnviar($valor["nome"]));
		
			$retorno  .= $this->getJSon($valores);	
		
			$retorno.= ']}';

			return $retorno;		
		}
		
	return '{"status":"ERRO", "erro":"USER_INV", "msg":""}';
	}
	
	
}
	
	
?>