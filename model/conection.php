<?php
class Database{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;
  private $dbh;
  private $error;
  private $stmt;


  public function __construct()
  {
      // Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      // Set options
      $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
      try {
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        debug_to_console( "conection okay");
      }// Catch any errors
      catch (PDOException $e) {
        $this->error = $e->getMessage();
        debug_to_console( "refuse");
      }
  }

  public function query($query)
  {
      $this->stmt = $this->dbh->prepare($query);
  }


  public function bind($param, $value, $type=null)
  {
    //Next we use a switch statement to set the datatype of the parameter
    if (is_null($type)) {
        switch (true) {
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute()
  {
      return $this->stmt->execute();
  }

  public function errorCode()
  {
      return $this->stmt->errorCode();
  }

  public function resultset()
  {
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }

  public function lastInsertId()
  {
    //return as string
    return $this->dbh->lastInsertId();
  }
 /*transactions*/
  public function beginTransaction(){
      return $this->dbh->beginTransaction();
  }

  public function endTransaction(){
      return $this->dbh->commit();
  }

  public function cancelTransaction(){
      return $this->dbh->rollBack();
  }
  /*for debug params in stmt*/
  public function debugDumpParams(){
      return $this->stmt->debugDumpParams();
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
