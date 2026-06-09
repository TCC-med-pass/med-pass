<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['paciente','medico']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalhe do Medicamento – MedPass</title>
  <link rel="stylesheet" href="./styles/receitas.css?v=8">
  <link rel="stylesheet" href="./styles/informacaoMedicamento.css?v=8">
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="./styles/accessibility_global.css">
  <link rel="stylesheet" href="./styles/fontes.css">
</head>
<body>

  <header id="header">
    <div class="container">
      <a href="pgPaciente.php">
        <i class="fa-solid fa-house btnCasa"></i>
      </a>
    </div>
    <div class="container">
      <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    </div>
    <div class="container">
      <i class="fa-solid fa-bars menu-icon"></i>
    </div>
  </header>

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

  <div class="topoPagina">
    <a href="medicamento_uso.php" class="btnVoltar">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <h1 class="titulo">Detalhes do Medicamento</h1>
  </div>

  <main>
    <div class="detalhe-card">
      <?php showInformacaoMedicamentoUso(); ?>
    </div>
  </main>

  <script src="./scripts/sidebar.js"></script>

</body>
<script src="./scripts/settings.js"></script>
</html>