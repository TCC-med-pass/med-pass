<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../models/UserModel.php';
require '../config/conexao.php';
require 'security.php';

// function verificarConexao(){

//     }

function verificarTipo($niveisPermitidos) {
    if (!isset($_SESSION['id_usuario'])) { // se o id tiver nulo, manda devolta pro login
    header('Location: login.php');
    exit();
}
    if (!in_array($_SESSION['nivel'], $niveisPermitidos)) { //verifica se o nivel é permitido, se nao for, vai para acesso_negado
        header('Location: acesso_negado.php');
        exit();
    }
}

function verificarLogadoTipo() {


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


function getUser () {

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


            if(empty($_SESSION['erro'])){
                setPaciente($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $telefone, $genero, $nivel, $bDate);
            }

            
        }

    } elseif (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 'medico') {

        $nivel = $_SESSION['nivel'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = sanitizar($_POST['nome']?? '', 'nome');
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

            if(empty($_SESSION['erro'])){
                setMedico($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $crm, $telefone, $especialidade, $genero, $nivel);
            }

            
        }

    } else {

        header("Location: btn_cadastro.php");
        exit();
    }
}

function validateUser() {
    global $pdo;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $senha = trim($_POST['senha']);
            $cpf = trim($_POST['cpf']);

            if(empty($_SESSION['erro'])){
            validar($pdo, $senha, $cpf);
            }

        }

}

function Medicamento() {
    global $pdo;

    $id = $_SESSION['id_usuario'];
    $dado = getMedicamentoPaciente($pdo, $id);

    if (empty($dado)) {
        $dado = [[
            "nome" => "Não tem medicamento",
            "dosagem" => "--------",
            "frequencia" => "--------"
        ]];
    }

    foreach ($dado as $remedio) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($remedio['nome'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($remedio['dosagem'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($remedio['frequencia'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "</tr>";
    }
}

function mensagemErro (){
    global $pdo;
    if (!empty($_SESSION['erro'])) {
        echo "<ul>";

        foreach ($_SESSION['erro'] as $erro) {
            echo "<li>". htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . "</li>";
        }

        echo "</ul>";
        unset($_SESSION['erro']);

    }

}

// function mensagemSucesso (){}