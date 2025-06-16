<?php 
//inicia as variaveis de sessão
session_start();
$_SESSION['mensagem']=NULL;

//Estabelece a conexao com o banco de dados
include_once("../data/config.php");

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $userName = filter_input(INPUT_POST, 'nomeAtualizado', FILTER_SANITIZE_SPECIAL_CHARS); 
    $senha = filter_input(INPUT_POST, 'novaSenha', FILTER_SANITIZE_SPECIAL_CHARS); 
    $senhaNova = filter_input(INPUT_POST, 'confirmaSenha', FILTER_SANITIZE_SPECIAL_CHARS); 
    $userId = filter_input(INPUT_POST, "userId", FILTER_SANITIZE_EMAIL);


    $sql = "SELECT * FROM userinfos WHERE userName = :nomeAtualizado";
    $select = $conexao->prepare($sql);
    $select->bindParam(':nomeAtualizado', $userName);
    $select->execute();

    if ($select->rowCount() > 0) {
        $login = $select->fetch(PDO::FETCH_ASSOC);
    
    if ($senha !== $novaSenha){
        $_SESSION['mensagem'] = "Senhas devem ser iguais!";
        header("Location: ../pages/user.php");
        exit;
    } elseif ($senha == $senhaNova) {
        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        header("Location: ../pages/user.php");
        exit;
    }
}


    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);


    try{
        $sql = "UPDATE usuarios SET senhaUsuario=:novaSenha WHERE usuarioId = :IdUser";
        $update = $conexao->prepare($sql);
        $update->bindParam(":senha", $senhaCriptografada);
        $update->bindParam(":userId", $userId);

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
?>