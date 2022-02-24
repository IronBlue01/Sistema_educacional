<?php
namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{

	protected function initRoutes(){
	/*=======================================================
	ROTAS DO LOGIN===========================*/

		$routes['login'] = array(
			'route' => '/',
			'controller' => 'loginController',
			'action' => 'login'
		);

		$routes['validate'] = array(
			'route' => '/validate',
			'controller' => 'loginController',
			'action' => 'validate'
		);

		$routes['loginIndex'] = array(
			'route' => '/login',
			'controller' => 'loginController',
			'action' => 'loginIndex'
		);


		/*=======================================================
		ROTAS DOS ADMINISTRADORES===========================*/

		$routes['admin'] = array(
			'route' => '/home',
			'controller' => 'AdministradoresController',
			'action' => 'home'
		);

		$routes['curso'] = array(
			'route' => '/curso',
			'controller' => 'AdministradoresController',
			'action' => 'cursos'
		);

		$routes['insereCurso'] = array(
			'route' => '/insereCurso',
			'controller' => 'AdministradoresController',
			'action' => 'insereCurso'
		);

		$routes['professor'] = array(
			'route' => '/professor',
			'controller' => 'AdministradoresController',
			'action' => 'professor'
		);


		$routes['insereProfessor'] = array(
			'route' => '/insereProfessor',
			'controller' => 'AdministradoresController',
			'action' => 'insereProfessor'
		);

		$routes['turmas'] = array(
			'route' => '/turmas',
			'controller' => 'AdministradoresController',
			'action' => 'turmas'
		);

		$routes['insereTurma'] = array(
			'route' => '/insereTurma',
			'controller' => 'AdministradoresController',
			'action' => 'insereTurma'
		);

		$routes['alunos'] = array(
			'route' => '/alunos',
			'controller' => 'AdministradoresController',
			'action' => 'alunos'
		);

		$routes['insereAluno'] = array(
			'route' => '/insereAluno',
			'controller' => 'AdministradoresController',
			'action' => 'insereAluno'
		);

		$routes['turma'] = array(
			'route' => '/turma',
			'controller' => 'AdministradoresController',
			'action' => 'turma'
		);

		$routes['turmaAlun'] = array(
			'route' => '/turmaAlun',
			'controller' => 'AdministradoresController',
			'action' => 'turmaAlun'
		);

		$routes['/deleteAlun'] = array(
			'route' => '/deleteAlun',
			'controller' => 'AdministradoresController',
			'action' => 'deleteAlun'
		);


		$routes['/deleteProf'] = array(
			'route' => '/deleteProf',
			'controller' => 'AdministradoresController',
			'action' => 'deleteProf'
		);

		$routes['/modulos'] = array(
			'route' => '/modulos',
			'controller' => 'AdministradoresController',
			'action' => 'modulos'
		);



		$routes['insereModulo'] = array(
			'route' => '/insereModulo',
			'controller' => 'AdministradoresController',
			'action' => 'insereModulo'
		);

		$routes['edit_alun'] = array(
			'route' => '/edit_alun',
			'controller' => 'AdministradoresController',
			'action' => 'editAlun'
		);


				$routes['insereRelacaoProfessorTurma'] = array(
					'route' => '/insereRelacaoProfessorTurma',
					'controller' => 'AdministradoresController',
					'action' => 'insereRelacaoProfessorTurma'
				);

				$routes['del_module'] = array(
					'route' => '/deletarModulo',
					'controller' => 'AdministradoresController',
					'action' => 'deletarModulo'
				);

				


		/*=======================================================
		ROTAS DOS ALUNOS===========================*/

		$routes['dash_aluno'] = array(
			'route' => '/dash_aluno',
			'controller' => 'AlunoController',
			'action' => 'dashAluno'
		);


		$routes['questionario'] = array(
			'route' => '/questionario',
			'controller' => 'AlunoController',
			'action' => 'questionario'
		);

		$routes['questionario2'] = array(
			'route' => '/questionario2',
			'controller' => 'AlunoController',
			'action' => 'questionario2'
		);

		$routes['questionario3'] = array(
			'route' => '/questionario3',
			'controller' => 'AlunoController',
			'action' => 'questionario3'
		);

		$routes['questionario4'] = array(
			'route' => '/questionario4',
			'controller' => 'AlunoController',
			'action' => 'questionario4'
		);

		$routes['questionarioAlun'] = array(
			'route' => '/questionarioAlun',
			'controller' => 'AlunoController',
			'action' => 'questionarioAlun'
		);

		$routes['questionarioAlun2'] = array(
			'route' => '/questionarioAlun2',
			'controller' => 'AlunoController',
			'action' => 'questionarioAlun2'
		);


		$routes['excel'] = array(
			'route' => '/excel',
			'controller' => 'AlunoController',
			'action' => 'excel'
		);


		$routes['word'] = array(
			'route' => '/word',
			'controller' => 'AlunoController',
			'action' => 'word'
		);

		$routes['entrega'] = array(
			'route' => '/entrega',
			'controller' => 'AlunoController',
			'action' => 'entrega'
		);

		$routes['trab_entregue'] = array(
			'route' => '/trab_entregue',
			'controller' => 'AlunoController',
			'action' => 'trab_entregue'
		);

		$routes['windows'] = array(
			'route' => '/windows',
			'controller' => 'AlunoController',
			'action' => 'windows'
		);


		$routes['exc1'] = array(
			'route' => '/exc1',
			'controller' => 'AlunoController',
			'action' => 'exc1'
		);

		$routes['perfil_aluno'] = array(
			'route' => '/perfil_aluno',
			'controller' => 'AlunoController',
			'action' => 'perfilAluno'
		);


		$routes['UpPerfil'] = array(
			'route' => '/UpPerfil',
			'controller' => 'AlunoController',
			'action' => 'UpPerfil'
		);

		$routes['photoshop'] = array(
			'route' => '/photoshop',
			'controller' => 'AlunoController',
			'action' => 'photoshop'
		);

		$routes['removeTrabAlun'] = array(
			'route' => '/removeTrabAlun',
			'controller' => 'AlunoController',
			'action' => 'removeTrabAlun'
		);

		$routes['page_entregar'] = array(
			'route' => '/page_entregar',
			'controller' => 'AlunoController',
			'action' => 'page_entregar'
		);


		$routes['v_atividades'] = array(
			'route' => '/v_atividades',
			'controller' => 'AlunoController',
			'action' => 'Vatividades'
		);


		$routes['ent_trab'] = array(
			'route' => '/ent_trab',
			'controller' => 'AlunoController',
			'action' => 'entregarTrab'
		);

		$routes['ver_entrega'] = array(
			'route' => '/ver_entrega',
			'controller' => 'AlunoController',
			'action' => 'verEntrega'
		);

		$routes['homeAdm'] = array(
			'route' => '/home_adm',
			'controller' => 'AlunoController',
			'action' => 'homeAdm'
		);

		$routes['ead'] = array(
			'route' => '/ead',
			'controller' => 'AlunoController',
			'action' => 'ead'
		);

		/*=======================================================
		ROTAS professores===========================*/

		$routes['/dash_professor'] = array(
			'route' => '/dash_professor',
			'controller' => 'ProfessorController',
			'action' => 'dashProfessor'
		);

		$routes['/cadastroDeatividades'] = array(
			'route' => '/cadastroDeatividades',
			'controller' => 'ProfessorController',
			'action' => 'cadastroDeatividades'
		);



		$routes['/dia'] = array(
			'route' => '/dia',
			'controller' => 'ProfessorController',
			'action' => 'dia'
		);

		$routes['/P_turma'] = array(
			'route' => '/P_turma',
			'controller' => 'ProfessorController',
			'action' => 'pTurma'
		);


		$routes['/P_trab_ent'] = array(
			'route' => '/P_trab_ent',
			'controller' => 'ProfessorController',
			'action' => 'P_trab_ent'
		);

		$routes['/corrigir'] = array(
			'route' => '/corrigir',
			'controller' => 'ProfessorController',
			'action' => 'corrigir'
		);

		$routes['/removerTrab'] = array(
			'route' => '/removerTrab',
			'controller' => 'ProfessorController',
			'action' => 'removertrab'
		);

		$routes['/atividades'] = array(
			'route' => '/atividades',
			'controller' => 'ProfessorController',
			'action' => 'atividades'
		);

		$routes['/cad_atividade'] = array(
			'route' => '/cad_atividade',
			'controller' => 'ProfessorController',
			'action' => 'cad_atividade'
		);

		$routes['/pageCad_atividade'] = array(
			'route' => '/pageCad_atividade',
			'controller' => 'ProfessorController',
			'action' => 'pageCadAtividade'
		);

		$routes['/liberar_atividade'] = array(
			'route' => '/liberar_atividade',
			'controller' => 'ProfessorController',
			'action' => 'liberarAtividade'
		);

		$routes['/cad_liberar_atividade'] = array(
			'route' => '/cad_liberar_atividade',
			'controller' => 'ProfessorController',
			'action' => 'cadLiberarAtividade'
		);


		$routes['/modulo_atividades'] = array(
			'route' => '/modulo_atividades',
			'controller' => 'ProfessorController',
			'action' => 'moduloAtividade'
		);



		$routes['/AtividadesModulo'] = array(
			'route' => '/AtividadesModulo',
			'controller' => 'ProfessorController',
			'action' => 'AtividadesModulo'
		);


		$routes['/prof_teste'] = array(
			'route' => '/prof_teste',
			'controller' => 'ProfessorController',
			'action' => 'profTeste'
		);


		$routes['/deleteAlunP'] = array(
			'route' => '/deleteAlunP',
			'controller' => 'ProfessorController',
			'action' => 'deleteAlunP'
		);


		/*=======================================================
		ROTAS GENÉRICAS===========================*/
		$routes['logout'] = array(
			'route' => '/logout',
			'controller' => 'LoginController',
			'action' => 'logout'
		);


		$routes['teste'] = array(
			'route' => '/teste',
			'controller' => 'AdministradoresController',
			'action' => 'teste'
		);



		$this->setRoutes($routes);

}


}#end class

?>
