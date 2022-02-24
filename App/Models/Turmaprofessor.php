<?php
 namespace App\Models;

 use MF\Model\Model;

 class Turmaprofessor extends Model{

	 private $id_turma_professor;
	 private $id_turma;
	 private $id_professor;
	 private $subcategoria;

	 public function __get($atributo){
		return $this->$atributo;
	 }#end __get

	 public function __set($atributo, $valor){
		$this->$atributo = $valor;
	 }#end __set

	 public function getTurmaProfByTurmaAndSub(){
		 	$query = "SELECT * FROM turmaprofessor WHERE id_turma = :id_turma and subcategoria = :subcategoria";
			$stmt  = $this->db->prepare($query);
			$stmt->bindValue(':id_turma';$this->__get('id_turma'));
			$stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function getTurmaProfByTurmaAndSub()








}
