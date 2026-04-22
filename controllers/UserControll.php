<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['erro'] = [];
}

require __DIR__ . "/../models/UserModel.php";
require __DIR__ . '/../config/conexao.php';
require __DIR__ . '/security.php';

// function verificarConexao(){

//     }

function verificarTipo($niveisPermitidos)
{
    if (!isset($_SESSION['id_usuario'])) { // se o id tiver nulo, manda devolta pro login
        header('Location: login.php');
        exit();
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
            $cpf = trim($_POST['cpf']);
            $telefone = sanitizar($_POST['telefone'] ?? '', 'inteiro');
            $genero = sanitizar($_POST['genero'] ?? '', 'texto');
            $bDate = trim($_POST['bDate']);

            validarSenha($senha);
            confirmarSenha($senha, $confirmar_senha);


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
            $cpf = trim($_POST['cpf']);
            $crm = trim($_POST['crm']);   // corrigido
            $telefone = trim($_POST['telefone']);
            $especialidade = trim($_POST['especialidade']);
            $genero = trim($_POST['genero']);

            validarSenha($senha);
            confirmarSenha($senha, $confirmar_senha);

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
        $cpf = trim($_POST['cpf']);

        if (empty($_SESSION['erro'])) {
            validar($pdo, $senha, $cpf);
        }
    }
}

function medicamento($id)
{
    global $pdo;
    return getMedicamentoPaciente($pdo, $id);
}



function salvarTelEmergencia()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $telefone = $_POST['telefone'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];
        if ($telefone) {
            setTelEmergencia($pdo, $telefone, $paciente_id);
        }
    }
}

function showTelEmergencia()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $telefoneDeEmergencia = getTelEmergenciaDataBase($pdo, $paciente_id);

    return $telefoneDeEmergencia;
}

$telefoneDeEmergencia = showTelEmergencia(); // variavel que deve ser usada no front para mostrar o Telefone



function showNome()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $nomePaciente = getNomeDataBase($pdo, $paciente_id);

    return $nomePaciente;
}

$nomePciente = showNome(); // variavel que deve ser usada no front para mostrar o Nome

function showCPF()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $cpf = getCPFDataBase($pdo, $paciente_id);

    return $cpf;
}

$cpf = showCPF(); // variavel que deve ser usada no front para mostrar o CPF



function salvarAltura()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $altura = $_POST['altura'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];
        if ($altura) {
            setAltura($pdo, $altura, $paciente_id);
        }
    }
}

function showAltura()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $altura = getAlturaDataBase($pdo, $paciente_id);

    return $altura;
}

$altura = showAltura(); // variavel que deve ser usada no front para mostrar a altura



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
            setAlergia($pdo, $alergia, $paciente_id);
        }
    }
}

function showAlergia()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $alergia = getAlergiaDataBase($pdo, $paciente_id);

    return $alergia;
}

$alergia = showAlergia(); // variavel que deve ser usada no front para mostrar a alergia



function salvarGenero()
{
    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $genero = $_POST['genero'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];
        if ($genero) {
            setGenero($pdo, $genero, $paciente_id);
        }
    }
}

function showGenero()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $genero = getGeneroDataBase($pdo, $paciente_id);

    return $genero;
}

$genero = showGenero(); // variavel que deve ser usada no front para mostrar o genero


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

    $paciente_id = $_SESSION['id_usuario'];
    $sangue = getSangueDataBase($pdo, $paciente_id);

    return $sangue;
}

$sangue = showSangue(); // variavel que deve ser usada no front para mostrar o sangue


function salvarPeso()
{

    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $peso = $_POST['peso'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];
        if ($peso) {
            setPeso($pdo, $peso, $paciente_id);
        }
    }
}


function showPeso()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $peso = getPesoDataBase($pdo, $paciente_id);

    return $peso;
}

$peso = showPeso(); // variavel que deve ser usada no front para mostrar o peso


function showIdade()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $idade = getIdadeDataBase($pdo, $paciente_id);

    return $idade;
}

$idade = showIdade(); // variavel que deve ser usada no front para mostrar a idade


function showDataNasc()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $data_nascimento = getDataNascDataBase($pdo, $paciente_id);

    return $data_nascimento;
}

$data_nascimento = showDataNasc(); // variavel que deve ser usada no front para mostrar a data de nascimento



function showNumCarterinha()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $numero_de_carteirinha = getNumCarterinhaDataBase($pdo, $paciente_id);

    return $numero_de_carteirinha;
}

$numero_de_carteirinha = showNumCarterinha(); // variavel que deve ser usada no front para mostrar o numero da carterinha


function salvarHistoricoFamiliar()
{

    global $pdo;
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuário não autenticado");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $historico_familiar = $_POST['historico_familiar'] ?? null;
        $paciente_id = $_SESSION['id_usuario'];
        if ($historico_familiar) {
            setHistoricoFamiliar($pdo, $historico_familiar, $paciente_id);
        }
    }
}

function showHistoricoFamiliar()
{
    global $pdo;

    $paciente_id = $_SESSION['id_usuario'];
    $historico_familiar = getHistoricoFamiliarDataBase($pdo, $paciente_id);

    return $historico_familiar;
}

$historico_familiar = showHistoricoFamiliar(); // variavel que deve ser usada no front para mostrar o Historico Familiar





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
    $arquivo = $dados['caminho'];

    // Segurança
    if (!file_exists($arquivo)) {
        http_response_code(404);
        die("Arquivo não encontrado.");
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
