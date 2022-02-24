<?php
namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class ProfessorController extends Action {

		public function dashProfessor(){
			$this->validaSesao();

			$this->render('home','layoutProfessor');
		}#end dashProfessor


		public function dia(){
			$this->validaSesao();
				//intancia o modelo de turma
				$turma = Container::getModel('Turma');
				$turma->__set('id_professor',  $this->view->infoprof['id_professor']);
				$turma->__set('dia',$_GET['D']);
				$this->view->turmas = $turma->getTurmaByProfAndDay();

				$this->render('dia','layoutProfessor');
		}#end function dia()

		public function pTurma(){
			$this->validaSesao();

			//Cria uma instancia de turma
			$turma = Container::getModel('Turma');
			$turma->__set('id_turma',$_GET['id_turma']);
			$this->view->infoTurma = $turma->getTurma();

			//Cria uma instancia de aluno pela turma
			$aluno = container::getModel('Aluno');
			$aluno->__set('id_turma',$_GET['id_turma']);
			$this->view->alunos =  $aluno->getAlunoByTurma();
			$this->render('PTurma','layoutProfessor');
		}#end fuction pTurma

		public function P_trab_ent(){
			$this->validaSesao();

			//Cria uma instancia de turma para pegar seu nome
			$turma = Container::getModel('Turma');
			$turma->__set('id_turma',$_GET['id_turma']);
			$this->view->infoTurma = $turma->getTurma();


			$entrega = Container::getModel('Entrega');
			$entrega->__set('id_turma',$_GET['id_turma']);
			$entrega->__set('id_modulo',$_GET['id_modulo']);
			$entrega->__set('id_professor',$_SESSION['id_professor']);
			$entrega->__set('id_atividade',$_GET['id_atividade']);

			$this->view->trabalhos =  $entrega->getEntregaByIdTurmaAndModulo();

			$atividade = Container::getModel('Atividades');
			$atividade->__set('id_atividade',$_GET['id_atividade']);
			$atividade->__set('id_turma',$_GET['id_turma']);
			//$atividade->__set('subcategoria',$_GET['subcategoria']);
			$this->view->atividade = $atividade->getAtividadesById();
			$this->view->atividadesLiberadas = $atividade->getArquivosAtividades();


			$this->render('trabEn','layoutProfessor');
		}#end fuction

		public function corrigir(){
			$this->validaSesao();

			$entrega = Container::getModel('Entrega');
			$entrega->__set('id_entrega',$_POST['id_entrega']);
			$entrega->__set('nota',$_POST['nota']);
			$entrega->__set('obs',$_POST['obs']);
			$entrega->updateEntrega();
			$id_turma = $_POST['id_turma'];
			$id_modulo = $_POST['id_modulo'];
			$id_atividade = $_POST['id_atividade'];

			header("Location: /P_trab_ent?id_turma=$id_turma&&id_modulo=$id_modulo&&id_atividade=$id_atividade");
		}#end function corrigir()

		public function removertrab(){
			$this->validaSesao();
			$entrega = Container::getModel('Entrega');
			$entrega->__set('id_entrega',$_GET['id_entrega']);
			//variaveis superglobais
			$id_turma     = $_GET['id_turma'];
			$id_modulo    = $_GET['id_modulo'];
			$id_atividade = $_GET['id_atividade'];
			$id_curso     = $_GET['id_curso'];
			$subcategoria = $_GET['subcategoria'];
			$entrega->removerTrabEntr();
			header("Location:/P_trab_ent?id_turma=$id_turma&&id_modulo=$id_modulo&&id_atividade=$id_atividade&&id_curso=$id_curso&&subcategoria=$subcategoria");
		}#end removertrab()

	public function atividades(){
			$this->validaSesao();

			//instância professor
			$professor = Container::getModel('Professor');
			$professor->__set('id_professor',$_SESSION['id_professor']);
			$this->view->id_curso = $professor->getProfessorById();

			//Lista todas atividades liberadas para está turmas
			$liberaAtividade = Container::getModel('Atividades');
			$liberaAtividade->__set('subcategoria',$this->view->id_curso['subcategoria']);
			$liberaAtividade->__set('id_turma',$_GET['id_turma']);
			$this->view->atividadesLiberadas =  $liberaAtividade->getAtividadesLiberadas();

			$this->render('incluiAt','layoutProfessor');
	}#end atividades()

	public function pageCadAtividade(){
		$this->validaSesao();

		//instância professor
		$professor = Container::getModel('Professor');
		$professor->__set('id_professor',$_SESSION['id_professor']);
		$this->view->id_curso = $professor->getProfessorById();

		//instância modulo
		$modulos = Container::getModel('Modulo');
		$modulos->__set('curso',$this->view->id_curso['curso']);
		$this->view->modulos = $modulos->getModulo();


		$this->render('pageCadAtividadenew','layoutProfessor');
	}#end function pageCadAtividade()

	public function cad_atividade(){
		$this->validaSesao();
		$atividades = Container::getModel('Atividades');
		$id_professor = intval($_SESSION['id_professor']);
		$atividades->__set('id_professor',$id_professor);
		$atividades->__set('modulo',$_POST['modulo']);
		$atividades->__set('id_curso',$_POST['id_curso']);
		$atividades->__set('titulo',$_POST['titulo']);
		$atividades->__set('xp_atividade',$_POST['xp_atividade']);
		$atividades->__set('data',$_POST['data']);
		$atividades->__set('img_cap',$_FILES['img']);
		$atividades->__set('description',$_POST['descricao']);
		//$atividades->__set('arquivo',$_FILES['arquivo']);
		$atividades->__set('img_view',$_FILES['img_view']);
		$atividades->__set('video',$_POST['video']);
		$atividades->__set('subcategoria',$_POST['subcategoria']);
		$tamanho = count($_FILES) - 2;

		$atividades->insereAtividade($tamanho);


		$id_turma   = $_POST['id_turma'];
		$nome_turma = $_POST['nome_turma'];
		$id_curso 	= $_POST['id_curso'];

		header("Location:/atividades?id_turma=$id_turma&&name=$nome_turma&&id_curso=$id_curso");
	}#end cad_atividades()

	public function liberarAtividade(){
		$this->validaSesao();

		//Pega a subcategoria do professor
		$professor = Container::getModel('Professor');
		$professor->__set('id_professor',$_SESSION['id_professor']);
		$this->view->infoProf = $professor->getProfessorById();

		//lista as atividades cadastradas para o curso e subcategoria presente
		$atividades = Container::getModel('Atividades');
		$atividades->__set('subcategoria',$this->view->infoProf['subcategoria']);
		$atividades->__set('id_curso',$_GET['id_curso']);
		$atividades->__set('id_turma',$_GET['id_turma']);
		$this->view->atividades = $atividades->getAtividadesByCursoAndSub();

		$this->render('liberarAtividade_new','layoutProfessor');
	}#end fucntion liberarAtividade()

	public function profTeste(){
		$modulo = Container::getModel('Liberamodulo');
		$modulo->__set('id_modulo',$_GET['id_modulo']);
		$modulo->__set('id_turma',$_GET['id_turma']);
		$modulo->cadastro();

	}#end profTeste()


	public function moduloAtividade(){
		$this->validaSesao();

		//Cria uma instancia de turma para pegar o nome da turma
		$turma = Container::getModel('Turma');
		$turma->__set('id_turma',$_GET['id_turma']);
		$this->view->infoTurma = $turma->getTurma();

		//Cria uma instância para módulos
		$modulo = Container::getModel('Modulo');
		$modulo->__set('curso',$_GET['id_curso']);
		$modulo->__set('subcategoria',$_GET['subcategoria']);
		$modulo->__set('id_turma',$_GET['id_turma']);
		$this->view->modulos = $modulo->getModulosByCursoAndSub();

		$this->render('moduloAtividadeNew','layoutProfessor');
	}#end function moduloAtividade()

	public function cadastroDeatividades(){
		$this->validaSesao();
     $teste = Container::getModel('Liberaatividade');
		 $teste->__set('id_turma',$_GET['id_turma']);
		 $teste->__set('id_atividade',$_GET['id_atividade']);
		 $teste->LiberarAtividade();
	}#end cadastro de atividades

public function AtividadesModulo(){
	$this->validaSesao();
	$atividades = Container::getModel('Atividades');
	$atividades->__set('id_modulo',$_GET['id_modulo']);
	$atividades->__set('id_turma',$_GET['id_turma']);
	$this->view->atividades = $atividades->getAtividadeByModuloTeste();

	$this->render('AtividadesModulo','layoutProfessor');
}#end function AtividadesModulo()

public function deleteAlunP(){
	$this->validaSesao();
	$aluno = Container::getModel("Aluno");
	$aluno->__set('id_aluno',$_GET['id']);
	$aluno->RemoveAluno();

	header("Location:".$_SERVER['HTTP_REFERER']);
}#end function deleteAlun()

	//valida se a sessão do usuario existe
	public function validaSesao(){
		session_start();
		//pega o nome do professor
		$professor = Container::getModel('Professor');
		$id_professor = isset($_SESSION['id_professor']) ? $_SESSION['id_professor'] : $_COOKIE['id_professor'];
		$professor->__set('id_professor',$id_professor);
		$this->view->infoprof = $professor->getProfessorById();
		$nome =  explode(' ', $this->view->infoprof['nome']);
		$this->view->nome = $nome[0];
		$this->view->catProfessor = $this->view->infoprof['subcategoria'];

		if(!isset($_SESSION['username']) && !isset($_SESSION['senha']) || $_SESSION['tipo'] != 'professor'){
			if(!isset($_COOKIE['username']) && !isset($_COOKIE['senha']) || $_COOKIE['tipo'] != 'professor'){
					header("Location: /?error");
			}
		}
	}#end function validaSesao()


}#end class
