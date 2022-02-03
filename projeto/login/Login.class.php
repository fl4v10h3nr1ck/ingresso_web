 <?php

include_once IGRSS_PATH_ABS.'Base.class.php';

include_once IGRSS_PATH_ABS.'login/Gandalf.class.php';




final class Login extends Base{





	function __construct() {
		
		parent::__construct();
		
		$this->configuraCookiesDeUsuario();
	}

	

	
	public function dependencias(){
	
		parent::dependencias();
	
		echo "
		
		<script src='".IGRSS_PATH_SMP."login/login.js' type='text/javascript'></script>
	
		<link rel='stylesheet' href='".IGRSS_PATH_SMP."login/login.css' type='text/css' media='all'>";
	}

	
	

	
	public function logar(){
	
		$form = "
		<input type='hidden' id='path'   value='/login/'/>
		<input type='hidden' id='classe' value='Login'/>
		<form method='POST' action='javascript:login();'>
			<div id='form_login'>
				<div id='form_login_titulo'>
				<b>Autenticação</b>
				</div>
				<hr width='99%'>
				<div id='form_login_interno' align='left'>
					<div style='margin:0px  0px 0px 4%' align='left'>
					Nome de Usuário:
					</div>
					<div>
					<input type='text' class='campos' name='nome' id='nome' style='width:92%;margin:0px  4% 0px 4%' maxlength='24'/>
					</div>
					<div style='margin:10px  0px 0px 4%' align='left'>
					Senha:
					</div>		
					<div>
					<input type='password' class='campos' name='login_senha' id='login_senha' style='width:92%;margin:0px  4% 0px 4%' maxlength='20'/>
					</div>		
					<div align='left' style='margin:10px  0px 0px 4%'>
					<input type='checkbox' name='continuar_logado' id='continuar_logado' value='S'> Permanecer Logado.
					</div>
					<div align='center' id='area_bt_logar'>
					<input type='submit' style='width:110px' value='Entrar'/>
					</div>
					<div align='center' id='area_carregando'>
					<img src='".IGRSS_PATH_IMGS."load.gif'>
					</div>
					<div align='center' id='login_msg_erro'>
					</div>
				</div>
			</div>	
		</form>";
		
		echo $form;
	}



	
	public function sair(){
	
		unset($_SESSION["usuario"]);	
		$_SESSION["salvar_login"]  =  0;
		$_SESSION["remove_cookies"]  = 	 1;

	}
	
		
	
	
	
	private function loginValido($nome, $senha){
		
		include_once IGRSS_PATH_ABS.'usuarios/BeanUsuario.class.php';
	
		include_once IGRSS_BD_PATH_ABS.'BdUtil.class.php';
	
		$bd = new BdUtil();
	
		$retorno = $bd->getPrimeiroOuNada(
						new BeanUsuario(), 
						null, 
						"###.nome = '".$nome."' AND ###.senha = '".$senha."' and ###.status>0", 
						null);		
						
		$_SESSION["usuario"]  = null;
		return false;	
	}
	
	
	

	
	public function tentativaDeLogin(){
	
		include_once IGRSS_CMS_PATH_ABS.'Comuns.class.php';
		
		$comuns = new Comuns();

		$_POST["nome"] = $comuns->anti_injection( $_POST["nome"]);
		$_POST["senha"] = $comuns->anti_injection($_POST["senha"]);

		if( strlen($_POST["nome"])== 0 || 
				strlen($_POST["senha"]) < 6 ){
		
			echo '{"status":"erro"}';
			$_SESSION["usuario"]  = null;
			return;
		}
	
		if( $this->loginValido($_POST["nome"], hash('sha256', $_POST["senha"]))){
		
			if($_POST["salvar"]>0)
				$_SESSION["salvar_login"] = 1;
			else
				$_SESSION["salvar_login"] = 0;
		
			echo '{"status":"sucesso"}';
			return;
		}
	
	
		$_SESSION["usuario"]  = null;	
		$_SESSION["salvar_login"]  = 0;
		
		echo '{"status":"erro"}';			
	}
	
	
	
		

	
	public function configuraCookiesDeUsuario(){
		
		if( array_key_exists("remove_cookies", $_SESSION) && 
			$_SESSION["remove_cookies"]>0){

			setcookie("usuario", "", time() - 3600);
			setcookie("senha",   "", time() - 3600);
			$_SESSION["remove_cookies"] = 0;
		}
		else{
	
			$dandalf = new Gandalf;
	
			$usuario =$dandalf->usuarioAtual();
	
			if( array_key_exists("salvar_login", $_SESSION) && 
					$_SESSION["salvar_login"]> 0 &&
						is_object($usuario)){
		
				if(!array_key_exists("usuario", $_COOKIE) || 
						!array_key_exists("senha", $_COOKIE)){
				
					// 1 mes
					$tempo = time()+DURACAO_DE_COOKIES;	
				
					setcookie("usuario", $usuario->cpf, $tempo);
					setcookie("senha", $usuario->senha, $tempo);
					$_SESSION["salvar_login"] = 0;
				}
			}
		}
	}
	
	
	
	
	
	public function permitirAcesso(){
		
		$gandalf = new Gandalf;
		
		if(is_object($gandalf->usuarioAtual()))
			return true;
		
		if(array_key_exists("usuario", $_COOKIE) && strlen($_COOKIE["usuario"])>0 &&
			array_key_exists("senha", $_COOKIE) && strlen($_COOKIE["senha"])>0){
			
			include_once IGRSS_CMS_PATH_ABS.'Comuns.class.php';
		
			$comuns = new Comuns();
			
			$usuario = $comuns->anti_injection($_COOKIE["usuario"]);
			$senha = $comuns->anti_injection($_COOKIE["senha"]);

			return $this->loginValido($usuario, $senha);	
		}
		
		return false;	
	}
	
	
	
	

}

?>