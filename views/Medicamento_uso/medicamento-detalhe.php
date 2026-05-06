<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalhe do Medicamento – MedPass</title>
  <link rel="stylesheet" href="./medicamento-uso.css">
  <link rel="stylesheet" href="./medicamento_uso_extra.css">
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Top bar -->
  <div class="topbar">
    <a href="#" class="topbar-icon"><i class="fa-solid fa-house"></i></a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <a href="#" class="topbar-icon"><i class="fa-solid fa-bars"></i></a>
  </div>

  <!-- Sub-header -->
  <div class="subheader">
    <a href="medicamento_uso.html" class="back-btn">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <span class="subheader-title" id="det-titulo">Detalhes do Medicamento</span>
    <div class="subheader-spacer"></div>
  </div>

  <!-- Main content -->
  <div class="content" style="gap: 24px;">

    <div class="detalhe-card">
      <div class="detalhe-header">
        <i class="fa-solid fa-pills"></i>
        <h2 id="det-nome">—</h2>
      </div>
      <div class="detalhe-grid">
        <div class="detalhe-item">
          <span class="detalhe-label"><i class="fa-solid fa-syringe"></i> Dose</span>
          <span class="detalhe-valor" id="det-dose">—</span>
        </div>
        <div class="detalhe-item">
          <span class="detalhe-label"><i class="fa-solid fa-clock"></i> Frequência</span>
          <span class="detalhe-valor" id="det-freq">—</span>
        </div>
        <div class="detalhe-item">
          <span class="detalhe-label"><i class="fa-solid fa-calendar-day"></i> Data de início</span>
          <span class="detalhe-valor" id="det-inicio">—</span>
        </div>
        <div class="detalhe-item">
          <span class="detalhe-label"><i class="fa-solid fa-calendar-xmark"></i> Data de término</span>
          <span class="detalhe-valor" id="det-fim">—</span>
        </div>
        <div class="detalhe-item">
          <span class="detalhe-label"><i class="fa-solid fa-user-doctor"></i> Médico responsável</span>
          <span class="detalhe-valor" id="det-medico">—</span>
        </div>
        <div class="detalhe-item detalhe-full">
          <span class="detalhe-label"><i class="fa-solid fa-file-lines"></i> Observações</span>
          <span class="detalhe-valor" id="det-obs">—</span>
        </div>
      </div>
    </div>

  </div>

  <script>
    const params = new URLSearchParams(window.location.search);
    const idParam = params.get('id');

    let lista = [];
    try { lista = JSON.parse(sessionStorage.getItem('medPass_meds')) || []; } catch(e) {}

    const med = lista.find(m => String(m.id) === String(idParam));

    if (med) {
      document.getElementById('det-titulo').textContent = med.nome;
      document.getElementById('det-nome').textContent   = med.nome;
      document.getElementById('det-dose').textContent   = med.dose;
      document.getElementById('det-freq').textContent   = med.freq;
      document.getElementById('det-inicio').textContent = med.inicio;
      document.getElementById('det-fim').textContent    = med.fim;
      document.getElementById('det-medico').textContent = med.medico;
      document.getElementById('det-obs').textContent    = med.obs;
    }
  </script>

  <style>
    .detalhe-card {
      background: #fff;
      border: 2px solid var(--teal);
      border-radius: 14px;
      overflow: hidden;
    }
    .detalhe-header {
      background: var(--teal);
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 20px 24px;
      color: #fff;
    }
    .detalhe-header i { font-size: 26px; }
    .detalhe-header h2 { font-size: 20px; font-weight: 800; }
    .detalhe-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }
    .detalhe-item {
      display: flex;
      flex-direction: column;
      gap: 6px;
      padding: 18px 22px;
      border-bottom: 1px solid #eee;
      border-right: 1px solid #eee;
    }
    .detalhe-item:nth-child(even) { border-right: none; }
    .detalhe-item:nth-last-child(-n+2) { border-bottom: none; }
    .detalhe-full { grid-column: 1 / -1; border-right: none; }
    .detalhe-label {
      color: var(--teal);
      font-weight: 700;
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
      text-transform: uppercase;
      letter-spacing: .5px;
    }
    .detalhe-valor {
      color: #333;
      font-size: 14px;
      font-weight: 500;
      line-height: 1.5;
    }
  </style>

</body>
</html>