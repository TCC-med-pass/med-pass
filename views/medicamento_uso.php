<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['paciente','medico']);
MedicamentoUso()
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicamentos em Uso</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="./styles/medicamento.css">
  <link rel="stylesheet" href="./styles/erros.css">
  <link rel="stylesheet" href="./scripts/medicamento-uso.js">
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Top bar -->
  <div class="topbar">
    <a href="#" class="topbar-icon"> 
      <i class="fa-solid fa-house"></i> 
    </a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-bars"></i>
    </a>
  </div>

  <!-- Sub-header -->
  <div class="subheader">
    <a href="#" class="back-btn">
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

    <!-- Adicionar novo medicamento -->
    <?php if ($_SESSION['nivel'] === 'medico'): ?>
      <button class="btn-adicionar" id="btnAdicionar">
        <i class="fa-solid fa-plus"></i> Adicionar novo medicamento
      </button>
    <?php endif; ?>

    <!-- Bottom row -->
    <div class="bottom-row">
      <div class="cards">
        <div class="card">
          <i class="fa-solid fa-phone-flip"></i>
          <span class="card-label">Contato de<br>Emergência</span>
        </div>
        <div class="card">
          <i class="fa-solid fa-file-medical"></i>
          <span class="card-label">Receita<br>Médica</span>
        </div>
        <div class="card">
          <i class="fa-solid fa-clock-rotate-left"></i>
          <span class="card-label">Histórico<br>Familiar</span>
        </div>
      </div>

      <div class="card-number">
        <p>Número da carterinha:</p>
        <span><?php echo $_SESSION['numero_carteirinha']; ?></span>
      </div>
    </div>

  </div>

  <!-- MODAL ADICIONAR -->
  <?php if ($_SESSION['nivel'] === 'medico'): ?>
    <div class="modal-overlay" id="modalOverlay">
      <div class="modal">
        <h3>Novo Medicamento</h3>
        <form id="formNovoMed" method="post" novalidate>
          <div class="modal-field">
            <label for="nome">Medicamento:</label>
            <input name="nome" type="text" id="mNome" placeholder="Nome do medicamento" required />
          </div>
          <div class="modal-field">
            <label for="dosagem">Dose:</label>
            <input name="dosagem" type="text" id="mDose" placeholder="Ex: 80 mg" required />
          </div>
          <div class="modal-field">
            <label for="frequencia">Frequência:</label>
            <input name="frequencia" type="text" id="mFreq" placeholder="Ex: 1 vez ao dia" required />
          </div>
          <div class="modal-field">
            <label for="inicio">Data de início:</label>
            <input name="inicio" type="date" id="mInicio" placeholder="DD/MM/AAAA" maxlength="10" />
          </div>
          <div class="modal-field">
            <label for="fim">Data de término:</label>
            <input name="fim" type="date" id="mFim" placeholder="DD/MM/AAAA ou 'Uso contínuo'" maxlength="10" />
          </div>
          <div class="modal-field">
            <label for="obs">Observações:</label>
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
  <?php endif; ?>
</body>
</html>