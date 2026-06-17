<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['erro'] = [];
}

require __DIR__ . "/../models/UserModel.php";
require __DIR__ . '/../config/conexao.php';
require __DIR__ . '/security.php';
require_once __DIR__ . '/../servico/chamados/guardar_arquivo.php';
require_once __DIR__ . '/../servico/chamados/enviar_email.php';

// function verificarConexao(){

//     }

function verificarTipo($niveisPermitidos)
{
    if (!isset($_SESSION['id_usuario'])) { // se o id tiver nulo, manda de volta pro login
        header('Location: login.php');
        exit();
    } else {

        $_SESSION['numero_carteirinha'] = showNumCarterinha();
    }

    if (!in_array($_SESSION['nivel'], $niveisPermitidos)) { //verifica se o nivel é permitido, se nao for, vai para acesso_negado
        header('Location: acesso_negado.php');
        exit();
    }
}

function verificarLogadoTipo()
{


    if (!isset($_SESSION['id_usuario'])) {
        return;
    }


    $tipo = $_SESSION['nivel'] ?? 'default';

    switch ($tipo) {
        case 'medico':
            header("Location: pgMedico.php");
            break;

        case 'paciente':
            header("Location: pgPaciente.php");
            break;
    }
    exit;
}


function getUser()
{

    global $pdo;

    if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 'paciente') {
        $nivel = $_SESSION['nivel'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = sanitizar($_POST['nome'] ?? '', 'nome');
            $email = sanitizar($_POST['email'] ?? '', 'email');
            $senha = trim($_POST['senha']);
            $confirmar_senha = trim($_POST['confirmar_senha']);
            $cpf = preg_replace('/[^0-9]/', '', trim($_POST['cpf']));
            $telefone = sanitizar($_POST['telefone'] ?? '', 'inteiro');
            $genero = sanitizar($_POST['genero'] ?? '', 'texto');
            $bDate = trim($_POST['bDate']);

            validarSenha($senha);
            confirmarSenha($senha, $confirmar_senha);
            validarCPF($cpf);


            if (empty($_SESSION['erro'])) {
                setPaciente($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $telefone, $genero, $nivel, $bDate);
            }
        }
    } elseif (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 'medico') {

        $nivel = $_SESSION['nivel'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = sanitizar($_POST['nome'] ?? '', 'nome');
            $email = sanitizar($_POST['email'] ?? '', 'email');
            $senha = trim($_POST['senha']);
            $confirmar_senha = trim($_POST['confirmar_senha']);
            $cpf = preg_replace('/[^0-9]/', '', trim($_POST['cpf']));;
            $crm = trim($_POST['crm']);   // corrigido
            $telefone = trim($_POST['telefone']);
            $especialidade = trim($_POST['especialidade']);
            $genero = trim($_POST['genero']);

            validarSenha($senha);
            confirmarSenha($senha, $confirmar_senha);
            validarCPF($cpf);

            if (empty($_SESSION['erro'])) {
                setMedico($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $crm, $telefone, $especialidade, $genero, $nivel);
            }
        }
    } else {

        header("Location: btn_cadastro.php");
        exit();
    }
}

function validateUser()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $senha = trim($_POST['senha']);
        $cpf = preg_replace('/[^0-9]/', '', trim($_POST['cpf']));


        validar($pdo, $senha, $cpf);
    }
}

function medicamento($id, $tipo)
{
    global $pdo;
    if ($tipo === 'paciente') {
        return getMedicamentoPaciente($pdo, $id);
    } elseif ($tipo === 'medico') {
        return getMedicamentoMedico($pdo, $id);
    } else {
        $_SESSION['erro'][] = "usuário não encontrado";
    }
}







