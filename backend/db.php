<?php

$host = 'localhost';
$port = '5432';
$db   = 'portfolio';        
$user = 'postgres';     
$pass = 'amira';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;options='--client_encoding=UTF8'";
$pdo = new PDO($dsn, $user, $pass, [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

return $pdo;   
?>