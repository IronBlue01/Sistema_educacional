<?php
 namespace App\Models;

 use MF\Model\Model;

 class Liberaatividade extends Model{

	 private $id_atividade;
	 private $id_turma;

 	 public function __get($atributo){
 		 return $this->$atributo;
 	 }#end function __get()

 	 public function __set($atributo, $valor){
 		 $this->$atributo = $valor;
 	 }#end function __set()


   public function LiberarAtividade(){
     //Verifica se a atividade para a turma já existe
     $query = "SELECT count(*) as num FROM liberaatividade
               WHERE id_atividade = :id_atividade and id_turma = :id_turma";
     $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_turma',$this->__get('id_turma'));
     $stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
     $stmt->execute();
     $num = $stmt->fetch(\PDO::FETCH_ASSOC);

     if($num['num']==0){
       $query = "INSERT INTO liberaatividade VALUES(:id_atividade,:id_turma,'15/06/2022',0)";
       $stmt  = $this->db->prepare($query);
       $stmt->bindValue(':id_turma',$this->__get('id_turma'));
       $stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
       $stmt->execute();
     }else{
       $query = "DELETE FROM liberaatividade WHERE id_turma = :id_turma and id_atividade = :id_atividade";
       $stmt  = $this->db->prepare($query);
       $stmt->bindValue(':id_turma',$this->__get('id_turma'));
       $stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
       $stmt->execute();
     }
}#fim liberar atividade para turma











 }#end class