function salvarHistoricoFamiliar()
{
    global $pdo;

    if (!isset($_SESSION['id_usuario'])) {
        $_SESSION['erro'][] = "Paciente não encontrado.";;
    }

    $id_usuario = $_SESSION['id_usuario'];

    // Busca o ID do paciente relacionado ao usuário logado
    $stmt = $pdo->prepare("
        SELECT id
        FROM paciente
        WHERE fk_usuario_id = ?
    ");

    $stmt->execute([$id_usuario]);

    $paciente_id = $stmt->fetchColumn();

    if (!$paciente_id) {
        $_SESSION['erro'][] = "Paciente não encontrado.";
        header("Location: ../views/pgPaciente.php");
        exit;
    }

    $parentesco = $_POST['parentesco'] ?? null;
    $doença = $_POST['doenca'] ?? null; // sem acento
    $nivel = $_POST['nivel'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    setHistoricoFamiliar($pdo, $paciente_id, $parentesco, $doença, $nivel, $descricao);

    $_SESSION['sucesso'] = "Histórico familiar adicionado com sucesso!";
    header("Location: ../views/historicoFamiliar.php");
    exit;
}

function  editarHistorico()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        $_SESSION['erro'][] = "Usuário não autenticado";
        header("Location: ../views/pgPaciente.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
        $parentesco = $_POST['parentesco'] ?? null;
        $doenca = $_POST['doenca'] ?? null;
        $nivel = $_POST['nivel'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        $idHistorico = $_POST['id_historico'] ?? null;



        updateHistoricoFamiliar($pdo, $idHistorico, $parentesco, $doenca, $nivel, $descricao);

        $_SESSION['sucesso'] = "Histórico familiar editado com sucesso!";
        header("Location: ../views/historicoFamiliar.php");
        exit;
    }
}







function salvarTelEmergencia()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['tel_emergencia'] ?? '') === 'salvar') {

        $telefone = $_POST['telefone'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];

        if ($telefone) {

            // remove tudo que não for número
            $telefone = preg_replace('/\D/', '', $telefone);

            // valida se tem exatamente 11 números
            if (strlen($telefone) === 11) {

                if ($telefone !== showTelEmergencia()) {
                    setTelEmergencia($pdo, $telefone, $paciente_id);
                }
            } else {

                $_SESSION['erro'][] = "O telefone deve conter exatamente 11 números.";
            }
        }
    }
}


function showTelEmergencia()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getTelEmergenciaDataBase($pdo, $paciente_id);
}



function showNome()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getNomeDataBase($pdo, $paciente_id);
}


function showCPF()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getCPFDataBase($pdo, $paciente_id);
}





function salvarAltura()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $altura = $_POST['altura'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];

        if ($altura !== null && $altura !== '') {

            // troca vírgula por ponto
            $altura = str_replace(',', '.', trim($altura));

            // valida se é número
            if (is_numeric($altura)) {

                $altura = (float) $altura;

                // valida limite
                if ($altura <= 230) {
                    if ($altura !== showAltura()) {
                        setAltura($pdo, $altura, $paciente_id);
                    }
                } else {
                    $_SESSION['erro'][] = "A altura não pode ser maior que 2,30.";
                }
            } else {
                $_SESSION['erro'][] = "Digite apenas números válidos.";
            }
        }
    }
}

function showAltura()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getAlturaDataBase($pdo, $paciente_id);
}



function salvarAlergia()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $alergia = $_POST['alergia'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];

        if ($alergia) {

            // Remove espaços extras
            $alergia = trim($alergia);

            // Verifica se NÃO contém números
            if (!preg_match('/[0-9]/', $alergia)) {
                if ($alergia !== showAlergia()) {
                    setAlergia($pdo, $alergia, $paciente_id);
                }
            } else {
                $_SESSION['erro'][] = "A alergia não pode conter números.";
            }
        }
    }
}

function showAlergia()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getAlergiaDataBase($pdo, $paciente_id);
}





