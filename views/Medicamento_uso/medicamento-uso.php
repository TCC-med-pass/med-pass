<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Medicamentos em Uso</title>
  <link rel="stylesheet" href="./medicamento-uso.css">
  <link rel="stylesheet" href="./medicamento-uso.js">
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

    <!-- Table -->
    <table class="med-table">
      <thead>
        <tr>
          <th>Medicamento</th>
          <th>Dose</th>
          <th>Frequência</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="corpoTabela">
        <tr>
          <td>Osimertinib (Tagrisso)</td>
          <td>80 mg</td>
          <td>1 Comprimido, uma vez ao dia (Diário)</td>
          <td class="td-acoes">
            <a href="medicamento_detalhe.html?id=0" class="tag-abrir">abrir</a>
            <button class="btn-lixeira" onclick="removerLinha(this)" title="Remover"><i class="fa-solid fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>Pemetrexede</td>
          <td>500 mg/m²</td>
          <td>A cada 21 dias</td>
          <td class="td-acoes">
            <a href="medicamento_detalhe.html?id=1" class="tag-abrir">abrir</a>
            <button class="btn-lixeira" onclick="removerLinha(this)" title="Remover"><i class="fa-solid fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>Insulina Glargina (Lantus)</td>
          <td>14 unidades</td>
          <td>1 Vez ao dia</td>
          <td class="td-acoes">
            <a href="medicamento_detalhe.html?id=2" class="tag-abrir">abrir</a>
            <button class="btn-lixeira" onclick="removerLinha(this)" title="Remover"><i class="fa-solid fa-trash"></i></button>
          </td>
        </tr>
        <tr>
          <td>Insulina Asparte (Novorapid)</td>
          <td>Variável, calculada por bomba</td>
          <td>1U a cada 10g de Carboidrato</td>
          <td class="td-acoes">
            <a href="medicamento_detalhe.html?id=3" class="tag-abrir">abrir</a>
            <button class="btn-lixeira" onclick="removerLinha(this)" title="Remover"><i class="fa-solid fa-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Adicionar novo medicamento -->
    <button class="btn-adicionar" id="btnAdicionar">
      <i class="fa-solid fa-plus"></i> Adicionar novo medicamento
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
      <h3>Novo Medicamento</h3>
      <form id="formNovoMed" novalidate>
        <div class="modal-field">
          <label for="mNome">Medicamento:</label>
          <input type="text" id="mNome" placeholder="Nome do medicamento" required />
        </div>
        <div class="modal-field">
          <label for="mDose">Dose:</label>
          <input type="text" id="mDose" placeholder="Ex: 80 mg" required />
        </div>
        <div class="modal-field">
          <label for="mFreq">Frequência:</label>
          <input type="text" id="mFreq" placeholder="Ex: 1 vez ao dia" required />
        </div>
        <div class="modal-field">
          <label for="mInicio">Data de início:</label>
          <input type="text" id="mInicio" placeholder="DD/MM/AAAA" maxlength="10" />
        </div>
        <div class="modal-field">
          <label for="mFim">Data de término:</label>
          <input type="text" id="mFim" placeholder="DD/MM/AAAA ou 'Uso contínuo'" maxlength="10" />
        </div>
        <div class="modal-field">
          <label for="mObs">Observações:</label>
          <textarea id="mObs" rows="3" placeholder="Informações adicionais"></textarea>
        </div>
        <div class="modal-btns">
          <button type="button" id="btnFecharModal">Cancelar</button>
          <button type="submit">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <script src="medicamento-uso.js"></script>
</body>
</html>