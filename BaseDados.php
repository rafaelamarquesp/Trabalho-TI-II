<?php

$usuario = 'root';
$senha = '';
$database = 'utilizadores';
$host = 'localhost';

try {
    $pdo= new pdo("mysql:host=localhost;dbname=utilizadores", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $erro) {
    echo "Erro: " .  $erro->getMessage();
}

// $mysqli = new mysqli($host, $usuario, $senha, $database);

// if($mysqli->error) {
//     die("Falha ao conectar ao banco de dados: " . $mysqli->error);
// }

