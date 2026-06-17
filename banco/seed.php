<?php

require_once "config_banco_uso.php";

$conn = new mysqli($host, $user, $password, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$mensagens = [];
$mensagens[] = "Conectado ao banco";

// =============================
// USUARIOS
// =============================

$senha = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios
(nome, genero, email, cpf, senha, nivel, telefone)
VALUES
('João Silva','M','joao@email.com','32432799844','$senha','paciente','11999999999'),
('Maria Souza','F','maria@email.com','45074133890','$senha','medico','11988888888')
";

$conn->query($sql);

// =============================
// PACIENTE
// =============================

$sql = "INSERT INTO paciente
(
    fk_usuario_id,
    alergias,
    tipo_sanguineo,
    numero_de_carteirinha,
    data_nascimento,
    rua,
    numero_casa,
    bairro,
    cidade,
    altura,
    peso,
    contato_emergencia
)

VALUES
(
    1,
    'Dipirona',
    'O+',
    '123',
    '2000-05-10',
    'Rua das Flores',
    '120',
    'Centro',
    'São Paulo',
    1.75,
    70.5,
    11977777777
)
";

$conn->query($sql);

// =============================
// HISTORICO FAMILIAR
// =============================

$sql = "INSERT INTO historico_familiar
(
    descricao,
    parentesco,
    doenca,
    nivel,
    fk_paciente_id
)

VALUES
(
    'Histórico de diabetes na família',
    'Pai',
    'Diabetes',
    'medio',
    1
)
";

$conn->query($sql);

// =============================
// MEDICO
// =============================

$sql = "INSERT INTO medico
(
    fk_usuario_id,
    crm,
    especialidade
)

VALUES
(
    2,
    'SP123456',
    'Cardiologia'
)
";

$conn->query($sql);

// =============================
// ARQUIVOS
// =============================

$sql = "INSERT INTO arquivos
(
    nome,
    caminho,
    descricao,
    anexo,
    tipo,
    data_emissao,
    data_validade,
    status,
    fk_paciente_id,
    fk_medico_id
)

VALUES

(
    'exame1',
    'joao1/testeArquivo_1.pdf',
    'teste exame',
    NULL,
    'exame',
    '2026-05-22',
    '2026-05-22',
    'ativo',
    1,
    1
),

(
    'laudo1',
    'joao1/testeArquivo_2.pdf',
    'teste laudo',
    NULL,
    'laudo',
    '2026-05-22',
    '2026-05-22',
    'ativo',
    1,
    1
),

(
    'receita1',
    'joao1/testeArquivo_3.pdf',
    'teste receita',
    NULL,
    'receitas',
    '2026-05-22',
    '2026-05-22',
    'ativo',
    1,
    1
),

(
    'cirurgia1',
    'joao1/testeArquivo_4.pdf',
    'teste cirurgia',
    NULL,
    'cirurgia',
    '2026-05-22',
    '2026-05-22',
    'ativo',
    1,
    1
),

(
    'prontuario1',
    'joao1/testeArquivo_5.pdf',
    'teste prontuario',
    NULL,
    'prontuario',
    '2026-05-22',
    '2026-05-22',
    'ativo',
    1,
    1
),

(
    'atestado1',
    'joao1/testeArquivo_6.pdf',
    'teste atestado',
    NULL,
    'atestado',
    '2026-05-22',
    '2026-05-22',
    'ativo',
    1,
    1
)
";

$conn->query($sql);

// =============================
// MEDICAMENTOS EM USO
// =============================

$sql = "INSERT INTO medicamento_em_uso
(
    nome,
    dosagem,
    frequencia,
    data_inicio,
    data_fim,
    observacao,
    fk_medico_id,
    fk_paciente_id
)

VALUES

(
    'Losartana',
    '50 mg',
    '2x ao dia',
    '2026-05-01',
    '2026-09-01',
    'Pressão alta',
    1,
    1
),

(
    'Paracetamol',
    '1 comprimido',
    'a cada 8 horas',
    '2026-05-10',
    '2026-05-15',
    'Dor de cabeça',
    1,
    1
)
";

$conn->query($sql);

// =============================
// PROBLEMAS DE SAÚDE
// =============================

$sql = "INSERT INTO problema_de_saude
(
    nome,
    status,
    tipo,
    data,
    fk_paciente,
    fk_medico
)

VALUES

(
    'Hipertensão',
    'controlado',
    'medio',
    '2026-05-10',
    1,
    1
),

(
    'Gripe',
    'curado',
    'leve',
    '2026-05-15',
    1,
    1
)
";

$conn->query($sql);

$mensagens[] = "Dados inseridos com sucesso.";


$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Códigos do Banco</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#1e3c72,#2a5298);
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.container{
    background:white;
    padding:40px;
    border-radius:10px;
    width:450px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h1{
    text-align:center;
    margin-bottom:20px;
}

.msg{
    background:#f5f5f5;
    padding:10px;
    border-left:4px solid #2a5298;
    margin-bottom:10px;
    border-radius:5px;
}

a{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    background:#2a5298;
    color:white;
    padding:10px 20px;
    border-radius:6px;
}

a:hover{
    background:#1e3c72;
}

</style>

</head>
<body>

<div class="container">

<h1>Status do Banco</h1>

<?php
foreach($mensagens as $msg){
    echo "<div class='msg'>$msg</div>";
}
?>

<br>

<a href="index.php">⬅ Voltar</a>

</div>

</body>
</html>