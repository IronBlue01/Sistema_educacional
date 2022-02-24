<?php
namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AlunoController extends Action {


	public function dashAluno(){
		$this->validaSesao();

		$modulos = Container::getModel('Modulo');
		$modulos->__set('curso',$this->view->cursoAlun['curso']);
		$modulos->__set('subcategoria',$_GET['sub']);
		$modulos->__set('id_turma',$this->view->IdTurma);
		$this->view->modulos = $modulos->getModulosByCursoAndSub();
		$this->render('index','layoutAluno');
	}#end fuction dashAluno()

	public function removeTrabAlun(){
		$this->validaSesao();
		$id_trabalho = $_GET['id_trab'];
		$entrega = Container::getModel('Entrega');
		$entrega->__set('id_entrega',$id_trabalho);
		$id_modulo = $_GET['id_modulo'];


		header("Location: /ver_entrega?modulo=$id_modulo");
	}#end functio removeTrabAlun

	public function questionario(){
		$this->validaSesao();
		$questionario = Container::getModel('Questionario');
		$questionario->__set('id_aluno',$_SESSION['id_aluno']);
		$this->view->num = $questionario->getQuest();

		$this->render('questionario','layoutAluno');
	}#end questionario()

	public function questionario2(){
		$this->validaSesao();

		$this->render('questionario2','layoutAluno');
	}#end questionario()

	public function questionario3(){
		$this->validaSesao();
		$this->render('questionario3','layoutAluno');
	}#end questionario()

	public function questionario4(){
		$this->validaSesao();
		$this->render('questionario4','layoutAluno');
	}#end questionario()

	public function questionarioAlun(){
		$this->validaSesao();

		$question = Container::getModel('Questionario');
		$question->__set('id_aluno',$_SESSION['id_aluno']);
		$question->__set('q1',$_POST['p1']);
		$question->__set('q2',$_POST['p2']);
		$question->__set('q3',$_POST['p3']);
		$question->__set('q4',$_POST['p4']);
		$question->__set('q5',$_POST['p5']);
		$question->__set('q6',$_POST['p6']);
		$question->__set('q7',$_POST['p7']);
		$question->__set('q8',$_POST['p8']);
		$question->__set('q9',$_POST['p9']);
		$question->__set('q10',$_POST['p10']);
		$question->__set('q11',$_POST['p11']);
		$question->__set('q12',$_POST['p12']);
		$question->__set('q13',$_POST['p13']);
		$question->cadQuestion();

		$_SESSION['enviado'] = true;
		header("Location: /questionario");
	}#end questionarioAlun

	public function questionarioAlun2(){
		$this->validaSesao();
		$_SESSION['enviado'] = true;
		header("Location: /questionario3");
	}#end questionarioAlun

	public function excel(){
			$this->validaSesao();


			$this->render('excel','layoutAluno');
	}#end excel

	public function word(){
			$this->validaSesao();

			$this->render('word','layoutAluno');
	}#end function word

	public function entrega(){
			$this->validaSesao();
			//Llista as informações do aluno
			$aluno = Container::getModel('Aluno');
			$aluno->__set('id_aluno',$_SESSION['id_aluno']);
			$this->view->infoAlun = $aluno->getAlunoById();
			$data = date('d/m/y');
			//instancia a tabela Entrega
			$entrega = Container::getModel('Entrega');
			$entrega->__set('id_aluno',$this->view->infoAlun['id_aluno']);
			$entrega->__set('id_turma',$this->view->infoAlun['turma']);
			$entrega->__set('arquivo',$_FILES['arquivo']);
			$entrega->__set('data',$data);
			$entrega->__set('nomeAtividade', $_POST['nomeTrabalho']);
			$entrega->__set('id_modulo',$_POST['id_modulo']);
			$entrega->__set('id_atividade',$_POST['id_atividade']);
			$entrega->insereEntrega();
			$_SESSION['env'] = true;
			$id_modulo = $_POST['id_modulo'];


			header("Location: /ver_entrega?modulo=$id_modulo");
	}#end function entrega()

	public function trab_entregue(){
		$this->validaSesao();

		$entrega = Container::getModel('Entrega');
		$entrega->__set('id_aluno',$_SESSION['id_aluno']);
		$this->view->entregues = $entrega->getTrabByIdAlun();


		$this->render('trab_entregue','layoutAluno');
	}#end function trab_entregue()



	public function windows(){
		$this->validaSesao();

		$this->render('windows','layoutAluno');
	}#end function windows

	public function exc1(){
		$this->validaSesao();
		$this->render('exc1','layoutAluno');
	}#end function exc1()

	public function perfilAluno(){
		$this->validaSesao();
		$aluno = Container::getModel('aluno');
		$aluno->__set('id_aluno',$_SESSION['id_aluno']);
		$this->view->infoAlun = $aluno->getAlunoById();

		$this->render('perfil_aluno','layoutAluno');
	}#end perfilAluno()

	public function UpPerfil(){
		$this->validaSesao();
		$aluno = Container::getModel('Aluno');
		$aluno->__set('nome',$_POST['nome']);
		$aluno->__set('username',$_POST['username']);
		$aluno->__set('email',$_POST['email']);
		$aluno->__set('senha',$_POST['senha']);
		$aluno->__set('id_aluno',$_POST['id_aluno']);
		$aluno->updatePerfil();
		header("Location: /perfil_aluno");
	}#end UpPerfil()

	public function page_entregar(){
		$this->validaSesao();

		//Busca o curso do aluno
		$aluno = Container::getModel('Aluno');
		$aluno->__set('id_aluno',$_SESSION['id_aluno']);
		$curso = $aluno->getAlunoById();

		//Lista todos os modulos referentes ao curso do aluno
		$modulo = Container::getModel('Modulo');
		$modulo->__set('curso',$curso['curso']);
		$this->view->modulo = $modulo->getModulo();

		$this->render('entregar','layoutAluno');
	}#end function page_entregar()

	public function Vatividades(){
		$this->validaSesao();

		$this->view->id_modulo = $_GET['modulo'];

		if($_GET['sub']=="N"){
			$sub = "---";
		}else{
			$sub = $_GET['sub'];
		}

		$atividades = Container::getModel("Atividades");
		$atividades->__set('id_turma',$this->view->IdTurma);
		$atividades->__set('subcategoria',$sub);
		$this->view->atividades = $atividades->getAtividadesLiberadas();
		$atividades->__set('id_aluno',$_SESSION['id_aluno']);
		$this->view->atividadesRealizadas = $atividades->getAtividadesRealizadas();


		$this->render('atividades','layoutAluno');
	}#end Vatividades()


	public function entregarTrab(){
		$this->validaSesao();

		$modulos = Container::getModel('Modulo');
		$modulos->__set('curso',$this->view->cursoAlun['curso']);
		$modulos->__set('subcategoria',$_GET['sub']);
		$this->view->modulos = $modulos->getModulosByCursoAndSub();


		$this->render('entregar_trab', 'layoutAluno');
	}#end entregarTrab

	public function verEntrega(){
		$this->validaSesao();
		$modulo = $_GET['modulo'];
		$id_aluno = $_SESSION['id_aluno'];
		$entrega = Container::getModel('Entrega');
		$entrega->__set('id_aluno',$id_aluno);
		$entrega->__set('id_modulo',$modulo);

		$this->view->trabalhos = $entrega->getTrabByIdAlunAndModul();

		$modulo = Container::getModel('Modulo');
		$modulo->__set('id_modulo',$_GET['modulo']);

		$this->view->nomeModulo = $modulo->getNameModul();


		$this->render('ver_entrega','layoutAluno');
	}#end ver entrega


	public function homeAdm(){
			$this->validaSesao();
			#define o id da turma de adm
			if($this->view->cursoAlun['curso']!=22){
				header("Location: /dash_aluno?sub=N");
			}

			$this->view->url = $_SERVER["REQUEST_URI"];

			$this->render('homeAdm', 'layoutAluno');
	}#end function homeAdm()

	public function ead(){
		$this->validaSesao();
		$ead = Container::getModel('Atividades');
		$ead->__set('id_atividade',$_GET['id_atividade']);
		$this->view->data = $ead->getAtividadesById();
		$this->view->arquivos = $ead->getArquivosAtividades();
		$ead->__set('id_aluno',$_SESSION['id_aluno']);
		$this->view->atividadesRealizadas = $ead->getAtividadesRealizadas();


		$this->render('ead','layoutAluno');
	}#end function ead()


	//valida se a sessão do usuario existe
	public function validaSesao(){
		session_start();

		$aluno = Container::getModel('Aluno');
		$_id_aluno = isset($_SESSION['id_aluno']) ? $_SESSION['id_aluno'] : $_COOKIE['id_aluno'];
		$aluno->__set('id_aluno',$_id_aluno);
		$this->view->infoAlun = $aluno->getAlunoById();
		$nome =  explode(' ', $this->view->infoAlun['nome']);
		$this->view->nome = $nome[0];
		$this->view->qtd_xp = $aluno->quantidade_xp()['qtd_xp'];


		//Pega a logo correta referente ao curso do aluno
		$aluno->__set('id_turma',$this->view->infoAlun['turma']);
		$this->view->logo = $aluno->pegaLogo();
		$this->view->cursoAlun = $aluno->pegaCurso();
		$this->view->IdTurma = $this->view->infoAlun['turma'];

		if(!isset($_SESSION['username']) && !isset($_SESSION['senha']) || $_SESSION['tipo'] != 'aluno'){
			if(!isset($_COOKIE['username']) && !isset($_COOKIE['senha']) || $_COOKIE['tipo'] != 'aluno'){
					header("Location: /?error");
			}
		}
	}#end function validaSesao()


}#end class
