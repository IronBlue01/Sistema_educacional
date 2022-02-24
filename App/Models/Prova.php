<?php
 namespace App\Models;

 use MF\Model\Model;

 class Prova extends Model{

	 private $id_prova;
	 private $id_aluno;
	 private $q1;
	 private $q2;
	 private $q3;
	 private $q4;
	 private $q5;
	 private $q6;
	 private $q7;
	 private $q8;
	 private $q9;
	 private $q10;
	 private $nota;
	 private $access;

	 public function __get($atributo){
		 return $this->$atributo;
	 }#end function __get()

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end function __set()

	 public function inserir(){
		 $query ="INSERT INTO prova
		  (  id_aluno,
				 tipo,
				 questao1,
				 questao2,
				 questao3,
				 questao4,
				 questao5,
				 questao6,
				 questao7,
				 questao8,
				 questao9,
				 questao10,
				 nota
			)
		  VALUES
			(
				:id_aluno,
				'excel',
				:questao1,
				:questao2,
				:questao3,
				:questao4,
				:questao5,
				:questao6,
				:questao7,
				:questao8,
				:questao9,
				:questao10,
				0
			)";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
			$stmt->bindValue(':questao1',$this->__get('q1'));
			$stmt->bindValue(':questao2',$this->__get('q2'));
			$stmt->bindValue(':questao3',$this->__get('q3'));
			$stmt->bindValue(':questao4',$this->__get('q4'));
			$stmt->bindValue(':questao5',$this->__get('q5'));
			$stmt->bindValue(':questao6',$this->__get('q6'));
			$stmt->bindValue(':questao7',$this->__get('q7'));
			$stmt->bindValue(':questao8',$this->__get('q8'));
			$stmt->bindValue(':questao9',$this->__get('q9'));
			$stmt->bindValue(':questao10',$this->__get('q10'));
			$stmt->execute();
	 }#end function inserir()

	 public function verifica(){
		 $query = "SELECT id_aluno FROM prova WHERE id_aluno = :id_aluno";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		 $stmt->execute();
		 $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
		 if($usuario['id_aluno'] != ''){
			 $this->__set('access',true);
		 }
	 }#end function prova()





}#end class
