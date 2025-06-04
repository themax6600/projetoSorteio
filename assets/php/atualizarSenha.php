<?php 

session_start();
$_SESSION['mensagem']=NULL;


include_once("../data/config.php");

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $senha = filter_input(INPUT_POST, 'senhaUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
    $novaSenha = filter_input(INPUT_POST, 'novaSenha', FILTER_SANITIZE_SPECIAL_CHARS); 
    
    if ($senha == $novaSenha){
        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        header("Location: ../pages/user.php");
        exit;
    } elseif (!password_verify($senha, $login['senhaUsuario'])) {
        $_SESSION['mensagem'] = "Senha não deve ser igual a anterior!";
        header("Location: ../pages/user.php");
        exit;
    } elseif ($senha !== $novaSenha) {
        $_SESSION['mensagem'] = "Senhas devem ser iguais!";
        header("Location: ../pages/user.php");
        exit;
    }


$senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

try{
        $sql = "UPDATE usuarios SET senhaUsuario=:novaSenha WHERE userId = :IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":novaSenha", $senhaCriptografada);
        $update->bindParam(":IdUser", $IdUser);

        if ($update->execute()){
            $_SESSION['mensagem'] = "Senha atualizada com sucesso";

            $notiHeader = "Senha atualizado.";
            $notiBody = "Sucesso! A sua senha foi atualizada no sistema.";

            $sqlNoti = "INSERT INTO notificacoes (notiHeader, notiBody) VALUES (:notiHeader, :notiBody)";
            $insertNoti = $conexao->prepare($sqlNoti);
            $insertNoti->bindParam(":notiHeader", $notiHeader);
            $insertNoti->bindParam(":notiBody", $notiBody);

            if ($insertNoti->execute()) {
                header("Location: ../pages/user.php");
            }
            exit;
        } else {
            throw new Exception("Erro ao atualizar");
        }

    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao Atualizar" . $e;
        header("Location: ../pages/user.php");
        exit;
    } finally {
        //desconecta o banco de dados
        unset($conexao);
    }
}