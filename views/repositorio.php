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
  <link rel="stylesheet" href="./styles/repositorio.css"/>
  <link rel="stylesheet" href="./styles/erros.css">
  <link rel="stylesheet" href="./styles/accessibility_global.css">
</head>
<body>

<!-- TOP BAR -->
  <div class="topbar">
    <a href="./medPaciente.php" class="topbar-icon">
      <i class="fa-solid fa-house"></i>
    </a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-bars"></i>
    </a>
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
    <div class="badge-severity">Comorbidade <?php echo $_SESSION['comorbidades'] ?? 'desconhecida'; ?></div>
  </div>

  </div>  

</div>
</main>
<script src="./scripts/settings.js"></script>
</body>
</html>