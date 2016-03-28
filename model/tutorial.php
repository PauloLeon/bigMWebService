<?php
// Include database class
include '../php/conection.php';

// Define configuration
define("DB_HOST", "localhost:8889");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "schematestpdo");

/*
CREATE TABLE mytable (
    ID int(11) NOT NULL AUTO_INCREMENT,
    FName varchar(50) NOT NULL,
    LName varchar(50) NOT NULL,
    Age int(11) NOT NULL,
    Gender enum('male','female') NOT NULL,
    PRIMARY KEY (ID)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
*/

$john = 'john';
$database = new Database();

$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');

$database->bind(':fname', $john);
$database->bind(':lname', 'Smith');
$database->bind(':age', '24');
$database->bind(':gender', 'male');
echo $database->debugDumpParams();
$database->execute();

echo $database->lastInsertId();

//insert multiple records with transactions

$database->beginTransaction();

$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');

$database->bind(':fname', 'Jenny');
$database->bind(':lname', 'Smith');
$database->bind(':age', '23');
$database->bind(':gender', 'female');

$database->execute();

$database->bind(':fname', 'Jilly');
$database->bind(':lname', 'Smith');
$database->bind(':age', '25');
$database->bind(':gender', 'female');

$database->execute();

echo $database->lastInsertId();

$database->endTransaction();


//select single row

$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname');
$database->bind(':fname', 'Jenny');
$row = $database->single();
echo "<pre>";
print_r($row);
echo "</pre>";

//select multiple rows

$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');
$database->bind(':lname', 'Smith');
$rows = $database->resultset();
echo "<pre>";
print_r($rows);
echo "</pre>";
echo $database->rowCount();

?>
