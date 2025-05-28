<?php 
$dbHost = "localhost";
$dbNome = "dbtarefamarcelo";
$dbUser = "root";
$dbSenha = "";

try{
$conexao = new PDO("mysql:host=$dbHost; dbname=$dbNome; charset=utf8", $dbUser, $dbSenha);
} catch (PDOException $erro){
    echo 'Erro ao conectar com o banco de dados: ' . $erro->getMessage();
}

define('BASE_URL', 'http://172.17.34.253:1200/projetos/202300005/alunos/max/3%c2%ba%20ano/projetoSorteio/App_sesc/');

?>