<?php
 namespace App\Models;

 use MF\Model\Model;

 class Curso extends Model{

	 private $id_curso;
	 private $nome;
	 private $sigla;
	 private $DataImgCurso;

	 public function __get($atributo){
		 return $this->$atributo;
	 }#end function __get()

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end function __set()

	 public function insereCurso(){
		 $query = "INSERT INTO cursos (nomeCurso,sigla) VALUES(:nomeCurso,:sigla)";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':nomeCurso',$this->__get('nome'));
		 $stmt->bindValue(':sigla',$this->__get('sigla'));
		 //$stmt->bindValue(':imgCurso',$this->__get('DataImgCurso')['name']);
		 $stmt->execute();
	 }#end cadastrarCurso()

	 public function getCursos(){
		 $query =
		 "SELECT C.id_curso, C.nomeCurso, C.sigla FROM cursos as C";
		 $stmt  = $this->db->query($query);
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end getCursos()

	 public function OnlyCursos(){
		 $query =
		 "SELECT C.id_curso, C.nomeCurso FROM cursos as C WHERE id_curso = :id_curso";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_curso',$this->__get('id_curso'));
		 $stmt->execute();
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function onlyCurso()

	 public function contCurso(){
		 $query = "SELECT count(*) FROM cursos";
		 $stmt  = $this->db->query($query);
		 return $stmt->fetch(\PDO::FETCH_NUM)[0];
	 }#end function contCurso()











 }#end class
