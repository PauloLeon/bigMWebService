<?php
//iniciando sessão
session_start();
// Include database class
include '../bigMWebService/model/conection.php';

// Define configuration
define("DB_HOST", "localhost:8889");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "bigm");

//recebendo os dados
if(empty($_GET['login'])){$errorMessage .= "<li>login vazio</li>";}
if(empty($_GET['senha'])){$errorMessage .= "<li>senha vazio</li>";}
$login = $_GET['login'];
$senha = $_GET['senha'];
debug_to_console($login);
debug_to_console($senha);

//se o usuario entrar com os dados corretamente
if(empty($errorMessage))
{
    //instanciando o banco
    $database = new Database();

    //retornando do banco
    $database->query('SELECT id, nome, senha FROM usuario WHERE nome = :nome AND senha = :senha');
    $database->bind(':nome', $login, PDO::PARAM_STR);
    $database->bind(':senha', $senha, PDO::PARAM_STR);
    $row = $database->single();
    if (empty($row)) {
      # code...
      //destruindo sessao;
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
      }
      session_destroy();
      echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=../bigMWebService/index.php">';
    }else{
      debug_to_console($row);
      $_SESSION['userLogado'] =true;
      echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=../bigMWebService/admin.php">';
    }
}


function debug_to_console( $data )
{
    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
