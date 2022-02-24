<?php
 namespace App\Models;

 use MF\Model\Model;

 class Turma extends Model{

	private $id_turma;
	private $nomeTurma;
	private $id_professor;
	private $dia;
	private $horario_ini;
	private $horario_ter;
	private $curso;
	private $professor;
	private $stattus;
	private $subcategoria;

 public function __get($atributo){
	 return $this->$atributo;
 }#end __get

 public function __set($atributo, $valor){
	 $this->$atributo = $valor;
 }#end __set

 public function cadastrarTurma(){
	 $query = "INSERT INTO turmas (nomeTurma,curso,numero,dia,horario_ini,horario_ter,stattus) VALUES(:nomeTurma,:curso,:numero,:dia,:horario_ini,:horario_ter,:stattus)";
	 $stmt  = $this->db->prepare($query);
	 $stmt->bindValue(':nomeTurma',$this->__get('nomeTurma'));
	 $stmt->bindValue(':curso',$this->__get('curso'));
	 $stmt->bindValue(':numero',0);
	 $stmt->bindValue(':dia',$this->__get('dia'));
	 $stmt->bindValue(':horario_ini',$this->__get('horario_ini'));
	 $stmt->bindValue(':horario_ter',$this->__get('horario_ter'));
	 $stmt->bindValue(':stattus',0);
	 $stmt->execute();
	 $this->__set('id_turma', $this->db->lastInsertId());
 }#end functio cadastraTurma()




 public function getTurmas(){
	 	$query = "SELECT id_turma, nomeTurma FROM turmas";
		$stmt  = $this->db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	  //$query = "SELECT T.id_turma, T.serie, C.nomeCurso, P.nome, (SELECT count(*) FROM alunos as A WHERE A.turma = T.id_turma) as num FROM turmas as T INNER JOIN cursos as C  on(C.id_curso = T.curso) INNER JOIN professores as P on(P.id_professor = T.professor)";
		//$stmt = $this->db->query($query);
		//return $stmt->fetchAll(\PDO::FETCH_ASSOC);
 }#end function getTurmas()

 public function getTurmasProf(){
	 $query = "SELECT T.id_turma, T.dia, T.serie,C.nomeCurso,
	 					(SELECT COUNT(*) FROM alunos as A WHERE A.Turma = T.id_turma) as NumAlun
	 					FROM turmas as T
						INNER JOIN cursos as C on(C.id_curso = T.curso)
						WHERE T.professor = :id_professor";
 	 $stmt = $this->db->prepare($query);
	 $stmt->bindValue(':id_professor',$this->__get('id_professor')) ;
	 $stmt->execute();
	 $turmas =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 return $turmas;
 }#end getTurmasProf()

 public function getTurmaByProfAndDay(){

	 $query = "SELECT
	 					 TP.id_turma,
						 T.nomeTurma,
						 T.horario_ini,
						 T.horario_ter
						 FROM turmaprofessor as TP
	  				 INNER JOIN turmas as T ON(TP.id_turma = T.id_turma)
	 					 WHERE TP.id_professor = :id_professor and T.dia = :dia";
	 $stmt  = $this->db->prepare($query);
	 $stmt->bindValue(':id_professor',$this->__get('id_professor'));
	 $stmt->bindValue(':dia',$this->__get('dia'));
	 $stmt->execute();
	 return $stmt->fetchAll(\PDO::FETCH_ASSOC);


 }#end function getTurmaByProfAndDay

 public function getTurma(){
	 $query = "SELECT * FROM turmas WHERE id_turma = :id_turma";
	 $stmt  = $this->db->prepare($query);
	 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
	 $stmt->execute();
	 return $stmt->fetch(\PDO::FETCH_ASSOC);
 }#end getTurma()


public function contTurmas(){
	$query = "SELECT COUNT(*) FROM turmas";
	$stmt  = $this->db->query($query) ;
	return $stmt->fetch(\PDO::FETCH_NUM);
}#end contTurmas

	public function getTurmasByCurso(){
		$query = "SELECT * FROM turmas WHERE curso = :curso";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':curso',$this->__get('curso'));
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}#end function getTurmasByCurso()


 public function removerTurma(){
	 $query = "DELETE FROM turmas WHERE id_turma = :id_turma";
	 $stmt  = $this->db->prepare($query);
	 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
	 $stmt->execute();
 }#end removerTurma



}#end class
