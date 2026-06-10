<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['paciente','medico']);
editarSenha();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/erros.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <title>Recuperar Senha</title>
</head>
<body>
    <main>
        <div class="container-1">
            <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass"></img>
            <h1>MedPass- Mudar senha</h1>

            <?php mensagemSucesso(); ?> 
            <?php mensagemErro(); ?>
            
            <form method="post">
                <label for="senha">Senha</label>
                <div class="campoSenha campoSenha80">
                    <input type="password" name="senha" placeholder="Digite aqui sua senha" id="senha" required>
                    <button type="button" class="mostrarSenha" data-target="senha">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
    
                <label for="confirmar_senha">Confirmar Senha</label>
                <div class="campoSenha campoSenha80">
                    <input type="password" name="confirmar_senha" placeholder="Confirme sua senha" id="confirmar_senha" required>
                    <button type="button" class="mostrarSenha" data-target="confirmar_senha">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <button type="submit" class="btn" style="margin-top: 20px;">Redefinir senha</button>
            </form>
        </div>
    </main>
    <script src="./scripts/mostrarSenha.js"></script>
</body>
</html>