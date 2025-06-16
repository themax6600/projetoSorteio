<?php
session_start();
$mensagem = $_SESSION['mensagem'] ?? null;
include_once('../data/config.php');

$i = 0;
$sql = "SELECT * FROM userinfos WHERE adm = 0 AND passou = 0";
$select = $conexao->prepare($sql);

if ($select->execute()) {
    $userinfos = $select->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($userinfos)) {
        $numeroSorteados = 5;

        if (count($userinfos) < $numeroSorteados) {
            $_SESSION['mensagem'] = "Não há usuários suficientes para o sorteio.";
            header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php");
            exit;
        } else {
            $indicesSorteados = array_rand($userinfos, $numeroSorteados);

            if (!is_array($indicesSorteados)) {
                $indicesSorteados = [$indicesSorteados];
            }

            $rows = [];
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
            }

            $sql = "INSERT INTO usersorteados (userName, userCpf, imgUser, userId, userEmail, userSobrenome) VALUES ";
            $placeholders = [];
            $params = [];

            foreach ($rows as $row) {
                $placeholders[] = "(?, ?, ?, ?, ?, ?)";
                foreach ($row as $key => $value) {
                    $params[] = $value;
                }
            }

            $sql .= implode(", ", $placeholders);
            $insert = $conexao->prepare($sql);

            print_r($indicesSorteados) ;

            
            foreach ($indicesSorteados as $id){
                $sql = "UPDATE userinfos SET passou = 1 WHERE userId = $id";
                $update = $conexao-> prepare($sql);
                $update-> execute();
                echo " $id";
            }
                        exit;

            if ($insert->execute($params)) {
                $_SESSION['mensagem'] = "Alunos sorteados.";
                $ids = implode(',', array_map(fn($indice) => $userinfos[$indice]['userId'], $indicesSorteados));
                header("Location:" . BASE_URL . "assets/pages/sortearAlunoAdm.php?ids=$ids");
                exit();
            } else {
                throw new Exception("Ocorreu um erro ao inserir os dados.");
            }
        }
    } else {
        echo "Nenhum usuário não administrador encontrado.";
    }
} else {
    echo "Erro ao executar a consulta.";
}
?>
