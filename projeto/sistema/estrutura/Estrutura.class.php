<?php


include_once IGRSS_PATH_ABS.'Base.class.php';

include_once IGRSS_PATH_ABS.'login/Login.class.php';



final class Estrutura extends Base{

private $login;

private $opcao;
	
private $pagina_atual;
	
private $status;

private $local;




	function __construct(){
		
		parent::__construct();
		
		$this->login = new Login;
		
		$this->local = "";
		
		if($this->login->permitirAcesso()){
		
			$this->status = true;
		
			$this->setLocal();	
		}
		else
			$this->status = false;
	}

	
	
	
	
	private function setLocal(){
		
		if(array_key_exists("op", $_GET)){
			
			switch($_GET["op"]){
				
				case "PCP":
				$this->setIndicadores(null, "");
				$this->principal();
				break;

					case "CDT":
					$this->setIndicadores(null, "Cadastro");
					$this->principal();
					break;
						
						case "CMP":
						$this->setIndicadores(null, "Campo");
						$this->principal();
						break;
				
							case "PTM":
							$this->setIndicadores(null, "Patrimônio");
							$this->principal();
							break;
				
								case "MVM":
								$this->setIndicadores(null, "Movimento");
								$this->principal();
								break;
					
									case "FNC":
									$this->setIndicadores(null, "Financeiro");
									$this->principal();
									break;
									
										case "CFG":
										$this->setIndicadores(null, "Configurações");
										$this->principal();
										break;
										
			
		/******************* recursos cadastro ********************/
			
				case "EMP":
				include_once IGRSS_PATH_ABS."cadastro/empresa/Empresa.class.php";
				$this->opcao = new Empresa();
				$this->setIndicadores(array("CDT", "Cadastro"), "Empresa");
				break;
					
					case "FZD":
					include_once IGRSS_PATH_ABS."cadastro/fazendas/Fazenda.class.php";
					$this->opcao = new Fazenda();
					$this->setIndicadores(array("CDT", "Cadastro"), "Fazenda");
					break;
						
						case "QDR":
						include_once IGRSS_PATH_ABS."cadastro/quadras/Quadra.class.php";
						$this->opcao = new Quadra();
						$this->setIndicadores(array("CDT", "Cadastro"), "Quadras");
						break;
							
							case "USR":
							include_once IGRSS_PATH_ABS."cadastro/usuarios/Usuarios.class.php";
							$this->opcao = new Usuarios();
							$this->setIndicadores(array("CDT", "Cadastro"), "Usuários");
							break;
							
								case "GRP":
								include_once IGRSS_PATH_ABS."cadastro/grupos/Grupo.class.php";
								$this->opcao = new Grupo();
								$this->setIndicadores(array("CDT", "Cadastro"), "Grupos de Usuários");
								break;
									
									case "CLT":
									include_once IGRSS_PATH_ABS."cadastro/clientes/Cliente.class.php";
									$this->opcao = new Cliente();
									$this->setIndicadores(array("CDT", "Cadastro"), "Clientes");
									break;	

										case "PRD":
										include_once IGRSS_PATH_ABS."cadastro/prestadores/Prestador.class.php";
										$this->opcao = new Prestador();
										$this->setIndicadores(array("CDT", "Cadastro"), "Prestadores de Serviço");
										break;								

											case "PDT":
											include_once IGRSS_PATH_ABS."cadastro/produtos/Produto.class.php";
											$this->opcao = new Produto();
											$this->setIndicadores(array("CDT", "Cadastro"), "Produtos");
											break;
									
	/******************* recursos campo ********************/

	
				case "APC":
				include_once IGRSS_PATH_ABS."campo/aplicacao/Aplicacao.class.php";
				$this->opcao = new Aplicacao();
				$this->setIndicadores(array("CMP", "Campo"), "Aplicação");
				break;
		
					case "IPC":
					include_once IGRSS_PATH_ABS."campo/inspecao/Inspecao.class.php";
					$this->opcao = new Inspecao();
					$this->setIndicadores(array("CMP", "Campo"), "Inspeção");
					break;
												
						case "RCM":
						include_once IGRSS_PATH_ABS."campo/recomendacao/Recomendacao.class.php";
						$this->opcao = new Recomendacao();
						$this->setIndicadores(array("CMP", "Campo"), "Recomendação");
						break;	
							
							case "PRG":
							include_once IGRSS_PATH_ABS."campo/pragas/Praga.class.php";
							$this->opcao = new Praga();
							$this->setIndicadores(array("CMP", "Campo"), "Pragas");
							break;

						
	/******************* recursos patrimonio ********************/										
											
				case "EQP":
				include_once IGRSS_PATH_ABS."patrimonio/equipamentos/Equipamento.class.php";
				$this->opcao = new Equipamento();
				$this->setIndicadores(array("PTM", "Patrimônio"), "Equipamentos");
				break;


	/******************* recursos movimento ********************/	
			
																								
				case "RME":
				include_once IGRSS_PATH_ABS."movimento/romaneio_embarque/RomaneioEmbarque.class.php";
				$this->opcao = new RomaneioEmbarque();
				$this->setIndicadores(array("MVM", "Movimento"), "Romaneio de Embarque");
				break;
												
					case "RMV":
					include_once IGRSS_PATH_ABS."movimento/romaneio_venda/RomaneioVenda.class.php";
					$this->opcao = new RomaneioVenda();
					$this->setIndicadores(array("MVM", "Movimento"), "Romaneio de Venda");
					break;
	
	
	/******************* recursos de configurações ********************/	
			
								
				
				case "CFQ":
				include_once IGRSS_PATH_ABS."configuracoes/Configuracoes.class.php";
				$this->opcao = new Configuracoes();
				$this->setIndicadores(array("CFG", "Configurações"), "Configuracoes de Quadras");
				break;

					case "CFP":
					include_once IGRSS_PATH_ABS."configuracoes/Configuracoes.class.php";
					$this->opcao = new Configuracoes();
					$this->setIndicadores(array("CFG", "Configurações"), "Configuracoes de Produtos");
					break;
					
						case "CFE":
						include_once IGRSS_PATH_ABS."configuracoes/Configuracoes.class.php";
						$this->opcao = new Configuracoes();
						$this->setIndicadores(array("CFG", "Configurações"), "Configuracoes de Equipamentos");
						break;
						
							case "CFB":
							include_once IGRSS_PATH_ABS."configuracoes/Configuracoes.class.php";
							$this->opcao = new Configuracoes();
							$this->setIndicadores(array("CFG", "Configurações"), "Configuracoes de Romaneio de Embarque");
							break;
							
								case "CFV":
								include_once IGRSS_PATH_ABS."configuracoes/Configuracoes.class.php";
								$this->opcao = new Configuracoes();
								$this->setIndicadores(array("CFG", "Configurações"), "Configuracoes de Romaneio de Venda");
								break;
								
									case "CIP":
									include_once IGRSS_PATH_ABS."configuracoes/Configuracoes.class.php";
									$this->opcao = new Configuracoes();
									$this->setIndicadores(array("CFG", "Configurações"), "Configuracoes de Inspeções");
									break;
			
	/***********************************************************/	

						default:
							$this->setIndicadores(null, "");
							$this->principal();
				}
			}
			else{
				
				$this->setIndicadores(null, "");
				$this->principal();	
			}
	}
	
	
	
	
	
	
	private function setIndicadores($anterior, $local){
		
		if(array_key_exists("op", $_GET) && strlen($_GET["op"])>0 && strcmp($_GET["op"], "PCP")!=0){
		
			if(array_key_exists("sop", $_GET) && strcmp($_GET["sop"], "CAD")==0){
																
				if(array_key_exists("id", $_GET) && $_GET["id"]>0){		
					$this->local = "<a href='javascript:carregaPagina(\"op=PCP\")'>Início</a>".($anterior!=null && count($anterior)>0?" | <a href='javascript:carregaPagina(\"op=".$anterior[0]."\")'>".$anterior[1]."</a>":"")." | <a href='javascript:carregaPagina(\"op=".$_GET["op"]."\")'>".$local."</a> | <a href='javascript:carregaPagina(\"op=".$_GET["op"]."&sop=CAD&id=".$_GET["id"]."\")'>Alteração</a>";
					$this->pagina_atual = "<a href='javascript:carregaPagina(\"op=".$_GET["op"]."&sop=CAD&id=".$_GET["id"]."\")'>Alteração de ".$local."</a>";
				}
				else{
																	
					$this->local = "<a href='javascript:carregaPagina(\"op=PCP\")'>Início</a>".($anterior!=null && count($anterior)>0?" | <a href='javascript:carregaPagina(\"op=".$anterior[0]."\")'>".$anterior[1]."</a>":"")." | <a href='javascript:carregaPagina(\"op=".$_GET["op"]."\")'>".$local."</a> | <a href='javascript:carregaPagina(\"op=".$_GET["op"]."&sop=CAD\")'>Inclusão</a>";
					$this->pagina_atual = "<a href='javascript:carregaPagina(\"op=".$_GET["op"]."&sop=CAD\")'>Inclusão de ".$local."</a>";
				}	
			}
			else{
				
				$this->local = "<a href='javascript:carregaPagina(\"op=PCP\")'>Início</a>".($anterior!=null && count($anterior)>0?" | <a href='javascript:carregaPagina(\"op=".$anterior[0]."\")'>".$anterior[1]."</a>":"")." | <a href='javascript:carregaPagina(\"op=".$_GET["op"]."\")'>".$local."</a>";
				$this->pagina_atual = "<a href='javascript:carregaPagina(\"op=".$_GET["op"]."\")'>".$local."</a>";
			}
		}
		else{
			$this->local = "<a href='javascript:carregaPagina(\"op=PCP\")'>Início</a>";
			$this->pagina_atual = "<a href='javascript:carregaPagina(\"op=PCP\")'>Ínicio</a>";
		}
	}
	
	
	
	
	
	
	private function principal(){
		
		include_once IGRSS_PATH_ABS."sistema/estrutura/Principal.class.php";
		
		$this->opcao = new Principal();
	}
	
	
	

	

