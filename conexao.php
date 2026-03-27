<?php

$host = "localhost";  //  localhost  sql.freedb.tech
$db   = "med_pass"; // freedb_med_pass  med_pass
$user = "root"; // freedb_alunos  root
$pass = ""; // wd?U4fqJyGb5R!M  
$charset = "utf8mb4";

$conexao = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($conexao, $user, $pass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    echo "";

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>