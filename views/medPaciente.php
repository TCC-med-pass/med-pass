<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
dadosPaciente();
sessionPaciente();
verificarTipo(['medico']);


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Criar novo</title>

  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./styles/medpaciente.css">
  <link rel="stylesheet" href="./styles/erros.css">
  <link rel="stylesheet" href="./styles/accessibility_global.css">
</head>

<body>

  <!-- ── HEADER ── -->
  <header id="header">
    <div class="container">
      <a href="pgMedico.php">
        <i class="fa-solid fa-house btnCasa"></i>
      </a>
    </div>
    <div class="container">
      <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass">
    </div>
    <div class="container">
      <!--Menu hamburguer-->
      <i class="fa-solid fa-bars menu-icon"></i>
    </div>
  </header>

  <!-- ── SUBHEADER / VOLTAR ── -->
  <div class="subheader">
    <a class="back-btn" href="./pgMedico.php">
      <svg viewBox="0 0 24 24">
        <polyline points="15 18 9 12 15 6" />
      </svg>
      Voltar
    </a>
    <span class="subheader-title">Criar novo....</span>
  </div>
  <?php mensagemErro() ?>
  <?php mensagemSucesso() ?>

  <!-- ── MAIN ── -->
  <main>

    <div class="action-grid">


      <!-- Adicionar Documento -->
      <a class="action-card" href="adicionarDocumento.php">
        <span class="action-plus">+</span>
        <span class="action-label">Adicionar<br>Documento</span>
      </a>

      <!-- Adicionar Medicamento em uso -->
      <a class="action-card" href="medicamento_uso.php">
        <span class="action-plus">+</span>
        <span class="action-label">Adicionar<br>Medicamento em<br>uso</span>
      </a>

      <a class="action-card" href="problema_saude.php">
        <span class="action-plus">+</span>
        <span class="action-label">Adicionar<br>Problema de Saúde</span>
      </a>

      <button class="action-card" id="btnInfo">
        <span class="action-plus">✎</span>
        <span class="action-label">Editar<br>Informações do Paciente</span>
      </button>


      <div class="modal" id="popup">
        <div class="modalConteudo">
          <button class="fecharInfo" id="fecharInfo" aria-label="Fechar popup">
            <i class="fa-solid fa-x"></i>
          </button>

          <h2>Editar Informações do Paciente</h2>
          
          <?php showDadosPaciente() ?>
        </div>
      </div>

    </div>
  </main>

  <!-- ── HAMBURGUER ── -->
  <nav id="sidebar">
    <div class="contSidebar">
      <h1>Dr. <?php echo $_SESSION['nome_medico'] ?? 'Médico'; ?></h1>
    </div>

    <a href="repositorio.php?tipo=prontuario&mensagem=prontuario" class="opcao">Prontuário</a> <!-- opções do sidebar q ta no figma -->
    <a href="repositorio.php?tipo=cirurgia&mensagem=cirurgia" class="opcao">Cirurgia</a>
    <a href="repositorio.php?tipo=exame&mensagem=exame" class="opcao">Exames</a>
    <a href="repositorio.php?tipo=atestado&mensagem=atestado" class="opcao">Atestados/Declaração</a>
    <a href="repositorio.php?tipo=laudo&mensagem=laudo" class="opcao">Laudo Médico</a>

    <div class="contSidebar">
      <a href="./ajuda_medico.php" class="config">
        <h3>Ajuda</h3>
      </a>
      <a href="./configuracoes.php" class="config">
        <h3>Configurações</h3>
      </a>
    </div>
  </nav>

  <!-- ── PATIENT BADGE ── -->
  <div class="patient-badge" id="carteirinha">
    <div class="badge-label">Paciente:</div>
    <div class="badge-name"><?php echo $_SESSION['nome_paciente'] ?? 'paciente'; ?></div>
    <div class="badge-severity">Comorbidade <b class="<?php echo $_SESSION['comorbidades']; ?>"><?php echo $_SESSION['comorbidades'] ?? 'desconhecida'; ?></b></div>
  </div>

  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/popupMedico.js"></script>
  <script src="./scripts/settings.js"></script>
</body>

</html>