<?php

	
final class Validacao extends Base{



	public function get(){
	
		if(array_key_exists("params", $_POST) && strlen($_POST["params"])>0){
		
			$parans = json_decode($_POST["params"]);
		
			if(is_object($parans)){
			
				if(strlen($parans->codigo)==12){
			
					include_once getcwd().'/bd/BdOp.class.php';
	
					$bd = new BdOp();
			
					$reg = $bd->get("select * from ingressos where codigo='".$parans->codigo."'");
	
					if(count($reg)>0){
					
						$retorno  ='{"status":"OK", "msg":"", "valores":[';	
		
						$ingresso = $reg[0];
		
						$valores=array();  	
						$valores[] 	= array("codigo", 		NULL, 	$ingresso["codigo"]);
						
						if($ingresso["usado"]>0){
							
							$valores[] 	= array("usado", 		"int", 	1);
							$valores[] 	= array("data_usado", 	NULL, 	$ingresso["data_usado"]);
							$valores[] 	= array("hora_usado", 	NULL, 	$ingresso["hora_usado"]);
							$valores[] 	= array("min_usado", 	NULL, 	$ingresso["min_usado"]);
						}
						else{
							
							$valores[] 	= array("usado", 		"int", 	0);
							
							$reg = $bd->get("select * from lotes where id_lote=".$ingresso["fk_lote"]);
	
							if(count($reg)>0){
							
								$lote = $reg[0];
						
								$valores[] 	= array("lote_cod", 	NULL, 	$lote["codigo"]);
								$valores[] 	= array("lote_preco", 	NULL, 	$lote["preco"]);
								
								$reg = $bd->get("select * from entidades where id_entidade=".$lote["fk_tipo"]);
	
								if(count($reg)>0){
									
									$tipo = $reg[0];

									$valores[] 	= array("lote_tipo", 	NULL, 	$tipo['nome']);
								}
								
								
								$reg = $bd->get("select * from subeventos where id_subevento=".$lote["fk_subevento"]);
	
								if(count($reg)>0){
									
									$subevento = $reg[0];

									$valores[] 	= array("evento_data", 			NULL, 	$subevento['data']);
									$valores[] 	= array("evento_hora_inicio", 	NULL, 	$subevento['hora_inicio']);
									$valores[] 	= array("evento_hora_fim", 		NULL, 	$subevento['hora_fim']);
								
								
									$reg = $bd->get("select * from eventos where id_evento=".$subevento["fk_evento"]);
	
									if(count($reg)>0){
										
										$evento = $reg[0];
										
										$valores[] 	= array("evento_nome", 		NULL, 	$evento['nome']);
									}
								}	
							}
						}
					
						$bd->atualiza("ingressos", "id_ingresso", $ingresso["id_ingresso"], 
										array("usado", "data_usado", "hora_usado", "min_usado"), 
										array(1, date("Y-m-d"), date("H"), date("i")));
					
						$retorno  .= $this->getJSon($valores);	
		
						$retorno.= ']}';

						return $retorno;
					}
				}		
			}		
		}
		
		return '{"status":"ERRO", "erro":"PARANS_INV", "msg":""}';
	}
	
	
}
	
	
?>