function salvarGenero()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $genero = $_POST['genero'];

        if ($genero == null) {
            $genero = showGenero();
        }


        $generoVerificacao = $genero;

        if ($generoVerificacao == 'm') {
            $generoVerificacao = 'Masculino';
        } elseif ($generoVerificacao == 'f') {
            $generoVerificacao = 'Feminino';
        } else {
            $generoVerificacao = 'Indefinido';
        }

        $paciente_id = $_SESSION['id_usuario'];
        if ($generoVerificacao !== showGenero()) {
            setGenero($pdo, $genero, $paciente_id);
        }
    }
}

function showGenero()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getGeneroDataBase($pdo, $paciente_id);
}



function salvarSangue()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sangue = $_POST['sangue'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];
        if ($sangue) {
            setSangue($pdo, $sangue, $paciente_id);
        }
    }
}

function showSangue()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getSangueDataBase($pdo, $paciente_id);
}




function salvarPeso()
{

    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $peso = $_POST['peso'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];

        // Remove espaços e troca vírgula por ponto
        $peso = str_replace(',', '.', trim($peso));

        // Verifica se é número válido
        if (is_numeric($peso)) {

            $peso = (float) $peso;

            // validação de limite (ex: altura até 2.30)
            if ($peso <= 230) {
                if ($peso !== showPeso()) {
                    setPeso($pdo, $peso, $paciente_id);
                }
            } else {
                $_SESSION['erro'][] = "A altura não pode ser maior que 2,30.";
            }
        } else {
            $_SESSION['erro'][] = "Digite apenas números válidos.";
        }
    }
}


function showPeso()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getPesoDataBase($pdo, $paciente_id);
}



function showIdade()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getIdadeDataBase($pdo, $paciente_id);
}


function showDataNasc()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return traduz_data_para_exibir(getDataNascDataBase($pdo, $paciente_id));
}





function showNumCarterinha()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getNumeroCarteirinha($pdo, $paciente_id);
}

function showHistoricoFamiliar()
{
    return getHistoricoFamiliarDataBase();
}





function receitas($id)
{
    global $pdo;
    return getReceitasMedicas($pdo, $id);
}

function arquivo()
{
    global $pdo;
    $id = trim($_GET['arquivo']);
    $dados = getArquivo($pdo, $id);
    $caminhoRelativo = str_replace('\\', '/', $dados['caminho']);
    $arquivo = realpath(__DIR__ . '/../documento/' . $caminhoRelativo);

    // Segurança
    if (!$arquivo || !file_exists($arquivo)) {
        http_response_code(404);
        $_SESSION['erro'][] = "Arquivo não encontrado.";
    }

    // Cabeçalhos corretos para exibir no navegador
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"documento.pdf\"");
    header("Content-Length: " . filesize($arquivo));

    // Evita bloqueio em iframe
    header("X-Frame-Options: SAMEORIGIN");

    readfile($arquivo);
    exit;
}




function showProblemaLeve()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getProblemaLeveDataBase($pdo, $paciente_id);
}

function showProblemaMedio()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getProblemaMedioDataBase($pdo, $paciente_id);
}

function showProblemaGrave()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getProblemaGraveDataBase($pdo, $paciente_id);
}

function buscarPaciente($item)
{
    global $pdo;
    if (isset($item) || $item !== '' || $item !== null) {
        return getBusca($pdo, $item);
    }
    return;
}
function pacienteMedicos($id)
{
    global $pdo;
    return getPacienteMedicos($pdo, $id);
}

