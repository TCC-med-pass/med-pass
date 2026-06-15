<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedPass – Ajuda (Médico)</title>
  <link rel="icon" type="image/png" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./styles/ajuda_medico.css">
  <link rel="stylesheet" href="./styles/accessibility_global.css">
</head>
<body>

  <!-- HEADER -->
  <header id="header">
    <div class="container">
      <a href="./pgMedico.php" class="topbar-icon">
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

  <!-- ── HAMBURGUER ── -->
  <nav id="sidebar">
    <div class="contSidebar">
      <h1>Dr. <?php echo $_SESSION['nome_medico'] ?? 'Médico'; ?></h1>
    </div>

    <a href="repositorio.php?tipo=prontuario&mensagem=prontuario" class="opcao">Prontuário</a> <!-- opções do sidebar q ta no figma -->
    <a href="repositorio.php?tipo=cirurgia&mensagem=cirurgia" class="opcao">Cirurgia</a>
    <a href="repositorio.php?tipo=exame&mensagem=exame" class="opcao">Exames</a>
    <a href="repositorio.php?tipo=atestado&mensagem=atestado" class="opcao">Atestados/Declaração</a>
    <a href="repositorio.php?tipo=laudos&mensagem=laudo" class="opcao">Laudo Médico</a>

    <div class="contSidebar">
      <a href="" class="config">
        <h3>Ajuda</h3>
      </a>
      <a href="./configuracoes.php" class="config">
        <h3>Configurações</h3>
      </a>
    </div>
  </nav>

  <!-- SUBHEADER -->
  <div class="topoPagina">
    <a href="./pgMedico.php" class="btnVoltar">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <h1 class="titulo">Ajuda</h1>
  </div>

  <!-- MAIN -->
  <main>
    <div class="ajuda-wrap">

      <div class="banner">
        <div class="q">?</div>
        Nesta seção, você encontra orientações para usar as abas principais do aplicativo médico e resolver eventuais problemas.
      </div>

      <div class="content">
        <!-- Coluna esquerda -->
        <div class="col">
          <h2>Menu de Navegação (Lateral ou Superior)</h2>
          <p>Nesta tela, você visualiza e gerencia informações essenciais da sua prática médica, como:</p>
          <ul>
            <li>Agenda de atendimentos</li>
            <li>Lista de pacientes cadastrados</li>
            <li>Histórico clínico e prontuários</li>
            <li>Resultados de exames enviados pelos pacientes</li>
            <li>Atestados e prescrições emitidas</li>
            <li>Notificações importantes (ex.: resultados críticos, solicitações pendentes)</li>
          </ul>
          <p class="tip"><b>&ndash; Dica:</b> itens marcados em vermelho indicam ações urgentes, como pendências de assinatura digital ou atualizações obrigatórias.</p>

          <h2>Perguntas Frequentes (FAQ)</h2>
          <p class="sub">Posso acessar o sistema em mais de um dispositivo?</p>
          <p>Sim, desde que utilize o mesmo login médico.</p>
          <p class="sub">Estou recebendo a mensagem "Usuário não autorizado". O que fazer?</p>
          <p>Verifique se sua conta está ativa junto à administração da unidade. Se persistir, entre em contato com o suporte.</p>
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

          <h2>Menu de Navegação (Lateral ou Superior)</h2>
          <p>Para abrir o menu, toque no ícone de três linhas (&#9776;) no canto superior direito.</p>
          <p>No menu, você encontra:</p>
          <ul>
            <li>Prontuários &ndash; Histórico resumido dos atendimentos e anotações médicas.</li>
            <li>Laudos &ndash; Relatórios e diagnósticos emitidos para o paciente.</li>
            <li>Exames / Cirurgias &ndash; Lista de exames realizados e procedimentos cirúrgicos.</li>
            <li>Receitas / Medicamentos &ndash; Prescrições emitidas e medicamentos em uso.</li>
            <li>Atestados &ndash; Atestados anteriores e emissão de novos documentos.</li>
          </ul>

          <p class="sub" style="margin-top:22px;">Não consigo visualizar um prontuário. Por quê?</p>
          <p>Algumas informações podem ser restritas conforme o nível de permissão da unidade. Verifique com a administração.</p>
        </div>
      </div>
    </div>
  </main>

  <script src="./scripts/esconderHeader.js"></script>
  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/settings.js"></script>
</body>
</html>
