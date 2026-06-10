<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['paciente', 'medico']);
MedicamentoUso();
$link = showLinkNav();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicamentos em Uso</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="./styles/medicamento.css">
  <link rel="stylesheet" href="./styles/erros.css">
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="./styles/accessibility_global.css">  
</head>

<body>

  <header id="header">
    <div class="container">
      <a href="login.php">
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

  <nav id="sidebar">
    <div class="contSidebar">
      <h1>
        <?php
          if ($_SESSION['nivel'] === 'paciente') {
            echo showNome();
          } elseif ($_SESSION['nivel'] === 'medico') {
            echo "Dr. " . $_SESSION['nome_medico'];
          }
        ?>
      </h1>
    </div>
    <a href="<?= $link['prontuario']; ?>" class="opcao">Prontuário</a>
    <a href="<?= $link['cirurgia']; ?>" class="opcao">Cirurgia</a>
    <a href="<?= $link['exame']; ?>" class="opcao">Exames</a>
    <a href="<?= $link['atestado']; ?>" class="opcao">Atestados/Declaração</a>
    <a href="<?= $link['laudo']; ?>" class="opcao">Laudo Médico</a>
    <div class="contSidebar">
      <a href="" class="config"><h3>Ajuda</h3></a>
      <a href="" class="config"><h3>Configurações</h3></a>
    </div>
  </nav>

  <!-- Sub-header -->
  <div class="subheader">
    <a href="login.php" class="back-btn">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <span class="subheader-title">Medicamentos em Uso</span>
    <div class="subheader-spacer"></div>
  </div>

  <!-- Main content -->
  <div class="content">
    <?php mensagemErro(); ?>
    <?php mensagemSucesso(); ?>

    <!-- Table -->
    <table class="med-table">
      <thead>
        <tr>
          <th>Medicamento</th>
          <th>Dose</th>
          <th>Frequência</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="corpoTabela">
        <?php showMedicamento() ?>
      </tbody>
    </table>

    <!-- Adicionar novo medicamento (só médico) -->
    <?php if ($_SESSION['nivel'] === 'medico'): ?>
      <button class="btn-adicionar" id="btnAdicionar">
        <i class="fa-solid fa-plus"></i> Adicionar novo medicamento
      </button>
    <?php endif; ?>
    
    <!-- Bottom-row -->
   <div class="content">
  <!-- tabela -->
  <div class="bottom-row">
    <div class="nav-cards">
      <a href="receitas_medicas.php" class="nav-card">Receita Médica</a>
      <a href="historicoFamiliar.php" class="nav-card">Histórico Familiar</a>
    </div>
  </div>
</div>

<div class="carteirinha" id="carteirinha">
  <p>Número da carteirinha:</p>
  <span>
    <?php
      if (isset($_SESSION['numeroCarteirinha'])) {
        echo $_SESSION['numeroCarteirinha'];
      } elseif (isset($_SESSION['numero_carteirinha'])) {
        echo $_SESSION['numero_carteirinha'];
      }
    ?>
  </span>
</div>

  <!-- MODAL ADICIONAR (só médico) -->
  <?php if ($_SESSION['nivel'] === 'medico'): ?>
    <div class="modal-overlay" id="modalOverlay">
      <div class="modal">
        <h3>Novo Medicamento</h3>
        <form id="formNovoMed" method="post" novalidate>
          <div class="modal-field">
            <label for="mNome">Medicamento:</label>
            <input name="nome" type="text" id="mNome" placeholder="Nome do medicamento" required />
          </div>
          <div class="modal-field">
            <label for="mDose">Dose:</label>
            <input name="dosagem" type="text" id="mDose" placeholder="Ex: 80 mg" required />
          </div>
          <div class="modal-field">
            <label for="mFreq">Frequência:</label>
            <input name="frequencia" type="text" id="mFreq" placeholder="Ex: 1 vez ao dia" required />
          </div>
          <div class="modal-field">
            <label for="mInicio">Data de início:</label>
            <input name="inicio" type="date" id="mInicio" maxlength="10" />
          </div>
          <div class="modal-field">
            <label for="mFim">Data de término:</label>
            <input name="fim" type="date" id="mFim" maxlength="10" />
          </div>
          <div class="modal-field">
            <label for="mObs">Observações:</label>
            <textarea name="obs" id="mObs" rows="3" placeholder="Informações adicionais"></textarea>
          </div>
          <div class="modal-btns">
            <button type="button" id="btnFecharModal">Cancelar</button>
            <button type="submit">Salvar</button>
          </div>
        </form>
      </div>
    </div>
    <script src="./scripts/medicamento-uso.js"></script>
    <script src="./scripts/esconderHeader.js"></script>
    <script src="./scripts/sidebar.js"></script>
    <script src="./scripts/settings.js"></script>
  <?php endif; ?>

  <!-- Scripts sempre carregados, FORA do if medico -->
  <script src="./scripts/esconderHeader.js"></script>
  <script>
    // Sidebar toggle — inline para garantir funcionamento independente do nível
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');

    menuToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      sidebar.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
      if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
        sidebar.classList.remove('active');
      }
    });
  </script>

</body>
</html>