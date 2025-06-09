<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;

include_once('../data/config.php');

$sql = "SELECT * FROM userinfos WHERE adm = 0";
$select = $conexao->prepare($sql);

if ($select->execute()) {
    $userinfos = $select->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($userinfos)) {
        $numeroSorteados = 5;

        if (count($userinfos) < $numeroSorteados) {
            $_SESSION['mensagem'] = "Não há usuários suficientes para o sorteio.";
        } else {
            $indicesSorteados = array_rand($userinfos, $numeroSorteados);

            if (!is_array($indicesSorteados)) {
                $indicesSorteados = [$indicesSorteados];
            }

            $ids = implode(',', array_map(function ($indice) use ($userinfos) {
                return $userinfos[$indice]['userId'];
            }, $indicesSorteados));

            $sql = "INSERT INTO usersorteados (userName, userSobrenome, userCpf, imgUser, userId) VALUES (:userName, :userSobrenome, :userCpf, :imgUser, :userId)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(':userName', $userName);
            $insert->bindParam(':userSobrenome', $userSobrenome);
            $insert->bindParam(':userCpf', $userCpf);
            $insert->bindParam(':imgUser', $imgUser);
            $insert->bindParam(':userId', $userId);

            if ($insert->execute() && $insert->rowCount() > 0) {
                $_SESSION['mensagem'] = "Alunos sorteados.";
                header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php?ids=$ids");
                exit();
            } else {
                throw new Exception("Ocorreu um probleminha");
                header('Location: ' . BASE_URL . 'assets/pages/sortearAlunoAdm');
            }
        }
    } else {
        echo "Nenhum usuário não administrador encontrado.";
    }
} else {
    echo "Erro ao executar a consulta.";
}
