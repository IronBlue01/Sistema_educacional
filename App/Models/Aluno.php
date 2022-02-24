<?php
 namespace App\Models;

 use MF\Model\Model;

 class Aluno extends Model{

	private $id_aluno;
	private $id_turma;
	private $avatar;
	private $nome;
	private $username;
	private $senha;
	private $email;
	private $turma;
	private $access;
	private $telefone;

	public function __get($atributo){
		return $this->$atributo;
	}#end __get

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}#end __set


	public function cadastrarAluno(){
			$query = "INSERT INTO alunos (avatar,nome,username,senha,telefone,turma) VALUES ('avatar.jpg',:nome,:username,:senha,:telefone,:turma)";
			$stmt  = $this->db->prepare($query);
			$stmt->bindValue(':nome',$this->__get('nome'));
			$stmt->bindValue(':username',$this->__get('username'));
			$stmt->bindValue(':senha',$this->__get('senha'));
			$stmt->bindValue(':telefone',$this->__get('telefone'));
			$stmt->bindValue(':turma',$this->__get('turma'));
			$stmt->execute();
	}#end function cadastrarAluno()

	public function getAlunoByTurma(){
			$query = "SELECT * FROM alunos WHERE turma = :id_turma";
			$stmt  = $this->db->prepare($query);
			$stmt->bindValue(':id_turma',$this->__get('id_turma'));
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}#end function getAlunoByTurma()


	public function getAlunoById(){
		$query =
		"SELECT
		 	A.id_aluno,
			A.avatar,
			A.nome,
			A.username,
			A.senha,
			A.email,
			A.turma,
			T.curso
			FROM alunos as A
			inner join turmas as T on (A.turma = T.id_turma)
			WHERE A.id_aluno  = :id_aluno";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}#end function()


	public function contAluno(){
		$stmt = $this->db->query("SELECT count(*) FROM alunos");
		return $stmt->fetch(\PDO::FETCH_NUM)[0];
	}#end function contAluno()


	public function RemoveAluno(){
		$query = "DELETE FROM alunos WHERE id_aluno = :id_aluno";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		$stmt->execute();
	}#end function Remove Aluno()




	public function validacao(){
		$query =
		"SELECT id_aluno, nome, username, senha
		 FROM alunos
		 WHERE username = :username and senha = :senha
		 			 ||
					 telefone = :username and senha = :senha
					 ";
		 $stmt = $this->db->prepare($query);
		 $stmt->bindValue(':username',$this->__get('username'));
		 $stmt->bindValue(':senha',$this->__get('senha'));
		 $stmt->execute();

		 $usuario =  $stmt->fetch(\PDO::FETCH_ASSOC);

		 if($usuario['id_aluno'] != '' && $usuario['nome'] != ''){
				 $this->__set('id_aluno',$usuario['id_aluno']);
				 $this->__set('nome',$usuario['nome']);
				 $this->__set('access',true);
				 $this->InsereHistorico($usuario['id_aluno']);
		 }

		 return $this;

	}#end validacao

	public function InsereHistorico($id_aluno){
			date_default_timezone_set('America/Sao_Paulo');
			$data = date('d/m/Y  H:i:s');
			$query = "INSERT INTO historico (id_aluno,operation,data) VALUES(:id_aluno,:operation,:data)";
			$stmt  = $this->db->prepare($query);
 			$stmt->bindValue(':id_aluno',$id_aluno);
			$stmt->bindValue(':operation','acessou o sistema');
			$stmt->bindValue(':data',$data);
			$stmt->execute();
	}#end function InsereHistorico()

	public function updatePerfil(){
		$query = "UPDATE alunos SET nome = :nome, senha = :senha, email = :email  WHERE id_aluno = :id_aluno";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':nome',$this->__get('nome'));
		$stmt->bindValue(':senha',$this->__get('senha'));
		$stmt->bindValue(':email',$this->__get('email'));
		$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		$stmt->execute();
	}#end updatePerfil()

	public function pegaLogo(){
		$query = "SELECT curso FROM turmas WHERE id_turma = :id_turma";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_turma',$this->__get('id_turma')) ;
		$stmt->execute();
		$turma = $stmt->fetch(\PDO::FETCH_ASSOC);

		$query = "SELECT * FROM cursos WHERE id_curso = :curso";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':curso', $turma['curso']);
		$stmt->execute();
		$logo = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $logo;

	}#end function pegaLogo()

	public function pegaCurso(){
		$query = "SELECT T.curso, T.nomeTurma, C.nomeCurso
							FROM turmas as T
							INNER JOIN cursos as C on(T.curso = C.id_curso)
							WHERE T.id_turma = :id_turma";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_turma',$this->__get('id_turma')) ;
		$stmt->execute();
		$turma = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $turma;
	}#end function pegaCurso()

  public function quantidade_xp(){
    $query = "SELECT SUM(xp) as qtd_xp FROM xp_alunos WHERE id_aluno = :id_aluno";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
    $stmt->execute();
    $xp = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $xp;
  }#end function quantidade_xp()



 }#end class

?>
