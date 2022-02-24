<?php
 namespace App\Models;

 use MF\Model\Model;

 class Entrega extends Model{

	 private $id_entrega;
	 private $id_aluno;
	 private $id_turma;
	 private $id_professor;
	 private $data;
	 private $nomeAtividade;
	 private $arquivo;
	 private $nota;
	 private $obs;
	 private $id_modulo;
   private $id_atividade;

	 public function __get($atributo){
		 return $this->$atributo;
	 }#end function __get()

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end function __set()


	 public function insereEntrega(){
		 $nome_file =  $this->__get('id_aluno').'_'.$this->__get('arquivo')['name'];


		 $query = "INSERT INTO entrega (id_atividade,id_turma,id_aluno,data,nomeAtividade,nomeArquivo,id_modulo) VALUES (:id_atividade,:id_turma,:id_aluno,:data,:nomeAtividade,:arquivo,:id_modulo)";
		 $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
		 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
		 $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		 $stmt->bindValue(':data',$this->__get('data'));
		 $stmt->bindValue(':nomeAtividade',$this->__get('nomeAtividade'));
		 $stmt->bindValue(':arquivo',$nome_file);
		 $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
		 $stmt->execute();
		 move_uploaded_file( $this->__get('arquivo')['tmp_name'], 'assets/dashboard/arquivo_alunos/'.$nome_file);
	 }#end function insereEntrega()

	 public function getTrabByIdAlun(){
		 $query = "SELECT * from entrega WHERE id_aluno = :id_aluno";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
		 $stmt->execute();
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function getTrabByIdAlun

	 public function getTrabByIdAlunAndModul(){

		 $query = "SELECT * FROM entrega WHERE id_aluno = :id_aluno and id_modulo = :id_modulo";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_aluno',$this->__get('id_aluno')) ;
		 $stmt->bindValue(':id_modulo',$this->__get('id_modulo')) ;
		 $stmt->execute();
		 $trabalhos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		 return $trabalhos;
	 }#end function getTrabByIdAlunAndModul()


	 public function getTrabByIdAndProf(){
		 $query =
		 "SELECT
		 					 E.id_entrega,
							 E.id_turma,
							 E.id_aluno,
							 E.data,
							 E.nomeAtividade,
							 E.nomeArquivo,
							 E.obs,
							 E.nota,
							 A.nome,
							 A.avatar
							 FROM entrega as E
							 inner join alunos as A on (E.id_aluno = A.id_aluno)
		 					 WHERE E.id_turma = :id_turma
							 ORDER BY E.data";

		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
		 $stmt->execute();
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function getTrabByIdAndProf

 	 public function getEntregaByIdTurmaAndModulo(){
 	 $query = "SELECT
             E.id_entrega,
             E.nomeAtividade,
             E.id_aluno,
             E.nomeArquivo,
             E.nota,
             E.data,
             E.obs,
             A.nome
             FROM entrega as E
             INNER JOIN alunos as A on(E.id_aluno = A.id_aluno)
             WHERE E.id_turma = :id_turma and E.id_modulo = :id_modulo and E.id_atividade = :id_atividade";

	 $stmt  = $this->db->prepare($query);
	 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
	 $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
   $stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
	 $stmt->execute();
	 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
 	 }#end function getEntregaByIdTurmaAndModulo()

	 public function updateEntrega(){
		 $query = "UPDATE entrega SET nota = :nota, obs = :obs WHERE id_entrega = :id_entrega";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_entrega', $this->__get('id_entrega'));
		 $stmt->bindValue(':nota', $this->__get('nota'));
		 $stmt->bindValue(':obs', $this->__get('obs'));
		 $stmt->execute();
	 }#end function updateEntrega()

   public function getEntregaById(){
     $query = "SELECT * FROM entrega WHERE id_entrega = :id_entrega";
     $stmt = $this->db->prepare($query);
     $stmt->bindValue(":id_entrega",$this->__get('id_entrega'));
     $stmt->execute();
     return $stmt->fetch(\PDO::FETCH_ASSOC);
   }#end getEntregaById()




	 public function removerTrabEntr(){
 		$query = "DELETE FROM entrega WHERE id_entrega = :id_entrega";
 		$stmt  = $this->db->prepare($query);
 		$stmt->bindValue(':id_entrega',$this->__get('id_entrega'));
    $nomeArquivo = $this->getEntregaById();
    $nomeArquivo = $nomeArquivo['nomeArquivo'];
    unlink("assets/dashboard/arquivo_alunos/$nomeArquivo");
 		$stmt->execute();

 	}#end removerTrabEntr()







}#end class
