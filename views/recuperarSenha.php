<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarLogadoTipo();
mudarSenha();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/erros.css">
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <title>Recuperar Senha</title>
</head>

<body>
    <main>
        <div class="container-1">
            <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass"></img>
            <h1>MedPass- Recuperar Senha</h1>

            <?php mensagemSucesso(); ?>
            <?php mensagemErro(); ?>

            <form method="post">
                <label for="cpf">CPF</label>
                <input name="cpf" type="text" placeholder='Digite seu CPF aqui.' required> <!-- Troquei os campos cpf de todos os arquivos de text pra number pro cara nao conseguir colocar letra no campo (se precisar troca de volta pra text) -->

                <button type="submit" class="btn" style="margin-top: 20px;">Enviar código de recuperação</button>
            </form>
        </div>
    </main>
</body>

</html>