	public function dependencias(){
		
	echo "
	
	<link rel='stylesheet' type='text/css' href='".IGRSS_PATH_SMP."sistema/estrutura/estrutura.css?v=".rand(1, 999)."'>
	
	<script type='text/javascript' src='".IGRSS_JS_PATH_SMP."jquery-3.1.1.min.js'></script>
	
	<script type='text/javascript' src='".IGRSS_PATH_SMP."sistema/estrutura/estrutura.js?v=".rand(1, 999)."'></script>
	
	<script type='text/javascript' src='".IGRSS_JS_PATH_SMP."mascaras.js?v=".rand(1, 999)."'></script>
	
	<script type='text/javascript' src='".IGRSS_JS_CALC_PATH_SMP."calculo.js?v=".rand(1, 999)."'></script>
	
	<link rel='stylesheet' href='".IGRSS_JS_PATH_SMP."select2.min.css' type='text/css' media='all'>
	
	<script type='text/javascript' src='".IGRSS_JS_PATH_SMP."select2.min.js'></script>
	
	<link href='".IGRSS_JS_CALENDAR_PATH."styles/glDatePicker.default.css' rel='stylesheet' type='text/css'>
	
	<script type='text/javascript' src='".IGRSS_JS_CALENDAR_PATH."glDatePicker.js'></script>";	
	
	$this->login ->dependencias();
	
	if(is_object($this->opcao))
		$this->opcao ->dependencias();
	}


	
	
	
	public function cabecalho(){
	
		$cabecalho = '

		<meta charset="utf-8">
		<meta http-equiv="content-language" content="pt-br">
		<meta name="author" content="Eng. Flavio Henrique P Sousa">
		<meta name="reply-to" content="contato@mscsolucoes.com.br">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width;initial-scale=1.0,user-scalable=no,maximum-scale=1">
		
		<title>Agrocontrole</title>	
		<link rel="shortcut icon" sizes="32x32" href="'.IGRSS_PATH_IMGS.'favicon.png" type="image/x-icon">';
		
		
		echo $cabecalho;
	}
	
	
	
	
	
