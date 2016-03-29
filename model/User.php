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

			$this->connDataBase->query('SELECT * FROM Pedidos');
			$rows = $this->connDataBase->resultset();
			$json = json_encode($rows);
			return $rows;
		}

	}

?>