function sessionPaciente()
{
    global $pdo;
    if (isset($_GET['paciente']) && isset($_GET['tipo'])) {
        $id = $_GET['paciente'] ?? '';
        $_SESSION['id_paciente'] = $id;
        $_SESSION['comorbidades'] = $_GET['tipo'];
    }
    $nome = getinformacaoPaciente($pdo, $_SESSION['id_paciente']);
    $_SESSION['nome_paciente'] = $nome['nome'] ?? 'paciente';
    $_SESSION['numeroCarteirinha'] = $nome['numeroCartera'] ?? '';
}
function informacaoMedica()
{
    global $pdo;

    $usuarioId = (int)($_SESSION['id_usuario'] ?? 0);
    if (!$usuarioId) {
        unset($_SESSION['id_medico'], $_SESSION['nome_medico']);
        return false;
    }

    $medico = getMedicoIdByUsuarioId($pdo, $_SESSION['id_usuario']);
    if (!$medico || empty($medico['id'])) {
        return false;
    }



    return true;
}
function uploadArquivoI()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    try {
        $nome = sanitizar($_POST['nome'] ?? '', 'texto');
        $descricao = sanitizar($_POST['descricao'] ?? '', 'texto');
        $data_emissao = trim($_POST['data_emissao'] ?? '');
        $data_validade = trim($_POST['data_validade'] ?? '');
        $tipo = trim($_POST['tipo'] ?? '');
        $usuarioMedicoId = (int)($_SESSION['id_usuario'] ?? 0);
        $paciente = (int)($_SESSION['id_paciente'] ?? 0);

        if (!$usuarioMedicoId || !$paciente) {
            throw new RuntimeException('Sessão inválida. Faça login novamente.');
        }

        if ($nome === '' || $descricao === '' || $data_emissao === '' || $tipo === '') {
            throw new RuntimeException('Preencha todos os campos obrigatórios.');
        }

        if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] === UPLOAD_ERR_NO_FILE) {
            throw new RuntimeException('Arquivo não enviado.');
        }

        if (empty($_SESSION['id_medico']) && !informacaoMedica()) {
            throw new RuntimeException('Médico não encontrado no sistema. Faça login novamente.');
        }

        $medico = (int)($_SESSION['id_medico'] ?? 0);
        if (!$medico) {
            throw new RuntimeException('Médico não encontrado no sistema. Faça login novamente.');
        }


        $pdo->beginTransaction();

        $id = setArquivo($pdo, $nome, $descricao, $data_emissao, $data_validade, $tipo, 'ativo', $medico, $paciente);
        if (!$id) {
            throw new RuntimeException('Falha ao cadastrar arquivo no banco de dados.');
        }
        $id = (int)$id;

        $nameArquivo = pathinfo($_FILES['arquivo']['name'] ?? '', PATHINFO_FILENAME);
        if ($nameArquivo === '') {
            $nameArquivo = 'documento-medico';
        }

        $patientName = explode(' ', trim($_SESSION['nome_paciente'] ?? 'paciente'))[0] ?? 'paciente';
        $uploadService = new UploadService(__DIR__ . '/../documento');
        $filePath = $uploadService->handleUpload(
            $_FILES['arquivo'],
            $patientName,
            $paciente,
            $nameArquivo,
            $id
        );


        if (!updateArquivo($pdo, $id, $filePath)) {
            throw new RuntimeException('Erro ao atualizar o caminho do arquivo no banco de dados.');
        }

        $pdo->commit();

        $_SESSION['success'] = 'Documento médico enviado com sucesso.';
        header('Location: ../views/medPaciente.php?paciente=' . $_SESSION['id_paciente']);
        exit();
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        } elseif (isset($id) && is_int($id)) {
            deleteArquivo($pdo, $id);
        }

        $_SESSION['erro'][] = $e->getMessage();
    }
}

function mudarSenha()
{
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cpf = preg_replace('/[^0-9]/', '', trim($_POST['cpf']));
        $usuario = getinformacaoUsuario($pdo, $cpf);
        if (!$usuario) {
            $_SESSION['erro'][] = "Usuário não encontrado.";
            return;
        }
        $novaSenha = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $resultado = updateUsuario($pdo, $usuario['id'], $hash);
        if ($resultado === true) {
            $_SESSION['sucesso'] = "Um email de recuperação de senha foi enviado para o seu endereço de email cadastrado.";
            $_SESSION['senhaNova'] = "true";
        }
        enviarEmail($usuario['email'], $novaSenha);
    }
}

