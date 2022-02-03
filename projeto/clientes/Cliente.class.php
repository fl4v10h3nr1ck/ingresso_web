 <?php

include_once AGRCL_PATH_ABS.'Base.class.php';

include_once AGRCL_TABELA_PATH_ABS.'Tabela.class.php';

include_once AGRCL_PATH_ABS.'cadastro/endereco/Endereco.class.php';



final class Cliente extends Base{


private $tab;

private $endereco;




	function __construct() {
		
		parent::__construct();
		
		$this->tab= new Tabela();	
		
		$this->endereco= new Endereco();
	}

	
	


	
	public function dependencias(){
	
		echo "
		
		<script src='".AGRCL_PATH_SMP."cadastro/clientes/clientes.js' type='text/javascript'></script>
	
		<link rel='stylesheet' href='".AGRCL_PATH_SMP."cadastro/clientes/clientes.css' type='text/css' media='all'>";
	
		$this->tab->dependencias();
		
		$this->endereco->dependencias();
	}

	
	
	
	
	public function conteudo(){

		$form = "
		<input type='hidden' id='path'   value='/cadastro/clientes/'/>
		<input type='hidden' id='classe' value='Cliente'/>";
	
		if(array_key_exists("sop", $_GET) && strcmp($_GET["sop"], "CAD")==0)
			$form .= $this->getForm();
		else{
	
			$form .= "
				<table>
					<tr>
						<td align='center'>
							<button onclick='javascript:novoCliente()' class='opcao'>
								<img src='".AGRCL_PATH_IMGS."novo.png'>
							</button>
							<br>Novo
						</td>
						<td  align='center'>
							<button onclick='javascript:editarCliente()' class='opcao'>
								<img src='".AGRCL_PATH_IMGS."alterar.png'>
							</button>
							<br>Editar
						</td>
						<td  align='center'>
							<button onclick='javascript:excluirCliente()' class='opcao'>
								<img src='".AGRCL_PATH_IMGS."excluir.png'>
							</button>
						<br>Excluir
					</td>
				</tr>
			</table>";
			
			$this->tab->setPathABSDoObjeto(AGRCL_PATH_ABS."cadastro/clientes/");
			
			$this->tab->setFuncaoDuploClick("editarCliente");
			
			$this->tab->setOrderByFixo("###.nome_razao ASC");
			
			$this->tab->setWhereFixo("###.status>0");
			
			$this->tab->setMostrarOpcoesDePesquisa(true);
			
			$this->tab->setMostrarPaginacao(true);
			
			$form .= $this->tab->getTabela("BeanCliente", 'tab_clientes');
		}
		
		echo $form;
	}
	
	
	
	
	
