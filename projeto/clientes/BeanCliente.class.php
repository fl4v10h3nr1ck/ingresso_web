<?php

/** @AnotTabela(nome="clientes", prefixo="clt") */
final class BeanCliente{


/** @AnotCampo(nome="id_cliente", tipo="int", ehId=true) */
public $id;

/** @AnotCampo(nome="fk_endereco", tipo="int") */
public $fk_endereco;

/** @AnotColuna(rotulo="Nome/Razão Social", posicao=1, comprimento=30, alinhamento="left") 
	@AnotCampo(nome="nome_razao") */
public $nome_razao;

/** @AnotColuna(rotulo="Nome Fantasia", posicao=2, comprimento=28, alinhamento="left") 
	@AnotCampo(nome="nome_fantasia") */
public $nome_fantasia;

/** @AnotColuna(rotulo="CPF/CNPJ", posicao=3, comprimento=17, alinhamento="center") 
	@AnotCampo(nome="cpf_cnpj") */
public $cpf_cnpj;

/** @AnotColuna(rotulo="RG/IE", posicao=4, comprimento=12, alinhamento="center") 
	@AnotCampo(nome="rg_ie") */
public $rg_ie;

/** @AnotColuna(rotulo="TEL", posicao=5, comprimento=13, alinhamento="center") 
	@AnotCampo(nome="fone_1") */
public $fone_1;

/** @AnotCampo(nome="fone_2") */
public $fone_2;

/** @AnotCampo(nome="data_cadastro") */
public $data_cadastro;

/** @AnotCampo(nome="status", tipo="int") */
public $status;

	
	
}
?>