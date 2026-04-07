<?php

function setPaciente($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $telefone, $genero, $nivel, $bdate)
{

    if (!empty($email)) {

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['erro'][] = "Este e-mail já está cadastrado.";

            header("Location: login.php");
            exit();
        } else {

            if (empty($nome) || empty($email) || empty($senha) || empty($bdate) || empty($cpf) || empty($telefone) || empty($genero) || empty($confirmar_senha)) {

                $_SESSION['erro'][] = "Preencha todos os campos.";
            } else {

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                try {

                    $pdo->beginTransaction();

                    // 1️⃣ Insere usuário
                    $sql = "INSERT INTO usuarios (nome, genero, email, cpf, senha, nivel, telefone) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $pdo->prepare($sql);

                    $stmt->execute([
                        $nome,
                        $genero,
                        $email,
                        $cpf,
                        $senhaHash,
                        $nivel,
                        $telefone
                    ]);

                    //  pega o ID do usuário criado
                    $usuario_id = $pdo->lastInsertId();

                    // insere na tabela paciente
                    $sql = "INSERT INTO paciente (fk_usuario_id, data_nascimento) VALUES (?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$usuario_id, $bdate]);

                    $pdo->commit();

                    header('Location: ../views/login.php');
                    exit();
                } catch (Exception $e) {

                    $pdo->rollBack();
                    $_SESSION['erro'][] = "Erro ao cadastrar: " . $e->getMessage();
                }
            }
        }
    }
}






function setMedico($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $crm, $telefone, $especialidade, $genero, $nivel)
{
    if (!empty($email)) {

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['erro'][] = "Este e-mail já está cadastrado.";

            header("Location: ../views/login.php");
            exit();
        } else {

            if (empty($nome) || empty($email) || empty($senha) || empty($cpf) || empty($crm) || empty($telefone) || empty($especialidade) || empty($genero) || $confirmar_senha !== $senha) {

                $_SESSION['erro'][] = "Campo vazio ou senha incoerente";
            } else {

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                try {

                    $pdo->beginTransaction();

                    // Insere usuário
                    $sql = "INSERT INTO usuarios (nome, genero, email, cpf, senha, nivel, telefone) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $pdo->prepare($sql);

                    $stmt->execute([
                        $nome,
                        $genero,
                        $email,
                        $cpf,
                        $senhaHash,
                        $nivel,
                        $telefone
                    ]);

                    //  pega o ID do usuário criado
                    $usuario_id = $pdo->lastInsertId();

                    // insere na tabela medico
                    $sql = "INSERT INTO medico (fk_usuario_id, crm, especialidade) VALUES (?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$usuario_id, $crm, $especialidade]);

                    $pdo->commit();

                    header('Location: ../views/login.php');
                    exit();
                } catch (Exception $e) {

                    $pdo->rollBack();
                    $_SESSION['erro'][] = "Erro ao cadastrar: " . $e->getMessage();
                }
            }
        }
    }
}



function validar($pdo, $senha, $cpf)
{

    $sql = "SELECT senha, nivel, id FROM usuarios WHERE cpf = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {

        $_SESSION['nivel'] = $usuario['nivel'];
        $_SESSION['id_usuario'] = $usuario['id'];

        if ($usuario['nivel'] == 'medico') {

            header("Location: ../views/pgMedico.php");
            //echo 'deu certo!';
            exit();
        } elseif ($usuario['nivel'] == 'paciente') {

            header("Location: ../views/pgPaciente.php");
            exit();
        }
    } else {

        $_SESSION['erro'][] = "Usuário ou senha incorretos!";
    }
}

function getMedicamentoPaciente($pdo, $idPaciente)
{
    $sql = "SELECT nome, dosagem, frequencia FROM medicamento_em_uso WHERE fk_paciente_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idPaciente]);
    return $stmt->fetchAll();
}




function setTelEmergencia($pdo, $telefone, $paciente_id)
{
    $sql = "UPDATE paciente SET contato_emergencia = ? WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$telefone, $paciente_id])) {
        echo "Contato adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar contato";
    }
}