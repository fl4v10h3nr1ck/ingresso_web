<?php

header('Content-type: text/html; charset=UTF-8');

chdir(dirname(__FILE__)); 

chdir('../');

include_once getcwd().'/define.php';



class Base{



	function __construct(){
		
	date_default_timezone_set('UTC');	
	}
	
	
	
	
	public function validaChave($chave){
		
		if(strlen($chave)>0){
		
			$cv  ="";
		
			if (strpos($chave, '@') !== false) {
			
				$aux = explode("@", $chave);
			
				if(count($aux)!=2 ||  $aux[0]<=0 || strlen($aux[1])==0)
					return false;
				
				$cv  =$aux[1];
			}
			else
				$cv  =$chave;
		
		
			if(strcmp($cv, CHAVE)!=0)
				return false;

			return true;
		}
		
		return false;
	}

	
	
	
	public function getVersao($chave){
		
		if(strlen($chave)>0){
		
			if (strpos($chave, '@') !== false) {
			
				$aux = explode("@", $chave);
			
				if(count($aux)!=2 ||  $aux[0]<=0 || strlen($aux[1])==0)
					return 1;
				
				return $aux[0];
			}
			else
				return 1;
		}
		
		return 1;
	}
	
	
	
	


	public function get(){}




	
	
	function getNumero($valor){
		
	return $valor==null || strlen($valor)==0?"0":intval($valor);
	}
	

	
	
	
	
	
	function getJSon($valores){
	
	$retorno  ="{";
	
		if(count($valores)){
			foreach($valores as $valor){
			
				if(strlen($valor[0])>0){
			
				$retorno  .='"'.$valor[0].'":';		
				
				if(strlen($valor[1])==0 || strcmp($valor[1], "int")!=0)
				$retorno  .='"'.$valor[2].'"';		
				else
				$retorno  .= $this->getNumero($valor[2]);	
				
				$retorno  .=',';		
				}
			}
		}
			
	$retorno = (substr($retorno, strlen($retorno)-1, 1)==","?
					substr($retorno, 0, strlen($retorno)-1):$retorno);		
	
	return $retorno."}";	
	}
	
	
	
	

	
    function preparaStringRecebida($valor){

	$valor = str_replace("_vel_", "#", $valor);
	$valor = str_replace("_ec_",  "&", $valor);
	$valor = str_replace("_iq_",  "=", $valor);
	$valor = str_replace("_es_",  " ", $valor);
	
	$valor = str_replace("_a1_", "á", $valor);
    $valor = str_replace("_a2_", "â", $valor);
    $valor = str_replace("_a3_", "à", $valor);
    $valor = str_replace("_a4_", "ã", $valor);
    $valor = str_replace("_e1_", "é", $valor);
    $valor = str_replace("_e2_", "ê", $valor);
    $valor = str_replace("_i1_", "í", $valor);
    $valor = str_replace("_o1_", "ó", $valor);
    $valor = str_replace("_o2_", "ô", $valor);
    $valor = str_replace("_o3_", "õ", $valor);
    $valor = str_replace("_u1_", "ú", $valor);
    $valor = str_replace("_c1_", "ç", $valor);
    
	$valor = str_replace("_A1_", "Á", $valor);
    $valor = str_replace("_A2_", "Â", $valor);
    $valor = str_replace("_A3_", "À", $valor);
    $valor = str_replace("_A4_", "Ã", $valor);
    $valor = str_replace("_E1_", "É", $valor);
    $valor = str_replace("_E2_", "Ê", $valor);
    $valor = str_replace("_I1_", "Í", $valor);
    $valor = str_replace("_O1_", "Ó", $valor);
    $valor = str_replace("_O2_", "Ô", $valor);
    $valor = str_replace("_O3_", "Õ", $valor);
    $valor = str_replace("_U1_", "Ú", $valor);
    $valor = str_replace("_C1_", "Ç", $valor);
	
	$valor = str_replace("_as2_", "\"", $valor);
    $valor = str_replace("_as1_", "\'", $valor);
    
	//$valor = str_replace(SPR, '"', $valor);
	
	return $valor;
    }

	
	
	

	
    function preparaStringParaEnviar($valor){

    $valor = str_replace("\"", "_as2_", $valor);
    $valor = str_replace("'", "_as1_", $valor);
	$valor = str_replace("#", "_vel_", $valor);
    $valor = str_replace("&", "_ec_", $valor);
    $valor = str_replace("=", "_iq_", $valor);
	$valor = str_replace(" ", "_es_", $valor);
	
	$valor = str_replace("á", "_a1_", $valor);
    $valor = str_replace("â", "_a2_", $valor);
    $valor = str_replace("à", "_a3_", $valor);
    $valor = str_replace("ã", "_a4_", $valor);
    $valor = str_replace("é", "_e1_", $valor);
    $valor = str_replace("ê", "_e2_", $valor);
    $valor = str_replace("í", "_i1_", $valor);
    $valor = str_replace("ó", "_o1_", $valor);
    $valor = str_replace("ô", "_o2_", $valor);
    $valor = str_replace("õ", "_o3_", $valor);
    $valor = str_replace("ú", "_u1_", $valor);
    $valor = str_replace("ç", "_c1_", $valor);
   
	$valor = str_replace("Á", "_A1_", $valor);
    $valor = str_replace("Â", "_A2_", $valor);
    $valor = str_replace("À", "_A3_", $valor);
    $valor = str_replace("Ã", "_A4_", $valor);
    $valor = str_replace("É", "_E1_", $valor);
    $valor = str_replace("Ê", "_E2_", $valor);
    $valor = str_replace("Í", "_I1_", $valor);
    $valor = str_replace("Ó", "_O1_", $valor);
    $valor = str_replace("Ô", "_O2_", $valor);
    $valor = str_replace("Õ", "_O3_", $valor);
    $valor = str_replace("Ú", "_U1_", $valor);
    $valor = str_replace("Ç", "_C1_", $valor);
	
	
	return $valor;
    }


	


	
	
}
	
	
?>