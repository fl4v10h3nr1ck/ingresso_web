<?php

header('Content-type: text/html; charset=UTF-8');

chdir(dirname(__FILE__)); 

include_once getcwd().'/classes/Base.class.php';

$base = new Base;

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


//$_POST['cv'] = CHAVE;
//$_POST['tp'] = "Validacao";
//$_POST["params"] = '{"codigo":"274545958650"}';

	
//include_once "classes/1/ProcessaPagamento.class.php";						
//$pag = new 	ProcessaPagamento(4);
//echo $pag->getPagamento();

	
	
	if(array_key_exists("cv",$_POST) && 
			$base->validaChave($_POST["cv"]) && 
				array_key_exists("tp",$_POST) && 
					strlen($_POST["tp"])>0){
	
	include_once "classes/".($base->getVersao($_POST["cv"])."/").$_POST["tp"].'.class.php';
	
	$op = new $_POST['tp'];
	
		if($op!=null){
	
		if(array_key_exists("params", $_POST) && strlen($_POST["params"])>0)
		$_POST["params"] = $op->preparaStringRecebida($_POST["params"]);
	
		echo $op->get();
		}
		else
		echo '{"status":"ERRO", "erro":"TP_INV", "msg":"Tipo de operação inválida"}';	
	}
	else
	echo '{"status":"ERRO", "erro":"CV_INV", "msg":"Chave de acesso inválida"}';

	
	

?>