<?php
 namespace App\Models;

 use MF\Model\Model;

 class Script extends Model{


	 private $nomeArquivo;
	 private $id_modulo;
   private $url;




	 public function __get($atributo){
		 return $this->$atributo;
	 }#end function __get()

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end function __set()


	 public function selecionar(){
		 	$query =  "SELECT id_entrega, id_modulo, nomeArquivo FROM entrega";
			$stmt  = $this->db->prepare($query);
			$stmt->execute();
		  $nomes =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
			$this->renomeia($nomes);
			return $nomes;
	 }#end function selecionar


	 public function renomeia($nomes){

		 foreach ($nomes as $name) {

			 $extensao = explode('.',$name['nomeArquivo']);
			 $ext = end($extensao);
			 $id_mod =  $name['id_entrega'];


			 if($ext=='pptx'){
				 	 $query = "UPDATE entrega SET id_modulo = 2 WHERE id_entrega = $id_mod";
					 $stmt  = $this->db->prepare($query);
					 $stmt->execute();
			 }



		 }#end foreach


	 }

	 public function upTurma(){
		 $query = "UPDATE entrega SET id_turma = 67 WHERE id_turma = 30";
			$stmt  = $this->db->prepare($query);
			$stmt->execute();
	 }

   public function insereUrl(){
    $query = "INSERT INTO url VALUES(default, :url)";
    $stmt  = $this->db->prepare($query);
    $stmt->bindValue(':url',$this->__get('url'));
    $stmt->execute();
   }










}



?>
