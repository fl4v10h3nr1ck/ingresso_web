<?php


// possui rotinas de manipulacao da base de dados gerais.


include_once 'BdBase.class.php';
	


final class BdOp extends BdBase{




	function __construct() {
	
	parent::__construct();
	}



	
	function prepara(){
		
		if($this->getReferencia() == null){
			
		if(!$this->conecta())
		return false;		
		}
	
	return true;	
	}
	
	


			
	
	public function get($query){
	
	
	if( strlen($query) == 0 || !$this->prepara())
	return null;
	
	$dados = $this->getReferencia()->query($query);
	
	if($dados===false)
	return null;
	
	$resultado = array();
	
	while($row = $dados->fetch())
	$resultado[] = $row;	
	
	return $resultado;
	}
	
	
	
	
	
	
	
	public function aDD( $nome_tabela, $nome_campos, $campos,  &$referencia = null){
	

	if( strlen($nome_tabela) == 0 || count( $nome_campos) != count( $campos) || !$this->prepara())
	return 0;
	

	$aux = "";
	$cont = 0;
		
	$query = "insert into ".$nome_tabela." (";

	
		foreach( $nome_campos as $value){
		
		if($cont++ > 0 )
		$aux = $aux. ", ";
		
		$aux = $aux.$value;
		}
	
	$query = $query.$aux.") value (";
	$aux = "";
	$cont = 0;
		
		foreach( $campos as $value){
		
		if($cont++ > 0 )
		$aux = $aux. ", ";
		
		$aux = $aux.($value==null?" NULL ":" '".$value."' ");
		}
		
	$query = $query.$aux.")";
	

	$dados = $this->getReferencia()->query($query);
	
	if($dados===false)
	return 0;
	
	return $this->getReferencia()->lastInsertId();
	}
	
	
	
	
	
	
	
	
	public function atualiza( $nome_tabela, $nome_campo_id, $id_valor, $nome_campos, $campos, &$referencia = null){
	
	
	
	if( strlen ($nome_tabela) == 0|| 
			strlen ($nome_campo_id) == 0 || 
				count( $campos) != count( $nome_campos) || 
					$id_valor == 0 || 
						!$this->prepara())
	return false;
	
	$aux = "";
	$cont = 0;
		foreach( $campos as $value){
		
		if($cont > 0 )
		$aux = $aux. ", ";
		
		$aux = $aux. $nome_campos[$cont++]." = ".($value==null?"NULL":"'".$value."'");
		}
	
	//echo "update ".$nome_tabela." set ".$aux." where ".$nome_campo_id." = ".$id_valor;
	
	return $dados = $this->getReferencia()->query("update ".$nome_tabela." set ".$aux." where ".$nome_campo_id." = ".$id_valor);
	}
	
	

	

	
	
	public function deleta( $nome_tabela, $nome_campo_id, $id_valor, &$referencia = null){
	
	if( strlen ($nome_tabela) == 0|| strlen ($nome_campo_id) == 0||  $id_valor == 0 )
	return false;
	
	
	if( $referencia == null)
	$referencia = $this->conecta();
	
	
	return $this->getReferencia()->query("delete from ".$nome_tabela." where ".$nome_campo_id." = ".$id_valor, $referencia);
	}
	


	

	
	
	
		
	public function deletaPerson( $nome_tabela, $subquery = "", &$referencia = null){
	
	if( strlen ($nome_tabela) == 0 )
	return false;
	
	
	if( $referencia == null)
	$referencia = $this->conecta();
	
	
	return $this->getReferencia()->query("delete from ".$nome_tabela." ".(strripos($subquery, "where")===false?"WHERE ":"").$subquery);
	}
	
	
	
	
	
	
	
	public function executaQuery( $query){
	

	if( strlen($query) == 0 || !$this->prepara())
	return 0;
	
	return $this->getReferencia()->query($query);
	}
	
	
		
	
}
?>