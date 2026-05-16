<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['medico']);
problemaSaude();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Problemas de Saúde</title>

  <link rel="stylesheet" href="./styles/problemas_saude.css">

  <link rel="icon" type="image/png"
    href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <!-- TOPBAR -->
  <div class="topbar">

    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-house"></i>
    </a>

    <img
      src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png"
      alt="Logo MedPass"
      class="logo-img" />

    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-bars"></i>
    </a>

  </div>

  <!-- SUBHEADER -->
  <div class="subheader">

    <a href="#" class="back-btn">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>

    <span class="subheader-title">
      Problemas de Saúde
    </span>

    <div class="subheader-spacer"></div>

  </div>

  <!-- CONTEÚDO -->
  <div class="content">

    <!-- TABELA -->
    <table class="med-table">

      <thead>
        <tr>
          <th>Nome</th>
          <th>Status</th>
          <th>Tipo</th>
          <th>Data</th>
          <th></th>
        </tr>
      </thead>

      <tbody id="corpoTabela">

        <!-- EXEMPLO -->
        <?php showProblemaSaude(); ?>

      </tbody>

    </table>

    <!-- BOTÃO -->
    <button class="btn-adicionar" id="btnAdicionar">

      <i class="fa-solid fa-plus"></i>
      Adicionar problema de saúde

    </button>

  </div>

  <!-- MODAL -->
  <div class="modal-overlay" id="modalOverlay">

    <div class="modal">

      <h3 id="modalTitulo">
        Novo Problema de Saúde
      </h3>

      <form id="formNovo" method="POST">

        <!-- DEFINE SE É ADICIONAR OU EDITAR -->
        <input type="hidden" name="modelo" id="modelo">

        <!-- ID -->
        <input type="hidden" name="id" id="mId">

        <div class="modal-field">

          <label for="nome">Nome:</label>

          <input
            type="text"
            name="nome"
            id="mNome"
            placeholder="Nome do problema de saúde"
            required>

        </div>

        <div class="modal-field">

          <label for="status">Status:</label>

          <input
            type="text"
            name="status"
            id="mStatus"
            placeholder="Ex: Ativo"
            required>

        </div>

        <div class="modal-field">

          <label for="mTipo">Tipo:</label>

          <select
            type="text"
            name="tipo"
            id="mTipo"
            placeholder="Ex: Oncológico"
            required>
            <option value="" disabled selected>Selecione o tipo</option>
            <option value="leve">Leve</option>
            <option value="medio">Médio</option>
            <option value="grave">Grave</option>
            </select>

        </div>


        <div class="modal-btns">

          <button
            type="button"
            id="btnFecharModal">

            Cancelar

          </button>

          <button type="submit">
            Salvar
          </button>

        </div>

      </form>

    </div>

  </div>

  <script>
  const overlay = document.getElementById('modalOverlay');
  const titulo  = document.getElementById('modalTitulo');

  // ABRIR MODAL ADICIONAR
  document.getElementById('btnAdicionar').addEventListener('click', () => {
    titulo.textContent = 'Novo Problema de Saúde';
    document.getElementById('modelo').value = 'adicionar';
    document.getElementById('mId').value    = '';
    limparForm();
    overlay.classList.add('active');
  });

  // FECHAR MODAL
  document.getElementById('btnFecharModal').addEventListener('click', () => {
    overlay.classList.remove('active');
  });

  // FECHAR CLICANDO FORA
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('active');
  });

  // EDITAR
  function abrirEdicao(btn) {
    const tr  = btn.closest('tr');
    const tds = tr.querySelectorAll('td');

    titulo.textContent = 'Editar Problema de Saúde';
    document.getElementById('modelo').value = 'editar';
    document.getElementById('mId').value    = tr.dataset.id;  // ← linha adicionada

    document.getElementById('mNome').value   = tds[0].textContent.trim();
    document.getElementById('mStatus').value = tds[1].textContent.trim();
    document.getElementById('mTipo').value   = tds[2].textContent.trim();

    overlay.classList.add('active');
  }

  // LIMPAR FORM
  function limparForm() {
    document.getElementById('mNome').value   = '';
    document.getElementById('mStatus').value = '';
    document.getElementById('mTipo').value   = '';
  }
</script>

</body>

</html>