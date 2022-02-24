<?php

namespace MF\Model;

use App\Connection;

class Container{

	public static function getModel($model){

		$class =  "\\App\\Models\\".ucfirst($model);
		//Retornar o modelo solicitado já instanciado e inclusive com a conexao estabelecida

		//Instância de conexao
		$conn = Connection::getDb();

		return new $class($conn);
	}

}#end class

?>
