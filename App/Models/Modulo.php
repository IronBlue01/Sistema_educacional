<?php
 namespace App\Models;

 use MF\Model\Model;

 class Modulo extends Model{

	 private  $id_modulo;
	 private  $nome_modulo;
	 private $img;
	 private $descricao;
	 private $curso;
	 private $qtd_aulas;
	 private $subcategoria;
   private $id_turma;

	 public function __get($atributo){
		 return $this->$atributo;
	 }#end function __get()

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end function __set()


	 public function insereModulo(){
		 $query = "INSERT INTO modulos (img,nome_modulo,curso,qtd_aulas,descricao,subcategoria)
		 					 VALUES(:img,:nome_modulo,:curso,:qtd_aulas,:descricao,:subcategoria)";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':img',$this->__get('img')['name']);
		 $stmt->bindValue(':nome_modulo',$this->__get('nome_modulo'));
		 $stmt->bindValue(':curso',$this->__get('curso'));
		 $stmt->bindValue(':qtd_aulas',$this->__get('qtd_aulas'));
		 $stmt->bindValue(':descricao',$this->__get('descricao'));
		 $stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
		 $stmt->execute();
		 move_uploaded_file($this->__get('img')['tmp_name'], 'assets/dashboard/modulos/'.$this->__get('img')['name']);
	 }

	 public function getModulo(){
		 	$query = "SELECT * FROM modulos WHERE curso = :curso";
			$stmt  = $this->db->prepare($query);
			$stmt->bindValue(':curso',$this->__get('curso'));
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function


	 public function getNameModul(){
		 $query = "SELECT nome_modulo,img FROM modulos WHERE id_modulo = :id_modulo";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
		 $stmt->execute();
		 $name = $stmt->fetch(\PDO::FETCH_ASSOC);
		 return $name;
	 }#end function getNameModul()

	 public function getModulosByCursoAndSub(){
		 if ($this->__get('subcategoria')!='N') {
		 	$query = "SELECT
                  *,
                  (SELECT COUNT(*) from liberamodulo as L WHERE L.id_modulo = M.id_modulo and id_turma = :id_turma) as num
                  FROM modulos as M
                WHERE curso = :curso and subcategoria = :sub";
		}else{
			$query = "SELECT
                  *,
                  (SELECT COUNT(*) from liberamodulo as L WHERE L.id_modulo = M.id_modulo and id_turma = :id_turma) as num
                  FROM modulos as M
                WHERE curso = :curso";
		}
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':curso',$this->__get('curso'));
     $stmt->bindValue(':id_turma',$this->__get('id_turma'));
		 if($this->__get('subcategoria')!='N'){
		 $stmt->bindValue(':sub',$this->__get('subcategoria'));
	   }
		 $stmt->execute();
		 $modulo =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
		 return $modulo;
	 }#end function getModulosByCursoAndSub()

   public function deletaModulo(){
    $query = "DELETE FROM modulos WHERE id_modulo = :id_modulo";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
    $nomeImg = $this->getNameModul();
    $stmt->execute();
    $nomeImg = $nomeImg['img'];
    unlink("assets/dashboard/modulos/$nomeImg");
   }#end deletaModulo()




 }#end class
