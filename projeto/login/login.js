
		
	function login(){
	
		iniciaCarregamento(
			function(){
				
				jQuery.post(
							
				$("#IGRSS_PATH_SMP").val()+'acao.php',
					{
						funcao:"tentativaDeLogin",
						path:$("#path").val(),
						classe:$("#classe").val(),
						nome:$("#nome").val(), 
						senha:$("#login_senha").val(), 
						salvar:$("#continuar_logado").is(":checked")?1:0
					},
					function(retorno){ 
						
						if(mostrar_log)
							console.log(retorno);
						
						var erro = false;
						var aux;
						try { 
							aux = $.parseJSON(retorno.substring(retorno.indexOf("{")));
						}
						catch (e) { 
							erro = true; 
						} 
						
						if(erro || aux.status!='sucesso'){
						
							$("#login_msg_erro").html("Usuário ou senha inválidos.");
								
							finalizaCarregamento("area_bt_logar", "area_carregando");
						}
						else
							location.reload();
						
					}
				);		
			},
		"area_bt_logar",
		"area_carregando");
	}
	
	
	
	
	
	function sair(){
	
		iniciaCarregamento(
			function(){
				jQuery.post(
							
				$("#IGRSS_PATH_SMP").val()+'acao.php',
					{
						funcao:"sair",
						path:"/cadastro/login/",
						classe:"Login"
					},
					function(retorno){ 
							
						location.reload();
					}
				);
			},
		"bt_sair",
		"area_carregando");
	}
	
	