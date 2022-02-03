<?php


include_once AGRCL_PATH_ABS.'Base.class.php';



final class Principal extends Base{




	public function dependencias(){}

	
	
	
	public function conteudo(){

		$form = "";
	
		if(array_key_exists("op", $_GET)){
			
			switch($_GET["op"]){
				
				case "PCP":	
				$form .=$this->getInicio(); 
				break;

					case "CDT":
						
					$form .= "
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=EMP\")'>
							<img src='".AGRCL_PATH_IMGS."empresa.png' class='icon'>
							<br>
							<span class='titulo'>Empresa</span>
							<br>
						</div>	
				
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=FZD\")'>
							<img src='".AGRCL_PATH_IMGS."fazenda.png' class='icon'>
							<br>
							<span class='titulo'>Fazendas</span>
							<br>
						</div>
					
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=QDR\")'>
							<img src='".AGRCL_PATH_IMGS."quadra.png' class='icon'>
							<br>
							<span class='titulo'>Quadras</span>
							<br>
						</div>	
				
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=USR\")'>
							<img src='".AGRCL_PATH_IMGS."usuario.png' class='icon'>
							<br>
							<span class='titulo'>Usuários</span>
							<br>
						</div>
		
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=GRP\")'>
							<img src='".AGRCL_PATH_IMGS."grupo.png' class='icon'>
							<br>
							<span class='titulo'>Grupos de Usuários</span>
							<br>
						</div>
		
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CLT\")'>
							<img src='".AGRCL_PATH_IMGS."cliente.png' class='icon'>
							<br>
							<span class='titulo'>Clientes</span>
							<br>
						</div>
						
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=PRD\")'>
							<img src='".AGRCL_PATH_IMGS."prestadores.png' class='icon'>
							<br>
							<span class='titulo'>Prest. de Serviço</span>
							<br>
						</div>
						
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=PDT\")'>
							<img src='".AGRCL_PATH_IMGS."produto.png' class='icon'>
							<br>
							<span class='titulo'>Produtos</span>
							<br>
						</div>
						
						<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=PRG\")'>
							<img src='".AGRCL_PATH_IMGS."praga.png' class='icon'>
							<br>
							<span class='titulo'>Pragas</span>
							<br>
						</div>";
						
					break;
						
						case "CMP":
						
						$form .= "
							
							<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=IPC\")'>
								<img src='".AGRCL_PATH_IMGS."inspecao.png' class='icon'>
								<br>
								<span class='titulo'>Inspeções</span>
								<br>
							</div>
							
							<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=RCM\")'>
								<img src='".AGRCL_PATH_IMGS."recomendacao.png' class='icon'>
								<br>
								<span class='titulo'>Recomendação</span>
								<br>
							</div>
							
							<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=APC\")'>
								<img src='".AGRCL_PATH_IMGS."aplicacao.png' class='icon'>
								<br>
								<span class='titulo'>Aplicações</span>
								<br>
							</div>";
			
						break;
				
							case "PTM":
							
							$form .= "
								<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=EQP\")'>
									<img src='".AGRCL_PATH_IMGS."patrimonio.png' class='icon'>
									<br>
									<span class='titulo'>Cadastro</span>
									<br>
								</div>";
						
							break;
				
								case "MVM":
								
								$form .= "

									<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=RME\")'>
										<img src='".AGRCL_PATH_IMGS."romaneio.png' class='icon'>
										<br>
										<span class='titulo'>Romaneio - Embarque</span>
										<br>
									</div>
									
									<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=RMV\")'>
										<img src='".AGRCL_PATH_IMGS."romaneio_venda.png' class='icon'>
										<br>
										<span class='titulo'>Romaneio - Venda</span>
										<br>
									</div>";
									
								break;
					
									case "FNC":
									break;
									
										case "CFG":
										
										$form .= "
											<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CFQ\")'>
												<img src='".AGRCL_PATH_IMGS."quadra.png' class='icon'>
												<br>
												<span class='titulo'>Quadras</span>
												<br>
											</div>
					
											<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CFP\")'>
												<img src='".AGRCL_PATH_IMGS."produto.png' class='icon'>
												<br>
												<span class='titulo'>Produtos</span>
												<br>
											</div>
											
											<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CFE\")'>
												<img src='".AGRCL_PATH_IMGS."equipamento.png' class='icon'>
												<br>
												<span class='titulo'>Equipamentos</span>
												<br>
											</div>
											
											<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CFB\")'>
												<img src='".AGRCL_PATH_IMGS."romaneio.png' class='icon'>
												<br>
												<span class='titulo'>Romaneio - Embarque</span>
												<br>
											</div>
											
											<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CFV\")'>
												<img src='".AGRCL_PATH_IMGS."romaneio_venda.png' class='icon'>
												<br>
												<span class='titulo'>Romaneio - Venda</span>
												<br>
											</div>
											
											<div class='item_principal' align='center' onClick='javascript:carregaPagina(\"op=CIP\")'>
												<img src='".AGRCL_PATH_IMGS."inspecao.png' class='icon'>
												<br>
												<span class='titulo'>Inspeções</span>
												<br>
											</div>";
											
										break;
										
				default:
					$form .=$this->getInicio(); 
			
			}
		}
		else
			$form .=$this->getInicio(); 
		
		echo $form;
	}
	

	
	
	
	private function getInicio(){
		
		$form = "
			<div align='center'>
				<img src='".AGRCL_PATH_IMGS."banner.jpg' id='banner'>
			</div>";
	

		return $form;
	}
	
	
	
	
}	
		
?>