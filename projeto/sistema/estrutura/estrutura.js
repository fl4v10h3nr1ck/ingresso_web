
	var mostrar_log=  true;


	jQuery(document).ready(function(){
		
		jQuery('select').select2({width : '100%'});
	
		posiciona();

		jQuery(window).resize(posiciona);

		jQuery(window).on('load', posiciona);
	});
			


	
	
	function posiciona(){		
	
		var altura_topo = jQuery("#topo").outerHeight();
		
		var altura_barra = jQuery("#barra").outerHeight();
		
		var altura_rodape = jQuery("#rodape").outerHeight();
		
		var altura_conteudo = jQuery("#conteudo").outerHeight();
		
		var altura_tela = jQuery(window).outerHeight();
		
		var soma = altura_topo+altura_barra+altura_rodape;
		
		if((soma+altura_conteudo)<=altura_tela){
			
			jQuery("#rodape").css({ position: "fixed", bottom: "0px" });
			
			jQuery("#conteudo").css({ "min-height":
			(altura_tela - 
				(soma + 5 +
					parseInt(jQuery("#conteudo").css("margin-top").replace('px', '')) +
						parseInt(jQuery("#conteudo").css("margin-bottom").replace('px', '')) + 
							parseInt(jQuery("#conteudo").css("padding-top").replace('px', '')) + 
								parseInt(jQuery("#conteudo").css("padding-bottom").replace('px', ''))))+"px"});
		}
		else
			jQuery("#rodape").css({ position: "static"});
		
	}

	
	
	
	
	
	function carregaPagina(parametros){
		
		window.open($("#IGRSS_PATH_SMP").val()+
			(parametros!=null && parametros.length>0?"?"+parametros:""), "_SELF");
	}
	
	
	
	
	
	function iniciaCarregamento(funcao, id_bt, id_carregando){
		
		if($("#"+id_bt).length && $("#"+id_carregando).length){
		
			$("#"+id_bt).fadeOut("fast", 
				function(){
					
					$("#"+id_carregando).fadeIn("fast", 
						function(){
							
						funcao();
						}
					);
				}
			);
		}		
	}
	
	
	
	
	
	
	function finalizaCarregamento(id_bt, id_carregando){
		
		if($("#"+id_bt).length && $("#"+id_carregando).length){
		
			$("#"+id_carregando).fadeOut("fast", 
				function(){
					$("#"+id_bt).fadeIn("fast");
				}
			);
		}
	}
	
	
	

	
	
	