	public function topo(){
	
		$form =
			"	<div id='area_logo'>
					<table>
						<tr>
							<td>
								<a href='".IGRSS_PATH_SMP."'>
									<img src='".IGRSS_PATH_IMGS."logo.png' id='logo'>
								</a>
							</td>
							<td>
								<a href='".IGRSS_PATH_SMP."'>
									<br><span style='font-size:2.9em'><b>AgroControle</b></span>
								</a>
							</td>
						</tr>
					</table>
				</div>
				<div id='area_centro' align='center'>";
		
	if($this->status)	
		$form .= "
					<div align='right' id='area_pag_atual'>
					Você está em: <i>".$this->pagina_atual."</i>
					</div>";
	
		$form .= "	
				</div>
				<div id='area_infos' align='right'>";

		if($this->status){
			
			include_once IGRSS_CMS_PATH_ABS.'Comuns.class.php';
		
			$comuns  = new Comuns;
			
			$form .= "
					<table style='margin-right:20px'>
						<tr>
							<td align='left' style='width:120px'>
							Olá, <b>".$comuns->formataNome($this->gandalf->usuarioAtual()->nome_completo)."</b>
							</td>
						</tr>
						<tr>
							<td>
								<div class='bt bt_padrao' id='bt_sair' onClick='javascript:sair()'>
								Desconectar
								</div>
								<div align='center' class='carregando' id='area_carregando'>
									<img src='".IGRSS_PATH_IMGS."load.gif'>
								</div>
							</td>
						</tr>
					</table>";
		}
		
		$form .= "
				</div>
				<div style='clear:both'></div>";
		
		echo $form;
	}
	
	
	
	
	
	
	public function barra(){
	
		$op = "PCP";
		if(array_key_exists("op", $_GET))
			$op = $_GET["op"];

		$form = "";
		
		if($this->status)		
			$form .="	
				<div id='menu_prin'>
					<ul>	
						<li>
							<div class='item_menu_prin ".(strcmp($op, "PCP")==0?"item_menu_prin_selec ":"")."' onClick='javascript:carregaPagina(\"op=PCP\")'>
								Início
							</div>
						</li>
						<li>
							<div class='item_menu_prin ".(strcmp($op, "CDT")==0?"item_menu_prin_selec ":"")."' onClick='javascript:carregaPagina(\"op=CDT\")'>
								Cadastro
							</div>
							<div class='sub_menu_prin'>
								<div onClick='javascript:carregaPagina(\"op=EMP\")'>
									Empresa
								</div>
								<div onClick='javascript:carregaPagina(\"op=FZD\")'>      
									Fazendas
								</div>
								<div onClick='javascript:carregaPagina(\"op=QDR\")'>      
									Quadras
								</div>
								<div onClick='javascript:carregaPagina(\"op=USR\")'>      
									Usuários
								</div>
								<div onClick='javascript:carregaPagina(\"op=GRP\")'>      
									Grupos de Usuários
								</div>
								<div onClick='javascript:carregaPagina(\"op=CLT\")'>      
									Clientes
								</div>
								<div onClick='javascript:carregaPagina(\"op=PRD\")'>      
									Prestadores de Serviço
								</div>
								<div onClick='javascript:carregaPagina(\"op=PDT\")'>
									Produtos
								</div>
								<div onClick='javascript:carregaPagina(\"op=PRG\")'>      
									Pragas
								</div>
							</div>
						</li>
						<li>
							<div class='item_menu_prin ".(strcmp($op, "CMP")==0?"item_menu_prin_selec":"")."' onClick='javascript:carregaPagina(\"op=CMP\")'>
								Campo
							</div>
							<div class='sub_menu_prin'>
								<div onClick='javascript:carregaPagina(\"op=IPC\")'>      
									Inspeção
								</div>
								<div onClick='javascript:carregaPagina(\"op=RCM\")'>      
									Recomendação
								</div>
								<div onClick='javascript:carregaPagina(\"op=APC\")'>      
									Aplicação
								</div>
							</div>	
						</li>
						<li>
							<div class='item_menu_prin ".(strcmp($op, "MVM")==0?"item_menu_prin_selec":"")."' onClick='javascript:carregaPagina(\"op=MVM\")'>
								Movimento
							</div>
							<div class='sub_menu_prin'>
								<div onClick='javascript:carregaPagina(\"op=RME\")'>
									Romaneio de Embarque
								</div>
								<div onClick='javascript:carregaPagina(\"op=RMV\")'>      
									Romaneio de Venda
								</div>
							</div>	
							
						</li>
						<li>
							<div class='item_menu_prin ".(strcmp($op, "FNC")==0?"item_menu_prin_selec":"")."' onClick='javascript:carregaPagina(\"op=FNC\")'>
								Financeiro
							</div>
						</li>
						<li>
							<div class='item_menu_prin ".(strcmp($op, "PTM")==0?"item_menu_prin_selec":"")."' onClick='javascript:carregaPagina(\"op=PTM\")'>
								Patrimônio
							</div>
							<div class='sub_menu_prin'>
								<div onClick='javascript:carregaPagina(\"op=EQP\")'>
									Cadastro
								</div>
							</div>	
						</li>
						<li>
							<div class='item_menu_prin ".(strcmp($op, "CFG")==0?"item_menu_prin_selec":"")."' onClick='javascript:carregaPagina(\"op=CFG\")'>
								Configurações
							</div>
							<div class='sub_menu_prin'>
								<div onClick='javascript:carregaPagina(\"op=CFQ\")'>
									Quadras
								</div>
								<div onClick='javascript:carregaPagina(\"op=CFP\")'>      
									Produtos
								</div>
								<div onClick='javascript:carregaPagina(\"op=CFE\")'>      
									Equipamentos
								</div>
								<div onClick='javascript:carregaPagina(\"op=CFB\")'>      
									Romaneio de Embarque
								</div>
								<div onClick='javascript:carregaPagina(\"op=CFV\")'>      
									Romaneio de Venda
								</div>
								<div onClick='javascript:carregaPagina(\"op=CIP\")'>      
									Inspeções
								</div>
							</div>	
						</li>
					</ul>
				</div>
				<div style='clear:both'></div>";
	
		echo $form;
	}
	
	
	
	
	
