<?php

session_start();
require '../models/UserModel.php';
require '../config/conexao.php';



function getUser () {

    global $pdo;

    if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 'paciente') {

        $nivel = $_SESSION['nivel'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = trim($_POST['senha']);
            $confirmar_senha = trim($_POST['confirmar_senha']);
            $cpf = trim($_POST['cpf']);
            $telefone = trim($_POST['telefone']);
            $genero = trim($_POST['genero']);
            $bDate = trim($_POST['bDate']);

            setPaciente($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $telefone, $genero, $nivel, $bDate);
        }

    } elseif (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 'medico') {

        $nivel = $_SESSION['nivel'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = trim($_POST['senha']);
            $confirmar_senha = trim($_POST['confirmar_senha']);
            $cpf = trim($_POST['cpf']);
            $crm = trim($_POST['crm']);   // corrigido
            $telefone = trim($_POST['telefone']);
            $especialidade = trim($_POST['especialidade']);
            $genero = trim($_POST['genero']);

            setMedico($pdo, $nome, $email, $senha, $confirmar_senha, $cpf, $crm, $telefone, $especialidade, $genero, $nivel);
        }

    } else {

        header("Location: btn_cadastro.php");
        exit();
    }
}

function validateUser() {
    global $pdo;

    if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 'paciente' || $_SESSION['nivel'] == 'medico') {

        $nivel = $_SESSION['nivel'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $senha = trim($_POST['senha']);
            $cpf = trim($_POST['cpf']);

            validar($pdo, $senha, $cpf);

        }
}
}