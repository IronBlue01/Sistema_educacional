<?php
namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AdministradoresController extends Action {

	public function home(){
		$this->validaSesao();

		$nomeUser = isset($_SESSION['nome']) ? $_SESSION['nome'] : $_COOKIE['nome'];
		$tipoUser = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : $_COOKIE['tipo'];


		$this->view->nome = explode(' ',$nomeUser);
		$this->view->tipo = $tipoUser;
		//instancia o modelo de curso
		$cursos = Container::getModel('Curso');
		$this->view->NumCursos = $cursos->contCurso();
		//instancia o modelo de professores
		$cursos = Container::getModel('Professor');
		$this->view->NumProfessores = $cursos->contProfessor();
		//instancia o modelo de turmas
		$turmas = Container::getModel('Turma');
		$this->view->NumTurmas = $turmas->contTurmas();
		//instancia o modelo de alunos
		$alunos = Container::getModel('Aluno');
		$this->view->NumAlunos = $alunos->contAluno();

		//renderiza a view principal
		$this->render('index', 'layoutAdm');
	}#end function layout()

	public function editAlun(){
		$this->validaSesao();

		//instância modelo de turmas
		$alunos = Container::getModel('Aluno');
		$id_turma = $_GET['turma'];

		$alunos->__set('id_turma',$id_turma);
		$this->view->alunos = $alunos->getAlunoByTurma();


		$this->render('editAlun','layoutAdm');
	}#end function editAlun()


	public function cursos(){
		$this->validaSesao();
		$cursos = Container::getModel('Curso');
		$this->view->cursos = $cursos->getCursos();

		$this->render('cursos','layoutAdm');
	}#end function cadastrarCursos()

	public function insereCurso(){
		$this->validaSesao();
		$curso = Container::getModel('Curso');
		$curso->__set('nome',$_POST['curso']);
		$curso->__set('sigla',$_POST['sigla']);
		//$curso->__set('DataImgCurso',$_FILES['img']);
		$curso->insereCurso();
		header("Location: /home");
	}#end insereCurso()

	public function professor(){
		$this->validaSesao();
		//instacia o objeto curos
		$cursos = Container::getModel('curso');
		$this->view->cursos = $cursos->getCursos();
		//Cria uma instancia de professores
		$professores = Container::getModel('Professor');
		$this->view->infoProfessores = $professores->getProfessorAndNameCurso();
		$this->render('professores','layoutAdm');
	}#end function pageProfessores()

	public function insereProfessor(){
		$this->validaSesao();
		$professores = Container::getModel('professor');
		$professores->__set('nome',$_POST['nome']);
		$professores->__set('username',$_POST['username']);
		$professores->__set('senha',$_POST['senha']);
		$professores->__set('curso',$_POST['leciona']);
		$professores->__set('subcategoria',$_POST['subcategoria']);

		$professores->cadastrarProfessor();
		header("Location: /professor");
	}#end function insereProf()

	public function turmas(){
		 $this->validaSesao();
		 //lista os cursos
		 $curso = Container::getModel('Curso');
		 $this->view->cursos = $curso->getCursos();

		 //lista os prfessores
		 $curso = Container::getModel('Professor');
		 $this->view->dataProf = $curso->getDataProf();


		 $this->render('turmas','layoutAdm');
	}#end  function  pageTurmas()

	public function turma(){
		$this->validaSesao();
		//instância de curso
		$curso = Container::getModel('Curso');
		$curso->__set('id_curso',$_GET['curso']);
		$this->view->nome = $curso->OnlyCursos();
		//Instância de turma
		$turmas = Container::getModel('turma');
		$turmas->__set('curso',$_GET['curso']);
		$this->view->turmas = $turmas->getTurmasByCurso();


		$this->render('turma','layoutAdm');
	}#end function turma()

	public function insereTurma(){
		$this->validaSesao();
		$turma = Container::getModel('Turma');
		$turma->__set('nomeTurma',$_POST['nome']);
		$turma->__set('curso',$_POST['curso']);
		$turma->__set('subcategoria',$_POST['subcategoria']);
		$turma->__set('stattus',0);
		$turma->__set('dia',$_POST['dia']);
		$turma->__set('horario_ini',$_POST['horario_ini']);
		$turma->__set('horario_ter',$_POST['horario_ter']);
	  $turma->cadastrarTurma();
		$id_turma = $turma->__get('id_turma');
		header("Location:/turmaAlun?turma=$id_turma");
	}#end function insereTurma()


	public function insereRelacaoProfessorTurma(){
		$this->validaSesao();
		$divisor = explode('-',$_POST['professor']);
		$id_professor = $divisor[0];
		$subcategoria = $divisor[1];
		$id_turma     = $_POST['id_turma'];

		$professor = Container::getModel('Professor');
		$professor->__set('id_turma',$id_turma);
		$professor->__set('id_professor',$id_professor);
		$professor->__set('subcategoria',$subcategoria);
		$professor->CadRelationTurmaProf();

		header("Location:turmaAlun?turma=$id_turma&&CadProf");

	}#end function insereRelacaoProfessorTurma()

	public function turmaAlun(){
		$this->validaSesao();
		//instância modelo de turmas
		$turma = Container::getModel('Turma');
		$id_turma = $_GET['turma'];

		$turma->__set('id_turma',$id_turma);
		$this->view->infoTurma = $turma->getTurma();


		//instacia o modelo de alunos por turma
		$alunos = Container::getModel('Aluno');
		$alunos->__set('id_turma',$id_turma);
		$this->view->alunos = $alunos->getAlunoByTurma();

		//instacia o modelo de profesores
		$professor = Container::getModel('Professor');
		$this->view->professores = $professor->getProfessoresByCurso($this->view->infoTurma['curso']);
		$professor->__set('id_turma',$id_turma);
		$this->view->ProfessoresCadastrados = $professor->getProfessoresByTurma();

		//renderiza a pagina que lista os alunos
		$this->render('turmaAlun','layoutAdm');
	}#end turmaAlun()

	public function alunos(){
		$this->validaSesao();
		//listas as turmas
		$turma = Container::getModel('Turma');
		$this->view->turmas = $turma->getTurmas();
		//Renderiza a pagina alunos
		$this->render('alunos','layoutAdm');
	}#end function alunos()

	public function insereAluno(){
		$this->validaSesao();
		$aluno = Container::getModel('Aluno');
		$aluno->__set('nome',$_POST['nome']);
		$aluno->__set('username',$_POST['username']);
		$aluno->__set('senha',$_POST['senha']);
		$aluno->__set('turma',$_POST['turma']);
		$aluno->__set('telefone',$_POST['phone']);
		$aluno->cadastrarAluno();
		$goBack = $_POST['goBack'];
		$idTurma = $_POST['turma'] ;

		if(!isset($_POST['parameter'])){
			header("Location: /home");
		}else{
			header("Location: /$goBack?turma=$idTurma");
		}

	}#end function insereAlunos()

	public function deleteAlun(){
		$this->validaSesao();
		$aluno = Container::getModel('Aluno');
		$aluno->__set('id_aluno',$_GET['id']);
		$aluno->RemoveAluno();
		$turma = $_GET['turma'];
		header("Location: /turmaAlun?turma=$turma");
	}#end function


	public function materia(){
		$this->validaSesao();
		//$professores = Container::getModel('Professor');
		//$curso = $_GET['curso'];
		//$this->view->infoProfessor = $professores->getProfessoresByCurso($curso);
		//Renderiza a pagina alunos
		//$this->render('materia','layoutAdm');
	}#end function informaticaAplicada()

	public function removerTurma(){
		$this->validaSesao();
		$turma = Container::getModel('turma');
		$turma->__set('id_turma',$_GET['id_turma']);
		$turma->removerTurma();
		header("Location: /turmas");
	}#end removerTurma()

	public function removerProfessor(){
		$this->validaSesao();
		$professor = Container::getModel('professor');
		$professor->__set('id_professor',$_GET['id_professor']);
		$professor->removerProfessor();
		header("Location: /professores");
	}#end removerProfessor()

	public function PerfilProfessor(){
		$this->validaSesao();
		$turmas = Container::getModel('turma');
		$turmas->__set('id_professor',$_GET['cod']);
		$this->view->turmas = $turmas->getTurmasProf();
		//renderiza a página
		$this->render('PerfilProfessor','layoutAdm');
	}#end PerfilProfessor()

	public function modulos(){
		$this->validaSesao();
		$turma = Container::getModel('Turma');
		$modulo = Container::getModel('Modulo');
		$modulo->__set('curso',$_GET['curso']);
		$this->view->infoModulo = $modulo->getModulo();

		$this->render('modulos','layoutAdm');
	}#end function modulos

	public function insereModulo(){
		$this->validaSesao();

		//Cria uma instância de modulos
		$modulo = Container::getModel('Modulo');
		$modulo->__set('nome_modulo',$_POST['modulo']);
		$modulo->__set('qtd_aulas',$_POST['aulas']);
		$modulo->__set('curso',$_POST['curso']);
		$modulo->__set('img',$_FILES['img']);
		$modulo->__set('descricao',$_POST['descricao']);
		$modulo->__set('subcategoria',$_POST['subcategoria']);
		$curso = $_POST['curso'];
		$modulo->insereModulo();

		header("Location:/modulos?curso=$curso");

	}#insereModulo()

	public function deletarModulo(){
		$this->validaSesao();
		$module = Container::getModel('Modulo');
		$module->__set('id_modulo',$_GET['id_modulo']);
		$nomemodule = $module->deletaModulo();
		$id_curso = $_GET['id_curso'];
		header("Location:/modulos?curso=$id_curso&&delOk");
	}#end deletarModulo()


	public function deleteProf(){
		$this->validaSesao();
		$professor = Container::getModel('Professor');
		$professor->__set('id_professor',$_GET['id_prof']);
		$professor->removerProfessor();
		header("Location: /professor");
	}#end function


	public function teste(){
		$arquivos = Container::getModel('Script');
		$arquivos->upTurma();

		$this->render('teste','layoutAdm');
	}#end function script



	//valida se a sessão do usuario existe
	public function validaSesao(){
		session_start();

		if(!isset($_SESSION['username']) && !isset($_SESSION['senha']) || $_SESSION['tipo'] != 'administrador'){

			if(!isset($_COOKIE['username']) && !isset($_COOKIE['senha']) || $_COOKIE['tipo'] != 'administrador'){
					header("Location: /?error");
			}

		}
	}#end function validaSesao()


}#end class
