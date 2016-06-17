<?php
//iniciando sessão
session_start();
// Include database class
include '../bigMWebService/model/conection.php';
//require user class
include ('../bigMWebService/model/User.php');

// Define configuration

define("DB_HOST", "localhost:8889");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "webapp");/*
define("DB_HOST", "localhost");
define("DB_USER", "u244890757_root");
define("DB_PASS", "LDh15vdx96");
define("DB_NAME", "u244890757_webap");*/


//recebendo os dados
if(empty($_GET['login'])){$errorMessage .= "<li>login vazio</li>";}
if(empty($_GET['senha'])){$errorMessage .= "<li>senha vazio</li>";}
$login = $_GET['login'];
$senha = $_GET['senha'];
debug_to_console($login);
debug_to_console($senha);
$_SESSION['userLogado'];

//se o usuario entrar com os dados corretamente
if(empty($errorMessage))
{
    //instanciando o banco
    $database = new Database();

    //retornando do banco
    $database->query('SELECT id, nome, senha FROM usuario WHERE nome = :nome AND senha = :senha');
    $database->bind(':nome', $login, PDO::PARAM_STR);
    $database->bind(':senha', $senha, PDO::PARAM_STR);
        debug_to_console("indo");
    $row = $database->single();

$_SESSION['test']= "test";
    if (empty($row)) {
      # code...
       debug_to_console("não achou nada");
      //destruindo sessao;
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
      }
      session_destroy();
      //echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=../bigMWebService/index.php">';
    }else{
      debug_to_console($row);
      $id = $row['idUsuario'];
      $nome = $row['nome'];
      $_SESSION['userLogado'] = new User($nome ,$id );
      if($_SESSION['userLogado']=="")
      debug_to_console("Sessao não iniciada direito - ARQUIVO:actionLogin");
      debug_to_console($_SESSION['userLogado']->getNome());
      debug_to_console("Sessao  iniciada direito - ARQUIVO:actionLogin");
      echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=../bigMWebService/admin.php">';
    }

    if($_SESSION['userLogado']==""){
      debug_to_console("Sessao não iniciada direito - ARQUIVO:actionLogin");
    }else{
      debug_to_console("Aqui Existe");
      debug_to_console(session_id());

    }

    exit;
}





function debug_to_console( $data )
{
    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}


?>
