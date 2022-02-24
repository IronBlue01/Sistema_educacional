<?php
namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class LoginController extends Action {

	public function login(){
		session_start();

		if(isset($_SESSION['tipo']) || isset($_COOKIE['tipo'])):

		$tipoUser = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : $_COOKIE['tipo'];

			switch ($tipoUser){
				case 'aluno':
					header("Location: /home_adm");
				  break;
				case 'professor':
					 header("Location: /dash_professor");
					break;
				case 'administrador':
					header("Location: /home");
				  break;
				default:
					// code...
					break;
			}

		endif;


		$this->render('login', '');
	}#end login

	public function loginIndex(){

		session_start();

		if(isset($_SESSION['tipo'])):


			switch ($_SESSION['tipo']) {
				case 'professor':
					 header("Location: /dash_professor");
					break;
				case 'administrador':
					header("Location: /home");
					break;
				default:
					// code...
					break;
			}

		endif;

		$this->render('login_index', '');
	}#end function loginIndex()


	public function validate(){

		switch ($_POST['tipo']) {
			case 'aluno':
				$validate = Container::getModel('Aluno');
				break;
			case 'professor':
				$validate = Container::getModel('Professor');
				break;
			case 'administrador':
				$validate = Container::getModel('Administrador');
				break;

			default:
				header("Location: /");
				break;
		}#end switch

		$validate->__set('username',$_POST['username']);
		$validate->__set('senha',$_POST['senha']);
	  $validate->validacao();

		if($validate->__get('access')==1){
			session_start();
			$_SESSION['nome']   = $validate->__get('nome');
			$_SESSION['username'] = $validate->__get('username');
			$_SESSION['senha']    = $validate->__get('senha');
			$_SESSION['tipo']     = $_POST['tipo'];

			//Se lembrar senha está marcado atribbui 1 se não zero
			$remember = isset($_POST['remember-me']) ? 1 : 0;

			//Cria o cookie do usuário caso o campo esteja marcado
			if($remember==1){
				setcookie('nome', $validate->__get('nome'),time()+3600*24*30*12);
				setcookie('username', $validate->__get('username'),time()+3600*24*30*12);
				setcookie('senha', $validate->__get('senha'),time()+3600*24*30*12);
				setcookie('tipo', $_POST['tipo'],time()+3600*24*30*12);
			}


			switch ($_POST['tipo']) {
				case 'aluno':
					#Direciona para a dash Aluno
          $_SESSION['id_aluno']   = $validate->__get('id_aluno');
					if($remember==1){ setcookie('id_aluno', $validate->__get('id_aluno'),time()+3600*24*30*12);}
					header("Location:/home_adm");
					break;
				case 'professor':
					#Direciona para a dash Professor
					$_SESSION['id_professor']   = $validate->__get('id_professor');
					if($remember==1){ setcookie('id_professor', $validate->__get('id_professor'),time()+3600*24*30*12);}
						header("Location:/dash_professor");
					break;
				case 'administrador':
				  $_SESSION['id_adm']   = $validate->__get('id_adm');
					if($remember==1){ setcookie('id_adm', $validate->__get('id_adm'),time()+3600*24*30*12);}
 					header("Location:/home");
					break;

				default:
				  session_destroy();
					header("Location: /");
					break;
			}#end switch

		}else{
			session_start();
			$_SESSION['error'] = true;
			header("Location: /");
		}

	}#end function validate()


	public function logout(){
		session_start();
		session_destroy();
		//Exclui os cookies
		setcookie('nome');
		setcookie('username');
		setcookie('senha');
		setcookie('tipo');

		//Exclui os IDS
		isset($_COOKIE['id_aluno']) ? setcookie('id_aluno') : '';
		isset($_COOKIE['id_professor']) ? setcookie('id_professor') : '';
		isset($_COOKIE['id_adm']) ? setcookie('id_adm') : '';
		header("Location: /");
	}#end function logout()

}#end class

?>
