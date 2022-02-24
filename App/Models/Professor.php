<?php
 namespace App\Models;

 use MF\Model\Model;

 class Professor extends Model{

	private $id_professor;
	private $id_turma;
	private $nome;
	private $username;
	private $senha;
	private $email;
	private $nascimento;
	private $access;
	private $curso;
	private $subcategoria;

	public function __get($atributo){
		return $this->$atributo;
	}#end __get

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}#end __set





	public function getProfessorAndNameCurso(){

		$query = "SELECT P.id_professor, P.nome, P.username, C.nomeCurso
							FROM professores as P
							INNER JOIN cursos as C on(P.curso = C.id_curso)";

		$stmt  = $this->db->query($query);
		$valor =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $valor;

	}#end function getProfessorAndNameCurso()

	public function getProfessoresByTurma(){
		$query = "SELECT p.id_professor, P.nome, P.subcategoria
							FROM turmaprofessor as T
							INNER JOIN professores as P on(T.id_professor = P.id_professor)
							WHERE T.id_turma = :id_turma";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_turma',$this->__get('id_turma'));
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}#end function getProfessoresByTurma


	public function  getDataProf(){
		$query = "SELECT * FROM professores";
		$stmt  = $this->db->prepare($query);
		$stmt->execute();
	  $valor = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $valor;
	}#end function getNomeProf()





	public function getProfessoresByCurso(int $curso){
		$query = "SELECT * FROM professores as P WHERE curso = :curso";

		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':curso',$curso);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}#end function getProfessoresByCurso()


	public function getProfessorById(){
		$query = "SELECT * FROM professores WHERE id_professor  = :id_professor";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_professor',$this->__get('id_professor'));
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}#end function getProfessorById


	public function cadastrarProfessor(){
		$query = "INSERT INTO professores VALUES (default, :nome, :username, :senha, :curso, :subcategoria)";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':nome',$this->__get('nome'));
		$stmt->bindValue(':username',$this->__get('username'));
		$stmt->bindValue(':senha',$this->__get('senha'));
		$stmt->bindValue(':curso',$this->__get('curso'));
		$stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
		$stmt->execute();
	}#end function cadastrarProfessor();


	 public function  CadRelationTurmaProf(){
		$query = "INSERT INTO turmaprofessor (id_turma,id_professor,subcategoria) VALUES(:id_turma,:id_professor,:subcategoria)";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_turma',$this->__get('id_turma'));
		$stmt->bindValue(':id_professor',$this->__get('id_professor'));
		$stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
		$stmt->execute();
	 }#end function CadRelationTurmaProf()


	public function contProfessor(){
		$query = "SELECT count(*) FROM professores";
		$stmt  = $this->db->query($query);
		return $stmt->fetch(\PDO::FETCH_NUM)[0];
	}#end function contProfessor()


	public function validacao(){
		$query =
		"SELECT id_professor, nome, username, senha
		 FROM professores
		 WHERE username = :username and senha = :senha";
		 $stmt = $this->db->prepare($query);
		 $stmt->bindValue(':username',$this->__get('username'));
		 $stmt->bindValue(':senha',$this->__get('senha'));
		 $stmt->execute();

		 $usuario =  $stmt->fetch(\PDO::FETCH_ASSOC);

		 if($usuario['id_professor'] != '' && $usuario['nome'] != ''){
				 $this->__set('id_professor',$usuario['id_professor']);
				 $this->__set('nome',$usuario['nome']);
				 $this->__set('access',true);
		 }

		 return $this;
	}#end validacao

	public function removerProfessor(){
		$query = "DELETE FROM professores WHERE id_professor = :id_professor";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_professor',$this->__get('id_professor'));
		$stmt->execute();
	}#end removerProfessor()






 }#end class

?>
