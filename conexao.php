<?php
//conexao.php

$host = 'localhost:3500';
$dbname = 'clinica';
$username = 'root';
$password = '909thais508@180522';

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error){
    echo "Erro na conexão: " . $error->getMessage();
    die();
}