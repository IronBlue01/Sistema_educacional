<?php
 namespace App\Models;

 use MF\Model\Model;

 class Atividades extends Model{

	 private $id_atividade;
	 private $id_professor;
	 private $id_modulo;
	 private $id_curso;
	 private $modulo;
	 private $titulo;
	 private $img_cap;
	 private $description;
	 private $arquivo;
	 private $img_view;
	 private $video;
	 private $data;
	 private $subcategoria;
	 private $id_turma;
   private $id_aluno;
   private $xp_atividade;

	 public function __get($atributo){
		 return $this->$atributo;
	 }#end __get

	 public function __set($atributo, $valor){
		 $this->$atributo = $valor;
	 }#end __set


	 public function insereAtividade($size){
		$nome_file_capa    =  $this->__get('id_professor').'_'.$this->__get('img_cap')['name'];
		$link = explode('=',$this->__get('video'));
		$iframe = explode('&',$link[1]);
		//ordena a data
		$data = explode('-',$this->__get('data'));
		$data = $data[2].'/'.$data[1].'/'.$data[0];

		if($this->__get('img_view')['error']==4){
				$nome_file_img_view   = NULL;
		}else{
				$nome_file_img_view 	=  $this->__get('id_professor').'_'.$this->__get('img_view')['name'];
		}



	if($this->__get('arquivo')['error']==4){
			$nome_file_arquivo  = NULL;
	}else{
 			$nome_file_arquivo  =  $this->__get('id_professor').'_'.$this->__get('arquivo')['name'];
	}


		$query = "INSERT INTO atividades
								(id_professor,id_modulo,id_curso,subcategoria,titulo,img_cap,description,img_view,status,video,xp_atividade)
							VALUES
							(:id_professor,:modulo,:id_curso,:subcategoria,:titulo,:img_cap,:description,:img_view,0,:video,:xp_atividade)";
		$stmt  = $this->db->prepare($query);
		$stmt->bindValue(':id_professor',$this->__get('id_professor'));
		$stmt->bindValue(':modulo',$this->__get('modulo'));
		$stmt->bindValue(':id_curso',$this->__get('id_curso'));
		$stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
		$stmt->bindValue(':titulo',$this->__get('titulo'));
		$stmt->bindValue(':img_cap',$nome_file_capa);
		$stmt->bindValue(':description',$this->__get('description'));
		//$stmt->bindValue(':arquivo',$nome_file_arquivo);
		$stmt->bindValue(':img_view',$nome_file_img_view);
		$stmt->bindValue(':video',$iframe[0]);
    $stmt->bindValue(':xp_atividade',$this->__get('xp_atividade'));
		$stmt->execute();

    $id_atividade = $this->db->lastInsertId();

    for ($i=1; $i<=$size ; $i++) {
      if($_FILES['arquivo'.$i]['name']!=""){
      $tmp_name = $_FILES['arquivo'.$i]['tmp_name'];
      $nome_file_arquivo  =  $id_atividade.'_'.$_FILES['arquivo'.$i]['name'];
        $query = "INSERT INTO arquivo_atividade (id_atividade, arquivo) VALUES(:id_atividade, :arquivo)";
        $stmt  = $this->db->prepare($query);
        $stmt->bindValue(':id_atividade',$id_atividade);
        $stmt->bindValue(':arquivo',$nome_file_arquivo);
        $stmt->execute();
        move_uploaded_file($tmp_name, 'assets/dashboard/atividades/arquivo/'.$nome_file_arquivo);
      }#endif
    }#endfor

		move_uploaded_file( $this->__get('img_cap')['tmp_name'], 'assets/dashboard/atividades/capa/'.$nome_file_capa);
		//move_uploaded_file( $this->__get('arquivo')['tmp_name'], 'assets/dashboard/atividades/arquivo/'.$nome_file_arquivo);
		move_uploaded_file( $this->__get('img_view')['tmp_name'], 'assets/dashboard/atividades/view/'.$nome_file_img_view);

	 }#end insereAtividade


	 public function getAtividades(){
		 $query = "SELECT * FROM atividades ORDER BY id_atividade";
		 $stmt  = $this->db->prepare($query);
		 $stmt->execute();
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function getAtividades()

	 public function getAtividadesById(){

			$query = "SELECT * FROM atividades WHERE id_atividade = :id_atividade";
			$stmt  = $this->db->prepare($query);
			$stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
			$stmt->execute();
			return $stmt->fetch(\PDO::FETCH_ASSOC);
	 }#end function getAtividadeById()

	 public function getAtividadesLiberadas(){
		 $query = "SELECT A.titulo,
		 									A.video,
											A.description,
											A.img_cap,
											A.arquivo,
											A.img_view,
											L.data_entrega,
											L.id_atividade,
											M.nome_modulo,
											M.id_modulo
		 					 				FROM liberaatividade as L
							 				INNER JOIN atividades as A ON(A.id_atividade = L.id_atividade)
											INNER JOIN modulos as M ON(M.id_modulo = A.id_modulo)
							 				WHERE L.id_turma = :id_turma and A.subcategoria = :subcategoria
                      ORDER BY id_atividade";
			$query2 = "SELECT * FROM liberaatividade as L";

		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
		 $stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
		 $stmt->execute();
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function getAtividadesLiberadas()

	 public function getAtividadesByCursoAndSub(){
		 $query = "SELECT
		 						A.video,
								A.titulo,
								A.id_atividade,
								M.nome_modulo,
								(SELECT count(*) FROM liberaatividade as L WHERE L.id_atividade = A.id_atividade and L.id_turma = :id_turma) as num
		 						FROM atividades as A
		 						INNER JOIN modulos as M ON(M.id_modulo = A.id_modulo)
		 					 WHERE A.id_curso = :id_curso and A.subcategoria = :subcategoria";
		 $stmt  = $this->db->prepare($query);
		 $stmt->bindValue(':id_curso',$this->__get('id_curso'));
		 $stmt->bindValue(':subcategoria',$this->__get('subcategoria'));
		 $stmt->bindValue(':id_turma',$this->__get('id_turma'));
		 $stmt->execute();
		 return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	 }#end function getAtividadesByCursoAndSub()


   public function getAtividadeByModulo(){
     //Executa a listagem somente das atividades liberadas para está turma
     $query  = "SELECT
                A.img_cap,
                A.id_atividade,
                A.titulo,
                A.description,
                (SELECT count(*) FROM liberaatividade as L WHERE L.id_atividade = A.id_atividade) as num
                FROM atividades as A
                INNER JOIN liberaatividade as LL
                WHERE A.id_modulo = :id_modulo and LL.id_turma = 79";
     $stmt   = $this->db->prepare($query);
     $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
     //$stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
     $stmt->execute();
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }#end function getAtividadeByModulo()

   public function getAtividadeByModuloTeste(){

     $query = "SELECT
                 A.img_cap,
                 A.id_atividade,
                 A.titulo,
                 A.description
                FROM atividades as A
                INNER JOIN liberaatividade as L
                WHERE L.id_turma = :id_turma and A.id_atividade = L.id_atividade and A.id_modulo = :id_modulo";
     $stmt   = $this->db->prepare($query);
     $stmt->bindValue(':id_turma',$this->__get('id_turma'));
     $stmt->bindValue(':id_modulo',$this->__get('id_modulo'));
     $stmt->execute();
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);

   }

   public function getArquivosAtividades(){
     $query = "SELECT * FROM arquivo_atividade WHERE id_atividade = :id_atividade";
     $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_atividade',$this->__get('id_atividade'));
     $stmt->execute();
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }#end function getArquivosAtividades()

   public function getAtividadesRealizadas(){
     $query = "SELECT id_atividade FROM entrega WHERE id_aluno = :id_aluno";
     $stmt  = $this->db->prepare($query);
     $stmt->bindValue(':id_aluno',$this->__get('id_aluno'));
     $stmt->execute();
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);

   }#end getAtividadesRealizadas()





}#end class
