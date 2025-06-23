
<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['logado'] = FALSE;

include_once('../data/config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['userCpf']) && !empty($_POST['userPassword'])) {
        try {
            $userCpf = filter_input(INPUT_POST, "userCpf", FILTER_SANITIZE_SPECIAL_CHARS);
            $userPassword = filter_input(INPUT_POST, "userPassword", FILTER_SANITIZE_SPECIAL_CHARS);

            $userCpf = preg_replace('/\D/', '', $userCpf);

            $sql = "SELECT * FROM userinfos WHERE userCpf = :userCpf";
            $select = $conexao->prepare($sql);
            $select->bindParam(':userCpf', $userCpf);
            $select->execute();

            if ($select->rowCount() > 0) {
                $login = $select->fetch(PDO::FETCH_ASSOC);

                if ($login['userCpf'] === $userCpf && password_verify($userPassword, $login['userPassword'])) {
                    $_SESSION['logado'] = TRUE;
                    $_SESSION['userId'] = $login['userId'];
                    $_SESSION['userEmail'] = $login['userEmail'];
                    $_SESSION['userName'] = $login['userName'];
                    $_SESSION['userSobrenome'] = $login['userSobrenome'];
                    $_SESSION['userCpf'] = $login['userCpf'];
                    $_SESSION['adm'] = $login['adm'];
                    $_SESSION['passou'] = $login['passou'];
                    header("Location: ../pages/main.php");
                    exit;
                }
            }

            $_SESSION['mensagem'] = "Usuário ou Senha Inválido!";
            $_SESSION['tipoMensagem'] = "danger";
            header("Location: ../pages/entrar.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = "Erro ao acessar o banco de dados: ";
            $_SESSION['tipoMensagem'] = "danger";
            header("Location: ../pages/entrar.php");
            exit;
        } finally {
            unset($conexao);
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos!";
        $_SESSION['tipoMensagem'] = "danger";
        header("Location: ../pages/entrar.php");
        exit;
    }
}