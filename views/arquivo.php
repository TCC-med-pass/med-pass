<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
$titulo = ucwords($_GET['tipo']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titulo ?> - MedPass</title>
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./styles/arquivo.css?v=3">
  <link rel="stylesheet" href="./styles/receitas.css?v=8">
</head>

<body>

  <!-- TOP BAR -->
  <div class="topbar">
    <a href="pgPaciente.php" class="topbar-icon">
      <i class="fa-solid fa-house"></i>
    </a>
    <div class="topbar-center">
      <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    </div>
    <span class="topbar-icon" style="cursor:pointer">
      <i class="fa-solid fa-bars menu-icon"></i>
    </span>
  </div>

  <!-- SUBHEADER -->
  <div class="subheader">
    <a class="back-btn" onclick="history.back()">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <div class="subheader-title"><?= $titulo ?></div>
    <div class="subheader-spacer"></div>
  </div>

  <main>
    <div class="doc-wrapper">
      <div class="upload-zone">
        <?php arquivoIframe(); ?>
      </div>
    </div>

    <div class="nav-number-badge">
      <p>Número da carteirinha:</p>
      <span><?php if (isset($_SESSION['numeroCarteirinha'])) {
              echo $_SESSION['numeroCarteirinha'];
            } elseif (isset($_SESSION['numero_carteirinha'])) {
              echo $_SESSION['numero_carteirinha'];
            } ?></span>
    </div>
  </main>

  <!-- SIDEBAR -->
<nav id="sidebar">
  <div class="contSidebar">
    <h1><?php echo showNome() ?></h1>
  </div>
  <a href="registros.php?titulo=prontuario" class="opcao">Prontuário</a>
  <a href="registros.php?titulo=cirurgia" class="opcao">Cirurgia</a>
  <a href="registros.php?titulo=exame" class="opcao">Exames</a>
  <a href="registros.php?titulo=atestado" class="opcao">Atestados/Declaração</a>
  <a href="registros.php?titulo=laudo" class="opcao">Laudo Médico</a>
  <div class="contSidebar">
    <a href="" class="config"><h3>Ajuda</h3></a>
    <a href="" class="config"><h3>Configurações</h3></a>
  </div>
</nav>

  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/esconderHeader.js"></script>
</body>
</html>