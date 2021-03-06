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
				// Define configuration  31.220.104.1
				define("DB_HOST", "localhost:8889");
				define("DB_USER", "root");
				define("DB_PASS", "root");
				define("DB_NAME", "webapp");
			/*	define("DB_HOST", "localhost");
				define("DB_USER", "u244890757_root");
				define("DB_PASS", "LDh15vdx96");
				define("DB_NAME", "u244890757_webap");*/
				$this->connDataBase = new Database();
				$this->userName = $nomeSession;
				$this->idUser = $idUserSession;
 	  }

		function getNome()
		{
			return $this->userName;
		}


		function getPedidosJSON()
		{
			/* SQL QUE SO RETORNA O DO DIA EM QUESTAO
			SELECT DISTINCT p.idPedidos, p.fk_idCliente, p.status, p.data, p.tempoDeEntrega, c.nome, c.bairro, c.rua, c.numero, c.complemento, c.fone
			FROM pedidos p INNER JOIN cliente c ON (p.fk_idCliente = c.idCliente) WHERE DATE(data) = CURDATE();
			*/
			$this->connDataBase->query("SELECT DISTINCT p.idPedidos, p.fk_idCliente, p.status, DATE_FORMAT(p.data,'%d %b %Y %T') as data , p.tempoDeEntrega, c.nome, c.bairro, c.rua, c.numero, c.complemento, c.fone
						FROM pedidos p INNER JOIN cliente c ON (p.fk_idCliente = c.id)");
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

		function getItemPedidoJSON($fk_idPedidos)
		{
			/* SQL QUE SO RETORNA O DO DIA EM QUESTAO
			SELECT DISTINCT p.idPedidos, p.fk_idCliente, p.status, p.data, p.tempoDeEntrega, c.nome, c.bairro, c.rua, c.numero, c.complemento, c.fone
			FROM pedidos p INNER JOIN cliente c ON (p.fk_idCliente = c.idCliente) WHERE DATE(data) = CURDATE();
			*/
			$this->connDataBase->query("SELECT i.idItem, i.nome, i.descricao, i.valor, i.idCategoria, i.ativo, IP.fk_idPedidos
																	FROM item i
																	INNER JOIN itemPedido IP ON (i.idItem = IP.fk_idItem)
																	WHERE fk_idPedidos = :fk_idPedidos ;");
			$this->connDataBase->bind(':fk_idPedidos', $fk_idPedidos);
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

		function getItensJSON()
		{

			$this->connDataBase->query('SELECT DISTINCT i.idItem, i.nome, i.descricao, i.valor, i.idCategoria, i.ativo, c.nome as categoria	FROM item i INNER JOIN categoria c ON (i.idCategoria = c.idCategoria);');
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

		function getCategoriaJSON()
		{

			$this->connDataBase->query('SELECT * from categoria;');
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

		function addProduto( $nome, $descricao, $valor, $idCategoria)
		{

			$this->connDataBase->query('INSERT INTO item (nome, descricao, valor, ativo, idCategoria)
																	VALUES (:nome, :descricao, :valor, :ativo, :idCategoria);');
			$this->connDataBase->bind(':nome', $nome);
			$this->connDataBase->bind(':descricao', $descricao);
			$this->connDataBase->bind(':valor', $valor);
			$this->connDataBase->bind(':idCategoria', $idCategoria);
			$this->connDataBase->bind(':ativo', 1);
			$this->connDataBase->execute();

		}

		function excluirProduto($idItem)
		{

			$this->connDataBase->query("DELETE FROM item WHERE idItem = :idITem;");
			$this->connDataBase->bind(':idITem', $idItem);
			$this->connDataBase->execute();

		}


		function editarProduto($idItem, $nome, $descricao, $valor)
		{
			$this->connDataBase->query('UPDATE item
																	SET  nome=:nome, descricao=:descricao, valor=:valor
																	WHERE idItem=:idItem;');
			$this->connDataBase->bind(':idItem', $idItem);
			$this->connDataBase->bind(':nome', $nome);
			$this->connDataBase->bind(':descricao', $descricao);
			$this->connDataBase->bind(':valor', $valor);
			$this->connDataBase->execute();
		}

		function addCategoria( $descricaoCategoria)
		{

			$this->connDataBase->query('INSERT INTO Categoria ( nome, ativo)
																	VALUES (:descricaoCategoria, :ativo);');
			$this->connDataBase->bind(':descricaoCategoria', $descricaoCategoria);
			$this->connDataBase->bind(':ativo', 1);
			$this->connDataBase->execute();

		}

		function excluirCategoria($idCategoria)
		{

			$this->connDataBase->query("DELETE FROM categoria WHERE idCategoria = :idCategoria;");
			$this->connDataBase->bind(':idCategoria', $idCategoria);
			$this->connDataBase->execute();

		}

		function editarCategoria($idCategoria, $descricaoCategoria)
		{
			$this->connDataBase->query('UPDATE categoria
																	SET  nome=:descricaoCategoria
																	WHERE idCategoria=:idCategoria;');
			$this->connDataBase->bind(':idCategoria', $idCategoria);
			$this->connDataBase->bind(':descricaoCategoria', $descricaoCategoria);
			$this->connDataBase->execute();
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

		function confimarPedido($id)
		{
			$this->connDataBase->query('UPDATE Pedidos SET status="Aprovado" WHERE idPedidos = :idPedidos;');
			$this->connDataBase->bind(':idPedidos', $id);
			$this->connDataBase->execute();
		}

		function rejeitarPedido($id)
		{
			$this->connDataBase->query('UPDATE Pedidos SET status="Rejeitado" WHERE idPedidos = :idPedidos;');
			$this->connDataBase->bind(':idPedidos', $id);
			$this->connDataBase->execute();
		}

		function debug_to_console( $data )
		{
				 if ( is_array( $data ) )
						 $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
				 else
						$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
				 echo $output;
		}

	}


?>
