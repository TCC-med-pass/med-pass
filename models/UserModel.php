<?php



function setPaciente($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $telefone, $genero, $nivel, $bdate) {

    if (!empty($email)) {

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {

            header("Location: login.php");
            exit();

        } else {

            if (empty($nome) || empty($email) || empty($senha) || empty($bdate) || empty($cpf) || empty($telefone) || empty($genero) || $confirmar_senha !== $senha) {

                echo "Campo vazio ou senha incoerente";

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
                    echo "Erro ao cadastrar: " . $e->getMessage();
                }
            }
        }
    }
}






function setMedico ($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $crm, $telefone, $especialidade, $genero, $nivel) {
     if (!empty($email)) {

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {

            header("Location: ../views/login.php");
            exit();

        } else {

            if (empty($nome) || empty($email) || empty($senha) || empty($cpf) || empty($crm) || empty($telefone) || empty($especialidade) || empty($genero) || $confirmar_senha !== $senha) {

                echo "Campo vazio ou senha incoerente";

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
                    echo "Erro ao cadastrar: " . $e->getMessage();
                }
            }
        }
    }
}



function validar ($pdo, $senha, $cpf) {

    $sql = "SELECT senha, nivel FROM usuarios WHERE cpf = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf]);

   $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
    
        $_SESSION['nivel'] = $usuario['nivel'];
    
        if ($usuario['nivel'] == 'medico') {
    
            header("Location: ../views/pgMedico.php");
        echo 'deu certo!';
            exit();
    
        } elseif ($usuario['nivel'] == 'paciente') {
    
            header("Location: ../views/pgPaciente.php");
            exit();
    
        }
    
    } else {
    
        echo 'Usuário ou senha incorretos!';
    }

}