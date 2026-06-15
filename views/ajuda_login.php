<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedPass – Ajuda (Login e Cadastro)</title>
  <link rel="icon" type="image/png" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./styles/ajuda_login.css">
</head>
<body>

  <!-- TOPBAR -->
  <header id="header">
    <div class="container">
      <a href="./login.php" class="topbar-icon"><i class="fa-solid fa-house"></i></a>
    </div>
    <div class="container">
      <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    </div>
    <div class="container">
      <i class="fa-solid fa-bars menu-icon"></i>
    </div>
  </header>

  <!-- SUBHEADER -->
  <div class="topoPagina">
    <a href="./login.php" class="btnVoltar">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <h1 class="titulo">Ajuda</h1>
  </div>

  <!-- MAIN -->
  <main>
    <div class="ajuda-wrap">

      <div class="banner">
        <div class="q">?</div>
        Nesta seção, você encontra orientações para acessar sua conta, criar um novo cadastro e resolver eventuais problemas de login.
      </div>

      <div class="content">
        <!-- Coluna esquerda -->
        <div class="col">
          <h2>Acessando sua Conta</h2>
          <p class="sub">Passo a passo:</p>
          <ol>
            <li>Vá até a página de Login.</li>
            <li>Digite seu e-mail e senha cadastrados.</li>
            <li>Clique em Entrar.</li>
          </ol>
          <p class="sub">Dicas:</p>
          <ul>
            <li>Verifique se o Caps Lock está desativado.</li>
            <li>Confira se o e-mail foi digitado corretamente.</li>
            <li>Caso utilize login social (Google, Apple, etc.), verifique se está usando a mesma conta.</li>
          </ul>

          <h2>Recuperando o Acesso</h2>
          <p class="sub">Esqueci minha senha:</p>
          <ol>
            <li>Na tela de login, clique em "Esqueci minha senha".</li>
            <li>Informe o e-mail cadastrado.</li>
            <li>Siga o link enviado para redefinir sua senha.</li>
          </ol>
          <p class="sub">Não consigo acessar meu e-mail cadastrado:</p>
          <p>Entre em contato com o suporte (veja a seção "Ajuda Técnica").</p>

          <h2>Perguntas Frequentes (FAQ)</h2>
          <p class="sub">Posso usar o mesmo e-mail para mais de uma conta?</p>
          <p>Não, cada e-mail é único.</p>
          <p class="sub">Estou recebendo a mensagem "E-mail ou senha incorretos"?</p>
          <p>Verifique se o Caps Lock está desligado e se o e-mail foi digitado corretamente. Se o problema persistir, redefina a senha.</p>
        </div>

        <!-- Coluna direita -->
        <div class="col">
          <h2>Criando uma Nova Conta</h2>
          <p class="sub">Passo a passo:</p>
          <ol>
            <li>Clique em "Cadastre-se" na tela inicial.</li>
            <li>Todos os campos são obrigatórios.</li>
            <li>Aceite os Termos de Uso e Política de Privacidade.</li>
            <li>Clique em "Criar Conta".</li>
            <li>(Opcional) Confirme seu e-mail clicando no link enviado para sua caixa de entrada.</li>
          </ol>

          <h2>Contato com o Suporte</h2>
          <p>Se ainda precisar de ajuda, entre em contato conosco:</p>
          <ul>
            <li>E-mail: suporte@seudominio.com</li>
            <li>WhatsApp: (XX) XXXX-XXXX</li>
            <li>Horário de atendimento: Segunda a sexta, das 8h às 18h.</li>
          </ul>

          <p class="sub" style="margin-top:26px;">O site não reconhece meu login social. O que fazer?</p>
          <p>Verifique se está usando o mesmo provedor (Google, Apple, etc.) do cadastro inicial.</p>

          <p class="sub" style="margin-top:18px;">Como mantenho minha conta segura?</p>
          <p>Use senhas fortes, não compartilhe seus dados e habilite a autenticação em dois fatores.</p>
        </div>
      </div>

    </div>
  </main>

  <script src="./scripts/esconderHeader.js"></script>
</body>
</html>