<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validateUser();
}

verificarLogadoTipo();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/erros.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <title>MedPass- Login</title>
</head>

<body>
    <main>
        <div class="container-1">
            <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass"></img>
            <h1>MedPass- Login</h1>

            <?php mensagemErro(); ?>

            <form method="post">
                <label for="cpf">CPF</label>
                <input name="cpf" type="text" placeholder="Digite seu CPF aqui" required> <!-- Troquei os campos cpf de todos os arquivos de text pra number pro cara nao conseguir colocar letra no campo (se precisar troca de volta pra text) -->

                <label for="senha">Senha</label>
                <div class="campoSenhaLogin">
                    <input type="password" name="senha" placeholder="Digite aqui sua senha" id="senha" required>
                    <button type="button" class="mostrarSenha" data-target="senha">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <p>Esqueceu sua senha? <a href="recuperarSenha.php" class="ajuda"><strong>Recuperar Senha</strong></a></p>
                <p>Não possui cadastro? <a href="btn_cadastro.php" class="ajuda"><strong>Fazer cadastro</strong></a></p>
                <p>Precisa de ajuda? <a href="#" class="ajuda"><strong>Clique aqui</strong></a></p>

                <button type="submit" class="btn">Entrar</button>
            </form>
        </div>
    </main>
    <script src="./scripts/mostrarSenha.js"></script>
</body>

</html>