	public function conteudo(){
	
		echo "<input type='hidden' id='IGRSS_PATH_SMP' value='".IGRSS_PATH_SMP."'>";

		if($this->status){

			if(is_object($this->opcao)){
				
				echo "
					<table width='100%'>
						<tr>
							<td width='50%' align='left'>
								<b><i>".$this->local."</i></b>
							</td>
							<td width='50%' align='right'>
								<div align='right'>
									<!-- <img src='".IGRSS_PATH_IMGS."voltar.png' class='bt_voltar' onclick='javascript:history.back()'> -->
								</div>
							</td>
						</tr>
						<tr>
							<td colspan='2' align='center'>
								<hr style='width:100%;margin:0px 0px 5px 0px'>
							</td>
						</tr>
					</table>";
				
				$this->opcao->conteudo();
			}
			else
				echo $this->erro("Você está tentando acessar um recurso que não existe.");
		}
		else
			$this->login->logar();
			
	}
	
	
	
	
	
	
	public function rodape(){
	
		$this->removeImgsTempDeRel();

		echo "Copyright ".date("Y")." Agrocontrole. Todos os Direitos Reservados.";
	}


	
	
	
	private function removeImgsTempDeRel(){
		
		if($this->gandalf->usuarioAtual()!=null){
		
			$id = "_".$this->gandalf->usuarioAtual()->id."_";
			
			$local = dir(IGRSS_PATH_ABS."relatorios/temp/");
	 
			while($arquivo = $local->read()){
				
				if(strpos($arquivo, $id)!==false)
					unlink(IGRSS_PATH_ABS."relatorios/temp/".$arquivo); 	
			}
			
			$local -> close();
		}
	}
	
	
}	
		
?>