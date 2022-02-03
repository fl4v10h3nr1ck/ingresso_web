<?php


/** @AnotTabela(nome="usuarios", prefixo="usr") */
final class BeanUsuario{


/** @AnotCampo(nome="id_usuario", tipo="int", ehId=true) */
public $id;

/** @AnotCampo(nome="nome") */
public $nome;

/** @AnotCampo(nome="senha") */
public $senha;

/** @AnotCampo(nome="status", tipo="int") */
public $status;





	
	
}
?>