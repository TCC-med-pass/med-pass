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
    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-bars"></i>
    </a>
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

</body>
</html>