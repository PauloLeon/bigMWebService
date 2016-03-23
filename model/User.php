<?php
// Include database class
require_once '../bigMWebService/model/conection.php';

	class User
	{
		private $userEmail;
		private $connDataBase;
		private $userName;
		private $idUser;
		private $link;
		// Define configuration
		define("DB_HOST", "localhost:8889");
		define("DB_USER", "root");
		define("DB_PASS", "root");
		define("DB_NAME", "bigm");


		function __construct($nomeSession,$idUserSession)
    {
				debug_to_console("pra ca veio");
				$this->connDataBase = new Database();
				$this->userName = $nomeSession;
				$this->idUser = $idUserSession;
				debug_to_console("saindo");
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
