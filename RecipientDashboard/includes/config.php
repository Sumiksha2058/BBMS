<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn === false){
    die("Copnnection failed: ".$conn->connect_error);
}

?>