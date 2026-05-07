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
        $_SESSION['sucesso'] = "Contato de Emergencia adicionado com sucesso!";
    } else {
        $_SESSION['erro'][] = "Erro ao adicionar Contato de Emergencia";
    }
}

function getTelEmergenciaDataBase($pdo, $paciente_id)
{ // as outras funções dessa pagina podem seguir os mesmos padrões, apenas mudando os dados do banco e nome de variavel
    $sql = "SELECT contato_emergencia FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $TelEmergencia = $stmt->fetch(PDO::FETCH_ASSOC);

        return $TelEmergencia['contato_emergencia'];
    }
    return null;
}

function getNomeDataBase($pdo, $paciente_id)
{
    $sql = "SELECT nome FROM usuarios WHERE id = ? AND nivel = 'paciente' ";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $nome = $stmt->fetch(PDO::FETCH_ASSOC);

        return $nome['nome'];
    }

    return null;
}

function getNomeMedicoDataBase($pdo, $paciente_id)
{
    $sql = "SELECT nome FROM usuarios WHERE id = ? AND nivel = 'medico' "; // pedir codigo sql para a dileine

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $nome = $stmt->fetch(PDO::FETCH_ASSOC);

        return $nome['nome'];
    }

    return null;
}

function getCPFDataBase($pdo, $paciente_id)
{

    $sql = "SELECT cpf FROM usuarios WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $cpf = $stmt->fetch(PDO::FETCH_ASSOC);

        return $cpf['cpf'];
    }

    return null;
}

function setAltura($pdo, $altura, $paciente_id)
{
    $sql = "UPDATE paciente SET altura = ? WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$altura, $paciente_id])) {
        $_SESSION['sucesso'] = "Altura adicionada com sucesso!";
    } else {
        $_SESSION['erro'][] = "Erro ao adicionar altura";
    }
}


function getAlturaDataBase($pdo, $paciente_id)
{

    $sql = "SELECT altura FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $altura = $stmt->fetch(PDO::FETCH_ASSOC);

        return $altura['altura'];
    }

    return null;
}


function setAlergia($pdo, $alergia, $paciente_id)
{
    $sql = "UPDATE paciente SET alergias = ? WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$alergia, $paciente_id])) {
        $_SESSION['sucesso'] = "Alergia adicionada com sucesso!";
    } else {
        $_SESSION['erro'][] = "Erro ao adicionar alergia";
    }
}

function getAlergiaDataBase($pdo, $paciente_id)
{
    $sql = "SELECT alergias FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$paciente_id]);

    $alergia = $stmt->fetch(PDO::FETCH_ASSOC);

    return $alergia['alergias'] ?? null;
}

function setGenero($pdo, $genero, $paciente_id)
{
    $sql = "UPDATE usuarios SET genero = ? WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$genero, $paciente_id])) {
        $_SESSION['sucesso'] = "Genero adicionado com sucesso!";
    } else {
        $_SESSION['erro'][] = "Erro ao adicionar gênero";
    }
}

function getGeneroDataBase($pdo, $paciente_id)
{

    $sql = "SELECT 
                CASE
                    WHEN genero = 'M' THEN 'Masculino'
                    WHEN genero = 'F' THEN 'Feminino'
                    ELSE 'Indefinido'
                END AS Genero
            FROM usuarios
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $genero = $stmt->fetch(PDO::FETCH_ASSOC);

        return $genero['genero'];
    }

    return null;
}


function  setSangue($pdo, $sangue, $paciente_id)
{
    $sql = "UPDATE paciente SET tipo_sanguineo = ? WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$sangue, $paciente_id])) {
        $_SESSION['sucesso'] = "Sangue adicionado com sucesso!";
    } else {
        $_SESSION['erro'][] = "Erro ao adicionar Sangue";
    }
}

function getSangueDataBase($pdo, $paciente_id)
{
    $sql = "SELECT tipo_sanguineo FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $sangue = $stmt->fetch(PDO::FETCH_ASSOC);

        return $sangue['tipo_sanguineo'];
    }

    return null;
}

function setPeso($pdo, $peso, $paciente_id)
{
    $sql = "UPDATE paciente SET peso = ? WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$peso, $paciente_id])) {
        $_SESSION['sucesso'] = "Peso adicionado com sucesso!";
    } else {
        $_SESSION['erro'][] = "Erro ao adicionar Peso";
    }
}

function getPesoDataBase($pdo, $paciente_id)
{
    $sql = "SELECT peso FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $peso = $stmt->fetch(PDO::FETCH_ASSOC);

        return $peso['peso'];
    }

    return null;
}


function getIdadeDataBase($pdo, $paciente_id)
{
    $sql = "SELECT TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) AS idade FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $idade = $stmt->fetch(PDO::FETCH_ASSOC);

        return $idade['idade'];
    }

    return null;
}

function getDataNascDataBase($pdo, $paciente_id)
{
    $sql = "SELECT data_nascimento FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $data_nascimento = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data_nascimento['data_nascimento'];
    }

    return null;
}

