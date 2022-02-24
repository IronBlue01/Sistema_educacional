<?php
 namespace App\Models;

 use MF\Model\Model;

 class Provahwr extends Model{

	 private $id_prova;
	 private $id_aluno;
	 private $tipo;
	 private $questao_1;
	 private $questao_2;
	 private $questao_3;
	 private $questao_4;
	 private $questao_5;
	 private $questao_6;
	 private $questao_7;
	 private $questao_8;
	 private $questao_9;
	 private $questao_10;
	 private $questao_11;
	 private $questao_12;
	 private $questao_13;
	 private $nota;


	 public function __get($atributo){
		 return $this->$atributo;
	 }#end function __get()

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end function __set()


	 public function cadastrar(){
		 $query = "INSERT INTO provahwr
		 						(id_aluno,
									tipo,
									questao_1,
									questao_2,
									questao_3,
									questao_4,
									questao_5,
									questao_6,
									questao_7,
									questao_8,
									questao_9,
									questao_10,
									questao_11,
									questao_12,
									questao_13,
									nota
								)
								VALUES
								(
									:id_aluno,
									:tipo,
									:questao_1,
									:questao_2,
									:questao_3,
									:questao_4,
									:questao_5,
									:questao_6,
									:questao_7,
									:questao_8,
									:questao_9,
									:questao_10,
									:questao_11,
									:questao_12,
									:questao_13,
									0
								)";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		 $stmt->bindValue(':tipo',$this->__get('tipo'));
		 $stmt->bindValue(':questao_1',$this->__get('questao_1'));
		 $stmt->bindValue(':questao_2',$this->__get('questao_2'));
		 $stmt->bindValue(':questao_3',$this->__get('questao_3'));
		 $stmt->bindValue(':questao_4',$this->__get('questao_4'));
		 $stmt->bindValue(':questao_5',$this->__get('questao_5'));
		 $stmt->bindValue(':questao_6',$this->__get('questao_6'));
		 $stmt->bindValue(':questao_7',$this->__get('questao_7'));
		 $stmt->bindValue(':questao_8',$this->__get('questao_8'));
		 $stmt->bindValue(':questao_9',$this->__get('questao_9'));
		 $stmt->bindValue(':questao_10',$this->__get('questao_10'));
		 $stmt->bindValue(':questao_11',$this->__get('questao_11'));
		 $stmt->bindValue(':questao_12',$this->__get('questao_12'));
		 $stmt->bindValue(':questao_13',$this->__get('questao_13'));
		 $stmt->execute();
	 }#end function cadastrar()


	 public function verificar(){
		 $query = "SELECT COUNT(*) as num FROM provahwr WHERE id_aluno = :id_aluno";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		 $stmt->execute();
		 $ex = $stmt->fetch(\PDO::FETCH_ASSOC);

			return $ex['num'];

	 }#end function verificar()






 }#end class
