<?php
// Include database class
require_once 'model/conection.php';


	class User
	{
		private $userEmail;
		private $connDataBase;
		private $userName;
		private $idUser;
		private $link;



		function __construct($nomeSession,$idUserSession)
    {
				// Define configuration
				define("DB_HOST", "localhost:8889");
				define("DB_USER", "root");
				define("DB_PASS", "root");
				define("DB_NAME", "webapp");
				$this->connDataBase = new Database();
				$this->userName = $nomeSession;
				$this->idUser = $idUserSession;
 	  }

		function getNome()
		{
			return $this->userName;
		}

		function debug_to_console( $data )
		{
   			 if ( is_array( $data ) )
       			 $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
   			 else
        		$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
   			 echo $output;
		}


		function getPedidosJSON()
		{
			/* SQL QUE SO RETORNA O DO DIA EM QUESTAO
			SELECT DISTINCT p.idPedidos, p.fk_idCliente, p.status, p.data, p.tempoDeEntrega, c.nome, c.bairro, c.rua, c.numero, c.complemento, c.fone
			FROM pedidos p INNER JOIN cliente c ON (p.fk_idCliente = c.idCliente) WHERE DATE(data) = CURDATE();
			*/
			$this->connDataBase->query("SELECT DISTINCT p.idPedidos, p.fk_idCliente, p.status, p.data, p.tempoDeEntrega, c.nome, c.bairro, c.rua, c.numero, c.complemento, c.fone
						FROM pedidos p INNER JOIN cliente c ON (p.fk_idCliente = c.idCliente)");
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

		function getItensJSON()
		{

			$this->connDataBase->query('SELECT * FROM item');
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

		function setInativoJSON($id)
		{
			$this->connDataBase->query('UPDATE item SET ativo=0 WHERE idItem = :idItem;');
			$this->connDataBase->bind(':idItem', $id);
			$this->connDataBase->execute();
		}

		function setAtivoJSON($id)
		{
			$this->connDataBase->query('UPDATE item SET ativo=1 WHERE idItem = :idItem;');
			$this->connDataBase->bind(':idItem', $id);
			$this->connDataBase->execute();
		}

	}

?>
