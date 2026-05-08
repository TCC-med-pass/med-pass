<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Problemas de Saúde</title>
  <link rel="stylesheet" href="../Problemas_saude/problemas_saude.css">
  <link rel="icon" type="image/png" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
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
    <span class="subheader-title">Problemas de Saúde</span>
    <div class="subheader-spacer"></div>
  </div>

  <!-- Main content -->
  <div class="content">

    <!-- Table -->
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
        <tr>
          <td>Câncer de pulmão</td>
          <td>Ativo</td>
          <td>Oncológico</td>
          <td>12/03/2023</td>
          <td class="td-acoes">
            <button class="btn-editar" onclick="abrirEdicao(this)" title="Editar"><i class="fa-solid fa-pen"></i></button>
          </td>
        </tr>
        <tr>
          <td>Diabetes tipo 2</td>
          <td>Controlado</td>
          <td>Metabólico</td>
          <td>05/07/2019</td>
          <td class="td-acoes">
            <button class="btn-editar" onclick="abrirEdicao(this)" title="Editar"><i class="fa-solid fa-pen"></i></button>
          </td>
        </tr>
        <tr>
          <td>Hipertensão arterial</td>
          <td>Controlado</td>
          <td>Cardiovascular</td>
          <td>14/01/2017</td>
          <td class="td-acoes">
            <button class="btn-editar" onclick="abrirEdicao(this)" title="Editar"><i class="fa-solid fa-pen"></i></button>
          </td>
        </tr>
        <tr>
          <td>Neuropatia periférica</td>
          <td>Em acompanhamento</td>
          <td>Neurológico</td>
          <td>20/09/2024</td>
          <td class="td-acoes">
            <button class="btn-editar" onclick="abrirEdicao(this)" title="Editar"><i class="fa-solid fa-pen"></i></button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Adicionar novo problema -->
    <button class="btn-adicionar" id="btnAdicionar">
      <i class="fa-solid fa-plus"></i> Adicionar problema de saúde
    </button>

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
        <span>12345678-0</span>
      </div>
    </div>

  </div>

  <!-- MODAL ADICIONAR -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal">
      <h3 id="modalTitulo">Novo Problema de Saúde</h3>
      <form id="formNovo" novalidate>
        <div class="modal-field">
          <label for="mNome">Nome:</label>
          <input type="text" id="mNome" placeholder="Nome do problema de saúde" required />
        </div>
        <div class="modal-field">
          <label for="mStatus">Status:</label>
          <input type="text" id="mStatus" placeholder="Ex: Ativo, Controlado..." required />
        </div>
        <div class="modal-field">
          <label for="mTipo">Tipo:</label>
          <input type="text" id="mTipo" placeholder="Ex: Oncológico, Metabólico..." required />
        </div>
        <div class="modal-field">
          <label for="mData">Data:</label>
          <input type="text" id="mData" placeholder="DD/MM/AAAA" maxlength="10" />
        </div>
        <div class="modal-btns">
          <button type="button" id="btnFecharModal">Cancelar</button>
          <button type="submit">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Máscara data
    function mascaraData(input) {
      input.addEventListener('input', () => {
        let v = input.value.replace(/\D/g, '').slice(0, 8);
        if (v.length > 4) v = v.replace(/(\d{2})(\d{2})(\d{0,4})/, '$1/$2/$3');
        else if (v.length > 2) v = v.replace(/(\d{2})(\d{0,2})/, '$1/$2');
        input.value = v;
      });
    }
    mascaraData(document.getElementById('mData'));

    // Modal
    const overlay = document.getElementById('modalOverlay');
    const titulo  = document.getElementById('modalTitulo');
    let linhaEditando = null;

    document.getElementById('btnAdicionar').addEventListener('click', () => {
      titulo.textContent = 'Novo Problema de Saúde';
      linhaEditando = null;
      limparForm();
      overlay.classList.add('active');
    });

    document.getElementById('btnFecharModal').addEventListener('click', () => {
      overlay.classList.remove('active');
    });

    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) overlay.classList.remove('active');
    });

    function abrirEdicao(btn) {
      const tr = btn.closest('tr');
      const tds = tr.querySelectorAll('td');
      titulo.textContent = 'Editar Problema de Saúde';
      linhaEditando = tr;
      document.getElementById('mNome').value   = tds[0].textContent.trim();
      document.getElementById('mStatus').value = tds[1].textContent.trim();
      document.getElementById('mTipo').value   = tds[2].textContent.trim();
      document.getElementById('mData').value   = tds[3].textContent.trim();
      overlay.classList.add('active');
    }

    document.getElementById('formNovo').addEventListener('submit', (e) => {
      e.preventDefault();
      const nome   = document.getElementById('mNome').value.trim();
      const status = document.getElementById('mStatus').value.trim();
      const tipo   = document.getElementById('mTipo').value.trim();
      const data   = document.getElementById('mData').value.trim();

      if (!nome || !status || !tipo) return;

      if (linhaEditando) {
        const tds = linhaEditando.querySelectorAll('td');
        tds[0].textContent = nome;
        tds[1].textContent = status;
        tds[2].textContent = tipo;
        tds[3].textContent = data;
      } else {
        const tbody = document.getElementById('corpoTabela');
        const idx   = tbody.rows.length;
        const tr    = document.createElement('tr');
        tr.innerHTML = `
          <td>${nome}</td>
          <td>${status}</td>
          <td>${tipo}</td>
          <td>${data}</td>
          <td class="td-acoes">
            <button class="btn-editar" onclick="abrirEdicao(this)" title="Editar"><i class="fa-solid fa-pen"></i></button>
          </td>`;
        tbody.appendChild(tr);
      }

      overlay.classList.remove('active');
      limparForm();
    });

    function limparForm() {
      ['mNome','mStatus','mTipo','mData'].forEach(id => document.getElementById(id).value = '');
    }
  </script>
</body>
</html>