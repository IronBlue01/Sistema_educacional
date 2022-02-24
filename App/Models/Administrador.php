<?php
 namespace App\Models;

 use MF\Model\Model;

 class Administrador extends Model{

	private $id_adm;
	private $nome;
	private $username;
	private $senha;
	private $email;
	private $access;

	public function __get($atributo){
		return $this->$atributo;
	}#end __get

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}#end __set

	public function validacao(){

		$query =
		"SELECT id_adm, nome, username, senha
		 FROM administradores
		 WHERE username = :username and senha = :senha";
		 $stmt = $this->db->prepare($query);
		 $stmt->bindValue(':username',$this->__get('username'));
		 $stmt->bindValue(':senha',$this->__get('senha'));
		 $stmt->execute();

		 $usuario =  $stmt->fetch(\PDO::FETCH_ASSOC);

		 if($usuario['id_adm'] != '' && $usuario['nome'] != ''){
				 $this->__set('id_adm',$usuario['id_adm']);
				 $this->__set('nome',$usuario['nome']);
				 $this->__set('access',true);
		 }

		 return $this;

	}#end validacao






 }#end class

?>
