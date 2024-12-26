<?php


$host = 'localhost';
$user = "freza";
$pass = "";
$dbname = "gestion";

try
{
        $dsn = "mysql:host=".$host . ";dbname=" . $dbname;
        $pdo = new PDO($dsn , $user, $pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      
}

catch(PDOException $e)
{
        echo "Pas de connexion a la base de donnees" . $e->getMessage();
}