<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? null;
include_once('../data/config.php');
include_once('../templates/header.php');

$numPessoa = filter_input(INPUT_POST, "numPessoa", FILTER_SANITIZE_NUMBER_INT);
if (empty($numPessoa) || $numPessoa <= 0) {
    $_SESSION['mensagem'] = "Adicione um número válido para sortear.";
    $_SESSION['tipoMensagem'] = "danger";
    header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php");
    exit;
}

$sql = "SELECT * FROM userinfos WHERE adm = 0 AND passou = 0";
$select = $conexao->prepare($sql);

if ($select->execute()) {
    $userinfos = $select->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($userinfos)) {
        if (count($userinfos) < $numPessoa) {
            $_SESSION['mensagem'] = "Não há usuários suficientes para o sorteio.";
            $_SESSION['tipoMensagem'] = "danger";
            header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php");
            exit;
        }

        $indicesSorteados = array_rand($userinfos, $numPessoa);
        if (!is_array($indicesSorteados)) {
            $indicesSorteados = [$indicesSorteados];
        }

        $rows = [];
        $userIds = [];

        foreach ($indicesSorteados as $indice) {
            $user = $userinfos[$indice];
            $rows[] = [
                'userName' => $user['userName'],
                'userCpf' => $user['userCpf'],
                'imgUser' => $user['imgUser'],
                'userId' => $user['userId'],
                'userEmail' => $user['userEmail'],
                'userSobrenome' => $user['userSobrenome']
            ];
            $userIds[] = $user['userId'];
        }

        $sql = "INSERT INTO usersorteados (userName, userCpf, imgUser, userId, userEmail, userSobrenome) VALUES ";
        $placeholders = [];
        $params = [];

        foreach ($rows as $row) {
            $placeholders[] = "(?, ?, ?, ?, ?, ?)";
            foreach ($row as $value) {
                $params[] = $value;
            }
        }

        $sql .= implode(", ", $placeholders);
        $insert = $conexao->prepare($sql);

        if ($insert->execute($params)) {
            
            $update = $conexao->prepare("UPDATE userinfos SET passou = 1 WHERE userId = ?");
            foreach ($userIds as $userId) {
                $update->execute([$userId]);
            }

            $sorteou = true;
            $_SESSION['mensagem'] = "Alunos sorteados com sucesso.";
            $_SESSION['tipoMensagem'] = "success";
            $ids = implode(',', $userIds);
            header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php?ids=$ids");
            exit;
        } else {
            throw new Exception("Ocorreu um erro ao inserir os dados.");
        }
    } else {
        $_SESSION['mensagem'] = "Nenhum usuário não administrador encontrado.";
        $_SESSION['tipoMensagem'] = "danger";
        header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Erro ao executar a consulta.";
    $_SESSION['tipoMensagem'] = "dangerbd";
    header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php");
    exit;
}
?>