function getNumCarterinhaDataBase($pdo, $paciente_id)
{
    $sql = "SELECT numero_de_carteirinha FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $numero_de_carteirinha = $stmt->fetch(PDO::FETCH_ASSOC);

        return $numero_de_carteirinha['numero_de_carteirinha'];
    }

    return null;
}



function setHistoricoFamiliar($pdo, $historico_familiar, $paciente_id)
{
    $sql = "UPDATE paciente SET historico_familiar = ? WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$historico_familiar, $paciente_id])) {
        $_SESSION['sucesso'] = "Historico adicionado com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao adicionar Histórico";
    }
}

function getHistoricoFamiliarDataBase($pdo, $paciente_id)
{
    $sql = "SELECT historico_familiar FROM paciente WHERE fk_usuario_id = ?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $historico_familiar = $stmt->fetch(PDO::FETCH_ASSOC);

        return $historico_familiar['historico_familiar'];
    }

    return null;
}


function getReceitasMedicas($pdo, $id)
{
    $sql = "SELECT a.id_arquivos as id, a.descricao as descricao, a.data_emissao as data, usua.nome as medico FROM arquivos a LEFT JOIN medico me ON a.fk_medico_id = me.id LEFT JOIN usuarios usua ON me.fk_usuario_id = usua.id WHERE a.fk_paciente_id = ? and a.tipo = 'receitas' ORDER BY a.data_emissao;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getArquivo($pdo, $idArquivo)
{
    $sql = "SELECT caminho FROM arquivos WHERE id_arquivos = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idArquivo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function  getProblemaLeveDataBase($pdo, $paciente_id)
{

    $sql =
        "SELECT paciente.id, problema_de_saude.*
    FROM paciente inner join usuarios on usuarios.id = paciente.fk_usuario_id
                  inner join problema_de_saude on paciente.id = problema_de_saude.fk_paciente
    WHERE usuarios.id = ?
    and problema_de_saude.status = 'leve' ";


    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $problema_de_saude = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($problema_de_saude) {
            return $problema_de_saude['problema_de_saude'];
        } else {
            return null;
        }
    }

    return null;
}

function  getProblemaMedioDataBase($pdo, $paciente_id)
{

    $sql =
        "SELECT paciente.id, problema_de_saude.*
    FROM paciente inner join usuarios on usuarios.id = paciente.fk_usuario_id
                  inner join problema_de_saude on paciente.id = problema_de_saude.fk_paciente
    WHERE usuarios.id = ?
    and problema_de_saude.status = 'medio' ";


    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $problema_de_saude = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($problema_de_saude) {
            return $problema_de_saude['problema_de_saude'];
        } else {
            return null;
        }
    }

    return null;
}


function  getProblemaGraveDataBase($pdo, $paciente_id)
{

    $sql =
        "SELECT paciente.id, problema_de_saude.*
    FROM paciente INNER JOIN usuarios ON usuarios.id = paciente.fk_usuario_id
                  INNER JOIN problema_de_saude ON paciente.id = problema_de_saude.fk_paciente
    WHERE usuarios.id = ?
    AND problema_de_saude.status = 'grave'";


    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $problema_de_saude = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($problema_de_saude) {
            return $problema_de_saude['problema_de_saude'];
        } else {
            return null;
        }
    }

    return null;
}


function getDataEmissaoProntuarioDataBase($pdo, $paciente_id)
{
    $sql = "SELECT data_emissao FROM arquivos WHERE tipo = 'prontuário' AND fk_paciente_id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $data_emissao = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($data_emissao) {
            return $data_emissao['data_emissao'];
        } else {
            return null;
        }
    }

    return null;
}


function getDataEmissaoCirurgiaDataBase($pdo, $paciente_id)
{
    $sql = "SELECT data_emissao FROM arquivos WHERE tipo = 'cirurgia' AND fk_paciente_id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $data_emissao = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($data_emissao) {
            return $data_emissao['data_emissao'];
        } else {
            return null;
        }
    }

    return null;
}

function getDataEmissaoExamesDataBase($pdo, $paciente_id)
{
    $sql = "SELECT data_emissao FROM arquivos WHERE tipo = 'exames' AND fk_paciente_id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $data_emissao = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($data_emissao) {
            return $data_emissao['data_emissao'];
        } else {
            return null;
        }
    }

    return null;
}


function getDataEmissaoAtestadoDataBase($pdo, $paciente_id)
{
    $sql = "SELECT data_emissao FROM arquivos WHERE tipo = 'atestado' AND fk_paciente_id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $data_emissao = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($data_emissao) {
            return $data_emissao['data_emissao'];
        } else {
            return null;
        }
    }

    return null;
}


function getDataEmissaoLaudoDataBase($pdo, $paciente_id)
{
    $sql = "SELECT data_emissao FROM arquivos WHERE tipo = 'laudo' AND fk_paciente_id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$paciente_id])) {
        $data_emissao = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($data_emissao) {
            return $data_emissao['data_emissao'];
        } else {
            return null;
        }
    }

    return null;
}
