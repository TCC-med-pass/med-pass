  <?php
  require_once '../controllers/UserControll.php';
  require_once './components/UserComponents.php';

  $nomePaciente = showNome();
  ?>
  <!DOCTYPE html>
  <html lang="pt-BR">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./styles/receitas.css?v=8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />    
    <title>MedPass- Receitas Médicas</title>
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
        <h1><?php echo $nomePaciente ?></h1>
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
      <a href="pgPaciente.php" class="btnVoltar">
        <i class="fa-solid fa-chevron-left"></i> Voltar
      </a>
      <h1 class="titulo">Receitas médicas</h1>
    </div>

    <main>
      <div class="cards-grid">
        <?php showReceitas() ?>
      </div>

      <div class="nav-cards">
        <a href="medicamento_uso.php" class="nav-card">Medicamentos em Uso</a>
        <a href="historicoFamiliar.php" class="nav-card">Histórico Familiar</a>
      </div>

      <div class="carteirinha" id="carteirinha">
        <p>Número da carteirinha:</p>
        <span><?php echo $_SESSION['numero_carteirinha'] ?></span>
      </div>
    </main>

    <script src="./scripts/sidebar.js"></script>
    <script src="./scripts/esconderHeader.js"></script>
  </body>
  </html>