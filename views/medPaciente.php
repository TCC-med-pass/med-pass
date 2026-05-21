<?php
require_once '../controllers/UserControll.php';

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
</head>

<body>

  <!-- ── HEADER ── -->
  <header id="header">
    <div class="container">
      <a href="#">
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

          <form method="post"> <!-- Precisa fazer com o que estivar em branco não fique em branco no banco -->
            <input type="number" placeholder="Insira o n° de carteirinha do Paciente" aria-label="Insira o número de carteirinha do Paciente">
            <input type="number" placeholder="Insira a altura do Paciente (ex: 1.70)" step="0.01" min="1" max="2.72" lang="en" value="" aria-label="Insira a altura do Paciente (ex: 1.70)">
            <input type="number" placeholder="Insira o peso do Paciente em Kg (Ex: 70)" step="0.01" min="2" max="300" lang="en" value="" aria-label="Insira o peso do Paciente em Kg (Ex: 70)">
            <input type="text" placeholder="Insira as alergias do Paciente" value="" aria-label="Insira as alergias do Paciente"><!-- puxar as Informações de antes pelo banco e colocar no value com echo pra ficar mais agradável se conseguir :) -->
            <button type="submit" class="salvar">Salvar</button>
          </form>
        </div>
      </div>

    </div>
  </main>

  <!-- ── HAMBURGUER ── -->
  <nav id="sidebar">
    <div class="contSidebar">
      <h1>Medico</h1>
    </div>

    <a href="registros.php?titulo=prontuario" class="opcao">Prontuário</a> <!-- opções do sidebar q ta no figma -->
    <a href="registros.php?titulo=cirurgia" class="opcao">Cirurgia</a>
    <a href="registros.php?titulo=exame" class="opcao">Exames</a>
    <a href="registros.php?titulo=atestado" class="opcao">Atestados/Declaração</a>
    <a href="registros.php?titulo=laudo" class="opcao">Laudo Médico</a>

    <div class="contSidebar">
      <a href="" class="config">
        <h3>Ajuda</h3>
      </a>
      <a href="" class="config">
        <h3>Configurações</h3>
      </a>
    </div>
  </nav>

  <!-- ── PATIENT BADGE ── -->
  <div class="patient-badge" id="carteirinha">
    <div class="badge-label">Paciente:</div>
    <div class="badge-name"><?php echo $_SESSION['nome_paciente'] ?? 'paciente'; ?></div>
    <div class="badge-severity">Comorbidade <?php echo $_SESSION['comorbidades'] ?? 'desconhecida'; ?></div>
  </div>

  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/popupMedico.js"></script>
</body>

</html>