function repositorio($id, $tipo)
{
    global $pdo;
    return getRepositorio($pdo, $id, $tipo);
}

function excluirPorId()
{
    global $pdo;
    $id = $_GET['id'] ?? '';
    $nivel = $_SESSION['nivel'] ?? '';

    if ($nivel !== 'medico') {
        $_SESSION['erro'][] = "Nivel não permitido.";
        return false;
    }
    $dado = deletePorId($pdo, $id);

    if ($dado) {
        header("Location: ../views/medicamento_uso.php");
        exit();
    }
}
function MedicamentoUso()
{
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = sanitizar($_POST['nome'] ?? '', 'texto');
        $dosagem = trim($_POST['dosagem'] ?? '');
        $dataInicio = trim($_POST['inicio'] ?? '');
        $dataFim = trim($_POST['fim'] ?? '');
        $observacao = sanitizar($_POST['obs'] ?? '', 'texto');
        $frequencia = trim($_POST['frequencia'] ?? '');
        $pacienteId = ($_SESSION['id_paciente'] ?? 0);
        $medicoId = ($_SESSION['id_medico'] ?? 0);

        if (!$pacienteId || !$medicoId) {
            $_SESSION['erro'][] = "Sessão inválida. Faça login novamente.";
            return;
        }

        if ($nome === '' || $dosagem === '' || $frequencia === '') {
            $_SESSION['erro'][] = "Preencha todos os campos obrigatórios.";
            return;
        }

        $dado = setMedicamentoUso($pdo, $nome, $dosagem, $frequencia, $dataInicio, $dataFim, $observacao, $medicoId, $pacienteId);
        if ($dado) {
            header("Location: ../views/medicamento_uso.php");
            exit();
        }
    }
}
function mostrarMedicamentoUso($id)
{
    global $pdo;
    if (!is_numeric($id)) {
        $_SESSION['erro'][] = "ID inválido.";
        return false;
    }
    return getInformacaoMedicamentoUso($pdo, $id);
}

function mostrarProblemaSaude($id)
{
    global $pdo;
    if (!is_numeric($id)) {
        $_SESSION['erro'][] = "ID inválido.";
        return false;
    }
    return getProblemaSaude($pdo, $id);
}




function showTitulo()
{
    $titulo = $_GET['titulo'] ?? null;

    return $titulo;
}



function showDataEmissao()
{

    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;
    $tipo = $_GET['titulo'] ?? null;

    if (!$paciente_id) {
        return null;
    }


    return getDataEmissaoDataBase($pdo, $paciente_id, $tipo);
}

function showNomeMedico()
{

    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;
    $tipo = $_GET['titulo'] ?? null;

    if (!$paciente_id) {
        return null;
    }

    return getNomeMedicoDataBase($pdo, $paciente_id, $tipo);
}

function problemaSaude()
{
    global $pdo;
    date_default_timezone_set('America/Sao_Paulo');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nome = sanitizar($_POST['nome'] ?? '', 'texto');
        $status = trim($_POST['status'] ?? '');
        $tipo = trim($_POST['tipo'] ?? '');
        $data = date('Y-m-d');
        $pacienteId = ($_SESSION['id_paciente']);
        $medico = $_SESSION['id_medico'] ?? 0;
        $modelo = $_POST['modelo'];

        if (!$pacienteId && !$medico) {
            $_SESSION['erro'][] = "Sessão inválida. Faça login novamente.";
            return;
        }

        if ($nome === '' || $status === '' || $tipo === '') {
            $_SESSION['erro'][] = "Preencha todos os campos obrigatórios.";
            return;
        }

        if ($modelo === 'adicionar') {
            $dado = setProblemaSaude($pdo, $nome, $status, $tipo, $data, $pacienteId, $medico);
            if ($dado) {
                header("Location: ../views/problema_saude.php");
                exit();
            }
        }
        if ($modelo === 'editar') {
            $dado = updateProblemaSaude($pdo, $id, $nome, $status, $tipo, $data, $pacienteId, $medico);
            if ($dado) {
                header("Location: ../views/problema_saude.php");
                exit();
            }
        }
    }
}

