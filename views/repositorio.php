<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['medico']);
$mensagem = $_GET['mensagem'];
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedPass – <?= $mensagem ?></title>
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./styles/accessibility_global.css">
  <link rel="stylesheet" href="./styles/repositorio.css?v=3"/>
 
 
 
</head>
<body>


<!-- TOP BAR -->
  <div class="topbar">
    <a href="./medPaciente.php" class="topbar-icon">
      <i class="fa-solid fa-house"></i>
    </a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <div class="topbar-icon menu-icon">
    <i class="fa-solid fa-bars"></i>
</div>
  </div>


<!-- SUBHEADER -->
<div class="subheader">
  <a class="back-btn" href="./medPaciente.php">
    <i class="fa-solid fa-chevron-left"></i> Voltar
  </a>
  <div class="subheader-title"><?= $mensagem ?></div>
  <div class="subheader-spacer"></div>
</div>


<!-- MAIN CONTENT -->
<main>
  <div class="cards-grid">
    <?php mensagemErro(); ?>
    <?php mensagemSucesso(); ?>


    <?php showRepositorio(); ?>


    <!-- ── PATIENT BADGE ── -->
  <div class="patient-badge">
    <div class="badge-label">Paciente:</div>
    <div class="badge-name"><?php echo $_SESSION['nome_paciente'] ?? 'paciente'; ?></div>
    <div class="badge-severity">Comorbidade: <b class="<?php echo $_SESSION['comorbidades']; ?>"><?php echo $_SESSION['comorbidades'] ?? 'desconhecida'; ?></b></div>
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
  <script src="./scripts/sidebar.js"></script>
<script src="./scripts/settings.js"></script>
</body>
</html>
