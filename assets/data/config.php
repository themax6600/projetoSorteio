<?php 
$dbHost = "localhost";
$dbNome = "sesc_site";
$dbUser = "root";
$dbSenha = "";

try{
$conexao = new PDO("mysql:host=$dbHost; dbname=$dbNome; charset=utf8", $dbUser, $dbSenha);
} catch (PDOException $erro){
    echo 'Erro ao conectar com o banco de dados: ' . $erro->getMessage();
}

define('BASE_URL', 'http://192.168.1.108/PROJETOS2025/projetoSorteio/');

?>