function editarSenha()
{
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $senha = trim($_POST['senha']);
        $confirmar_senha = trim($_POST['confirmar_senha']);
        $usuario = $_SESSION['id_usuario'] ?? 0;

        if (!$usuario) {
            $_SESSION['erro'][] = "Sessão inválida. Faça login novamente.";
            return;
        }

        validarSenha($senha);
        confirmarSenha($senha, $confirmar_senha);

        if (empty($_SESSION['erro'])) {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $resultado = updateUsuario($pdo, $usuario, $hash);
            if ($resultado === true) {
                $_SESSION['sucesso'] = "Senha atualizada com sucesso.";
                $_SESSION['senhaNova'] = "false";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['erro'][] = "Erro ao atualizar a senha. Tente novamente.";
            }
        }
    }
}




function showIdArquivo()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;
    $tipo = $_GET['titulo'] ?? null;

    if (!$paciente_id) {
        return null;
    }


    return getIdAequivoDataBase($pdo, $paciente_id, $tipo);
}


function mostrarDadosPaciente($id)
{
    global $pdo;
    return getDadosPaciente($pdo, $id);
}


function dadosPaciente()
{
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $carteira  = $_POST['carterinha'];
        $altura = $_POST['altura'];
        $peso = $_POST['peso'];
        $alergias = $_POST['alergias'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $numeroCasa = $_POST['n_casa'];
        $sangue = $_POST['tipo_sanguineo'];
        $id = $_SESSION['id_paciente'];


        if (empty($_SESSION['erro'])) {
            updateDadosPaciente($pdo, $id, $carteira, $altura, $peso, $alergias, $rua, $bairro, $cidade, $numeroCasa, $sangue);
        }
    }
}






function salvarEndereco()
{

    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $rua = $_POST['rua'] ?? null;
        $numeroCasa = $_POST['numeroCasa'] ?? null;
        $bairro = $_POST['bairro'] ?? null;
        $cidade = $_POST['cidade'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];


        setEndereco($pdo, $rua, $numeroCasa, $bairro, $cidade, $paciente_id);
    } else {
        $_SESSION['erro'][] = "Server Error";
    }
}



function showRua()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;


    if (!$paciente_id) {
        return null;
    }


    return getRuaDataBase($pdo, $paciente_id,);
}

function showNumeroCasa()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;


    if (!$paciente_id) {
        return null;
    }


    return getNumeroCasaDataBase($pdo, $paciente_id,);
}

function showBairro()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;


    if (!$paciente_id) {
        return null;
    }


    return getBairroDataBase($pdo, $paciente_id,);
}


function showCidade()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'] ?? null;


    if (!$paciente_id) {
        return null;
    }


    return getCidadeDataBase($pdo, $paciente_id,);
}


function showDescricao()
{


    $paciente_id = $_SESSION['id_usuario'] ?? null;

    getDescricaoDataBase($paciente_id,);
}


function showNivel()
{


    $paciente_id = $_SESSION['id_usuario'] ?? null;

    getNivelDataBase($paciente_id);
}


function showParentesco()
{


    $paciente_id = $_SESSION['id_usuario'] ?? null;

    getParentescoDataBase($paciente_id);
}

function showDoenca()
{

    $paciente_id = $_SESSION['id_usuario'] ?? null;

    getDoencaDataBase($paciente_id);
}

function verificarNovaSenha()
{
    if (!empty($_SESSION['senhaNova'])) {
        if($_SESSION['senhaNova'] == "true"){
        header("Location: mudarSenha.php");
        exit();
    }
    }
    
}
