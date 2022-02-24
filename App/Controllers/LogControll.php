<?php
namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class logControll extends Action {

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
			//Caso o usuario exista cria a sua sessão
			session_start();
			$_SESSION['nome']   = $validate->__get('nome');
			$_SESSION['username'] = $validate->__get('username');
			$_SESSION['senha']    = $validate->__get('senha');
			$_SESSION['tipo']     = $_POST['tipo'];

			//Direciona o usuario para página correspondente a seu tipo
			switch ($_POST['tipo']) {
				case 'aluno':
					#Direciona para a dash Aluno
					$_SESSION['id_aluno']   = $validate->__get('id_aluno');
					header("Location:/Dash_aluno");
					break;
				default:
					session_destroy();
					header("Location: /");
					break;
				}#end swich



		}else{
			session_start();
			$_SESSION['error'] = true;
			header("Location: /");
		}






	}#end validate


}#end class


 ?>
