<?php
 namespace App\Models;

 use MF\Model\Model;

 class Liberamodulo extends Model{

   	 private $libera;
     private $modulo;
     private $id_turma;
     private $id_modulo;
     private $subcategoria;

   public function __get($atributo){
     return $this->$atributo;
   }#end function __get()

   public function __set($atributo, $valor){
     $this->$atributo = $valor;
   }#end function __set()

   public function cadastro(){
     //verifica se existe a insidencia de um registro no banco
     $query = "SELECT COUNT(*) as num FROM liberamodulo WHERE id_modulo = :id_modulo and id_turma = :id_turma";
     $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
     $stmt->bindValue(':id_turma',$this->__get('id_turma'));
     $stmt->execute();
     $num = $stmt->fetch(\PDO::FETCH_ASSOC);

     if($num['num']==1){
       $query = "DELETE FROM liberamodulo WHERE id_modulo = :id_modulo and id_turma = :id_turma";
       $stmt  = $this->db->prepare($query);
       $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
       $stmt->bindValue(':id_turma',$this->__get('id_turma'));
       $stmt->execute();
     }else{
       $query = "INSERT INTO liberamodulo VALUES(NULL,:id_turma,:id_modulo)";
       $stmt  = $this->db->prepare($query);
       $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
       $stmt->bindValue(':id_turma',$this->__get('id_turma'));
       $stmt->execute();
     }

}#end function cadastro()



 }#end class
