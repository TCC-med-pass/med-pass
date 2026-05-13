<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedPass – Configurações</title>
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <script src="./settings.js"></script>
  <link rel="stylesheet" href="../Configuracao/accessibility_global.css"/>
  <link rel="stylesheet" href="./configuracoes.css"/>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
  <a href="#" class="topbar-icon"><i class="fa-solid fa-house"></i></a>
  <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
  <a href="#" class="topbar-icon"><i class="fa-solid fa-bars"></i></a>
</div>

<!-- SUBHEADER -->
<div class="subheader">
  <a class="back-btn" href="#">
    <i class="fa-solid fa-chevron-left"></i> Voltar
  </a>
  <div class="subheader-title">
    <i class="fa-solid fa-gear"></i> Configurações
  </div>
  <div class="subheader-spacer"></div>
</div>

<!-- MAIN -->
<main>

  <!-- Paciente -->
  <div class="patient-info">
    <div class="patient-name">Ana Beatriz Pereira Costa</div>
    <div class="patient-card-number">
      Número da carterinha: <span>12345678-0</span>
    </div>
  </div>

  <!-- Grid de configurações -->
  <div class="settings-grid">

    <!-- FONTE -->
    <div class="s-card card-fonte" onclick="handleFontCardClick(event)">
      <span class="s-card-label">Fonte</span>
      <div class="font-stages" id="font-stages">
        <button class="font-stage-btn" data-stage="small"  onclick="setFontStage('small',  event)">
          <i class="fa-solid fa-font"></i>
        </button>
        <button class="font-stage-btn" data-stage="medium" onclick="setFontStage('medium', event)">
          <i class="fa-solid fa-font"></i>
        </button>
        <button class="font-stage-btn" data-stage="large"  onclick="setFontStage('large',  event)">
          <i class="fa-solid fa-font"></i>
        </button>
      </div>
    </div>

    <!-- ALTERAR DADOS -->
    <div class="s-card card-alterar">
      <span class="s-card-label">Alterar Dados</span>
      <i class="fa-solid fa-user-pen s-icon"></i>
    </div>

    <!-- MODO ESCURO -->
    <div class="s-card card-dark" onclick="toggleDark()">
      <span class="s-card-label">Modo Escuro</span>
      <i class="fa-solid fa-moon moon-icon"></i>
      <div class="toggle-track" id="dark-toggle">
        <div class="toggle-thumb"></div>
      </div>
    </div>

    <!-- AJUDA -->
    <div class="s-card card-ajuda">
      <span class="s-card-label">Ajuda</span>
      <i class="fa-solid fa-circle-question s-icon"></i>
    </div>

    <!-- LOGOUT -->
    <div class="s-card card-logout">
      <span class="s-card-label">Logout</span>
      <i class="fa-solid fa-right-from-bracket s-icon"></i>
    </div>

  </div>
</main>

<script>
  /* ══════════════════════════════════════════════════
     Tela de Configurações – lógica de UI
     Toda a persistência é delegada ao settings.js
     ══════════════════════════════════════════════════ */

  /* ─── Fonte ─── */
  function syncFontUI(stage) {
    document.querySelectorAll('.font-stage-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.stage === stage);
    });
  }

  function setFontStage(stage, event) {
    if (event) event.stopPropagation();
    MedPassSettings.setFont(stage);
    syncFontUI(stage);
  }

  function handleFontCardClick(event) {
    /* Clique no card (fora dos botões) → avança para o próximo estágio */
    if (event.target.closest('.font-stage-btn')) return;
    const stages = ['small', 'medium', 'large'];
    const current = MedPassSettings.getFont();
    const next = stages[(stages.indexOf(current) + 1) % stages.length];
    setFontStage(next, null);
  }

  /* ─── Modo escuro ─── */
  function syncDarkUI(enabled) {
    document.getElementById('dark-toggle').classList.toggle('on', enabled);
  }

  function toggleDark() {
    const newState = !MedPassSettings.getDark();
    MedPassSettings.setDark(newState);
    syncDarkUI(newState);
  }

  /* ─── Inicialização: reflete estado já salvo ─── */
  document.addEventListener('DOMContentLoaded', function () {
    syncFontUI(MedPassSettings.getFont());
    syncDarkUI(MedPassSettings.getDark());
  });
</script>
</body>
</html>