	public function getForm(){
		
		include_once AGRCL_BD_PATH_ABS."BdUtil.class.php";
		include_once AGRCL_PATH_ABS.'cadastro/clientes/BeanCliente.class.php';
		include_once AGRCL_CMS_PATH_ABS.'Comuns.class.php';					
		
		$bd = new BdUtil();
		$comuns = new Comuns();
		
		$cliente = $bd->getPorId(new BeanCliente(), array_key_exists("id", $_GET)?$comuns->anti_injection($_GET['id']):0);

		if(!is_object($cliente))
			$cliente  = new BeanCliente();
		
		$form = "
				<div class='formulario'>
					<div id='div_nome_razao' class='item_form'>
						Nome/Razão Social:<span class='campo_obrigatorio'>*</span><br>
						<input type='text' id='nome_razao' value='".$cliente->nome_razao."' maxlength='200'>	
					</div>
					<div id='div_fantasia' class='item_form'>
						Noma Fantasia:<br>
						<input type='text' id='fantasia' value='".$cliente->nome_fantasia."' maxlength='200'>
					</div>
					<div id='div_cpf_cnpj' class='item_form'>
						CPF/CNPJ:<span class='campo_obrigatorio'>*</span><br>	
						<input type='text' id='cpf_cnpj' value='".$cliente->cpf_cnpj."'  class='campo_centralizado' maxlength='19' onchange='javascript:mascara(this, formatarCPFCNPJ)'>
					</div>
					<div id='div_rg_ie' class='item_form'>
						RG/IE:<br>	
						<input type='text' id='rg_ie' value='".$cliente->rg_ie."' class='campo_centralizado'  maxlength='14' onchange='javascript:mascara(this, formatarSomenteNum)'>
					</div>
					<div id='div_tel' class='item_form'>
						Fone Prin.:<span class='campo_obrigatorio'>*</span><br>	
						<input type='text' id='tel' value='".$cliente->fone_1."' class='campo_centralizado'  maxlength='15' onchange='javascript:mascara(this, formatarTEL)'>	
					</div>
					<div id='div_tel_2' class='item_form'>
						Fone Secun.:<br>
						<input type='text' id='tel_2' value='".$cliente->fone_2."' class='campo_centralizado'  maxlength='15' onchange='javascript:mascara(this, formatarTEL)'>	
					</div>
					".$this->endereco->formDeEndereco($cliente->fk_endereco)."
					<div style='clear:both'></div>
					<br>
					<div align='center'>
						<div class='bt bt_padrao' id='bt_salvar_cliente' onclick='javascript:salvarCliente(".($cliente->id>0?$cliente->id:0).")'>
							Salvar Cliente
						</div>
						<div align='center' class='carregando' id='area_carregando_cliente'>
							<img src='".AGRCL_PATH_IMGS."load.gif'>
						</div>
					</div>
				</div>";
		
		return $form;
	}
	
	
	
	

	
	public function salvarCliente(){
		
		include_once AGRCL_BD_PATH_ABS."BdUtil.class.php";
		include_once AGRCL_PATH_ABS.'cadastro/clientes/BeanCliente.class.php';
		include_once AGRCL_CMS_PATH_ABS.'Comuns.class.php';		
		
		$comuns = new Comuns();
		$bd = new BdUtil();
	
		$_POST['nome_razao'] 	= $comuns->anti_injection($_POST['nome_razao']);
		$_POST['fantasia'] 		= $comuns->anti_injection($_POST['fantasia']);
		$_POST['cpf_cnpj'] 		= $comuns->anti_injection($_POST['cpf_cnpj']);
		$_POST['rg_ie'] 		= $comuns->anti_injection($_POST['rg_ie']);
		$_POST['tel'] 			= $comuns->anti_injection($_POST['tel']);
		$_POST['tel_2'] 		= $comuns->anti_injection($_POST['tel_2']);
		
		if(strlen($_POST['nome_razao']) <=0){
		
			echo '{"status":"ERRO", "erro":"Informe o nome/razão social do cliente."}';
			return;
		}
	
		if(strlen($_POST['cpf_cnpj'])<=14){
			
			if(!$comuns->validaCPF($_POST['cpf_cnpj'])){
			
				echo '{"status":"ERRO", "erro":"Informe um número de CPF válido."}';
				return;
			}
		}
		else{
			
			if(!$comuns->validaCNPJ($_POST['cpf_cnpj'])){
		
			echo '{"status":"ERRO", "erro":"Informe um número de CNPJ válido."}';
			return;
			}
		}
		
		if(!$comuns->validaTEL($_POST['tel'])){
			
			echo '{"status":"ERRO", "erro":"Informe um TEL válido."}';
			return;
		}
		
		if(strlen($_POST['tel_2']) >0){
		
			if(!$comuns->validaTEL($_POST['tel_2'])){
			
				echo '{"status":"ERRO", "erro":"Informe um segundo TEL válido."}';
				return;
			}
		}
		
		
		$endereco = json_decode($_POST["endereco"]);
		
		$erro= $this->endereco->validacao($endereco);
		
		if(strlen($erro)>0){
			
			echo $erro;
			return;
		}
		
		$cliente = $bd->getPorId(new BeanCliente(), $comuns->anti_injection($_POST['cliente_id']));

		if(!is_object($cliente))
			$cliente  = new BeanCliente();
			
		$cliente->nome_razao  			=  	$_POST['nome_razao'];
		$cliente->nome_fantasia  		=  	$_POST['fantasia'];
		$cliente->cpf_cnpj  			=  	$_POST['cpf_cnpj'];
		$cliente->rg_ie  				=  	$_POST['rg_ie'];
		$cliente->fone_1  				=  	$_POST['tel'];
		$cliente->fone_2  				=  	$_POST['tel_2'];
		
		$id_endereco = $this->endereco->salvaEndereco($bd, $endereco, $cliente->fk_endereco);
		
		if($id_endereco<=0){
			
			echo '{"status":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
			return;
		}
		
		$cliente->fk_endereco  =  $id_endereco;
		
		if($cliente->id<=0){
		
			$cliente->status = 1;
			$cliente->data_cadastro = date("Y-m-d");
			
			$cliente->id = $bd->novo($cliente);
			
			if($cliente->id<=0){
					
				echo '{"status":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
			}	
		}
		else{
			
			if(!$bd->altera($cliente)){
			
				echo '{"status":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
				return;
			}
		}
		
		echo '{"status":"sucesso", "id":"'.$cliente->id.'", "nome":"'.$cliente->nome_razao.'", "documento":"'.$cliente->cpf_cnpj.'"}';
	}
	
	
	

	
	public function excluirCliente(){
			
		include_once AGRCL_BD_PATH_ABS."BdUtil.class.php";
		include_once AGRCL_PATH_ABS.'clientes/BeanCliente.class.php';
		include_once AGRCL_CMS_PATH_ABS.'Comuns.class.php';
	
		$comuns = new Comuns();
		$bd = new BdUtil();
	
		$cliente = $bd->getPorId(new BeanCliente(), $comuns->anti_injection($_POST['cliente_id']));

		if(!is_object($cliente)){
			echo '{"status":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
			return;
		}	
			
		$cliente->status = 0;
		
		if(!$bd->altera($cliente)){
			
			echo '{"status":"ERRO", "erro":"Falha na gravação, por favor, tente novamente."}';
			return;
		}
	
		echo '{"status":"sucesso"}';
	}
	

	

}


?>