<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedPass – Ajuda (Paciente)</title>
  <link rel="icon" type="image/png" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./styles/ajuda_paciente.css">
  <link rel="stylesheet" href="./styles/accessibility_global.css">
</head>
<body>

  <!-- TOPBAR -->
  <header id="header">
    <div class="container">
      <a href="./pgPaciente.php" class="topbar-icon">
        <i class="fa-solid fa-house btnCasa"></i>
      </a>
    </div>
    <div class="container">
      <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    </div>
    <div class="container">
      <i class="fa-solid fa-bars menu-icon" id="menuToggle"></i>
    </div>
  </header>

  <!-- SIDEBAR -->
  <nav id="sidebar">
        <div class="contSidebar">
            <h1>Joyce Ramos</h1>
        </div>

        <a href="registros.php?titulo=prontuario" class="opcao">Prontuário</a> <!-- opções do sidebar q ta no figma -->
        <a href="registros.php?titulo=cirurgia" class="opcao">Cirurgia</a>
        <a href="registros.php?titulo=exame" class="opcao">Exames</a>
        <a href="registros.php?titulo=atestado" class="opcao">Atestados/Declaração</a>
        <a href="registros.php?titulo=laudo" class="opcao">Laudo Médico</a>

        <div class="contSidebar">
            <a href="./ajuda_paciente.php" class="config">
                <h3>Ajuda</h3>
            </a>
            <a href="configuracoes.php" class="config">
                <h3>Configurações</h3>
            </a>
        </div>
    </nav>

  <!-- SUBHEADER -->
  <div class="topoPagina">
    <a href="./pgPaciente.php" class="btnVoltar">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <h1 class="titulo">Ajuda</h1>
  </div>

  <!-- MAIN -->
  <main>
    <div class="ajuda-wrap">

      <div class="banner">
        <div class="q">?</div>
        Nesta seção, você encontra orientações para usar as abas principais do aplicativo e resolver eventuais problemas.
      </div>

      <div class="content">
        <!-- Coluna esquerda -->
        <div class="col">
          <h2>Menu de Navegação (Lateral ou Superior)</h2>
          <p>Nesta tela, você visualiza seus dados pessoais e médicos principais, como:</p>
          <ul>
            <li>Nome completo</li>
            <li>CPF</li>
            <li>Altura, peso e tipo sanguíneo</li>
            <li>Idade e data de nascimento</li>
            <li>Alergias registradas</li>
            <li>Problemas de saúde ou doenças crônicas</li>
            <li>Número da carteirinha do SUS</li>
          </ul>
          <p class="tip"><b>- Dica:</b> informações marcadas em vermelho indicam alertas de saúde importantes, como condições graves.</p>

          <h2>Perguntas Frequentes (FAQ)</h2>
          <p class="sub">Posso usar o mesmo e-mail para mais de uma conta?</p>
          <p>Não, cada e-mail é único.</p>
          <p class="sub">Estou recebendo a mensagem "E-mail ou senha incorretos"?</p>
          <p>Verifique se o Caps Lock está desligado e se o e-mail foi digitado corretamente. Se o problema persistir, redefina a senha.</p>
        </div>

        <!-- Coluna direita -->
        <div class="col">
          <h2>Suporte Técnico e Contato</h2>
          <p>Se encontrar algum problema no sistema, entre em contato com o suporte:</p>
          <ul>
            <li>E-mail: suporte@medplus.com.br</li>
            <li>Telefone/WhatsApp: (XX) XXXX-XXXX</li>
            <li>Horário: Segunda a sexta, das 8h às 18h</li>
          </ul>

          <h2>Menu Lateral (&#9776;)</h2>
          <p>Para abrir o menu, toque no ícone de três linhas no canto superior direito. No menu, você encontra:</p>
          <ul>
            <li>Prontuário — visão completa dos seus registros médicos.</li>
            <li>Cirurgias — histórico de procedimentos realizados.</li>
            <li>Exames — lista de exames realizados, com datas e resultados.</li>
            <li>Atestados/Declarações — acesso rápido a documentos emitidos.</li>
            <li>Laudo Médico — relatórios e diagnósticos detalhados.</li>
            <li>Ajuda — abre esta página de suporte.</li>
            <li>Configuração — permite alterar senha, idioma ou preferências.</li>
          </ul>

          <p class="sub" style="margin-top:22px;">O site não reconhece meu login social. O que fazer?</p>
          <p>Verifique se está usando o mesmo provedor (Google, Apple, etc.) do cadastro inicial.</p>

          <p class="sub" style="margin-top:16px;">Como mantenho minha conta segura?</p>
          <p>Use senhas fortes, não compartilhe seus dados e habilite a autenticação em dois fatores.</p>
        </div>
      </div>

    </div>
  </main>

  <script src="./scripts/esconderHeader.js"></script>
  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/settings.js"></script>
</body>
</html>