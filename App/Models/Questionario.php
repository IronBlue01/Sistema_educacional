<?php
 namespace App\Models;

 use MF\Model\Model;

 class Questionario extends Model{

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
   private $q11;
   private $q12;
   private $q13;

   public function __get($atributo){
     return $this->$atributo;
   }#end __get

   public function __set($atributo, $valor){
     $this->$atributo = $valor;
   }#end __set



   public function cadQuestion(){
     $query = "INSERT INTO  questionário (id_aluno,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13) VALUES(:id_aluno,:q1,:q2,:q3,:q4,:q5,:q6,:q7,:q8,:q9,:q10,:q11,:q12,:q13)";
     $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
     $stmt->bindValue(':q1',$this->__get('q1'));
     $stmt->bindValue(':q2',$this->__get('q2'));
     $stmt->bindValue(':q3',$this->__get('q3'));
     $stmt->bindValue(':q4',$this->__get('q4'));
     $stmt->bindValue(':q5',$this->__get('q5'));
     $stmt->bindValue(':q6',$this->__get('q6'));
     $stmt->bindValue(':q7',$this->__get('q7'));
     $stmt->bindValue(':q8',$this->__get('q8'));
     $stmt->bindValue(':q9',$this->__get('q9'));
     $stmt->bindValue(':q10',$this->__get('q10'));
     $stmt->bindValue(':q11',$this->__get('q11'));
     $stmt->bindValue(':q12',$this->__get('q12'));
     $stmt->bindValue(':q13',$this->__get('q13'));
     $stmt->execute();

   }


   public function getQuest(){
     $query = "SELECT COUNT(*) as num FROM questionário WHERE id_aluno = :id_aluno";
     $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
     $stmt->execute();
     return $stmt->fetch(\PDO::FETCH_ASSOC);
   }



 }
