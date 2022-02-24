<?php
 namespace App\Models;

 use MF\Model\Model;

 class Blog extends Model{

	private $id_blog;
	private $id_aluno;
	private $link;


	public function __get($atributo){
		return $this->$atributo;
	}#end __get

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}#end __set

	public function cadLink(){
		$query = "INSERT INTO blog (id_aluno,link) VALUES(:id_aluno,:link)";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		$stmt->bindValue(':link',$this->__get('link'));
		$stmt->execute();
	}#end class()

	//Verifica se o aluno já realizou a tarefa
	public function verifica(){
		$query = "SELECT count(*) FROM blog WHERE id_aluno = :id_aluno";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		$stmt->execute();
		$x = $stmt->fetch(\PDO::FETCH_NUM);
		return $x[0];
	}#end verifica()

public function getBlog(){
	$query = "SELECT link FROM blog WHERE id_aluno = :id_aluno";
	$stmt  = $this->db->prepare($query);
	$stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
	$stmt->execute();
	return $stmt->fetch(\PDO::FETCH_ASSOC);

}#end function getBlog()



}#end class
