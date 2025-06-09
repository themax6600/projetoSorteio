<?php 

session_start();
$_SESSION['mensagem']=NULL;


include_once("../data/config.php");

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $novaSenha = filter_input(INPUT_POST, 'novaSenha', FILTER_SANITIZE_SPECIAL_CHARS); 

$senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

try{
        $sql = "UPDATE userinfos SET userPassword=:novaSenha WHERE userId = :userId";
        $update = $conexao->prepare($sql);
        $update->bindParam(":novaSenha", $senhaCriptografada);
        $update->bindParam(":userId", $userId);
        
    if ($userPassword == $novaSenha){
        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        header("Location: ../pages/user.php");
        exit;
    } elseif (!password_verify($userPassword, $login['userPassword'])) {
        $_SESSION['mensagem'] = "Senha não deve ser igual a anterior!";
        header("Location: ../pages/user.php");
        exit;
    } elseif ($userPassword !== $novaSenha) {
        $_SESSION['mensagem'] = "Senhas devem ser iguais!";
        header("Location: ../pages/user.php");
        exit;
    }

    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao Atualizar" . $e;
        header('Location: ' . BASE_URL . 'assets/pages/cadastrar.php');
        exit;
    } finally {
        //desconecta o banco de dados
        unset($conexao);
    }
}