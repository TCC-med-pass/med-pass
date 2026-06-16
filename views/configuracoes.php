<?php 

require_once './components/UserComponents.php';

require_once '../controllers/UserControll.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  salvarEndereco();

  
   
}

  $carteirinha = showNumCarterinha();
  $nome = showNome();
 
  $rua = showRua();

  $numeroCasa = showNumeroCasa();
  
  $bairro = showBairro();
  $cidade = showCidade();





?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MedPass – Configurações</title>
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./styles/accessibility_global.css" />
  <link rel="stylesheet" href="./styles/configuracoes.css" />
</head>

<body>
  <header id="header">
    <div class="container">
      <a href="pgPaciente.php">
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

  <nav id="sidebar">
    <div class="contSidebar">
      <h1>Configurações</h1>
    </div>
  </nav>

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

  <main>

    <?php mensagemErro() ?>
    <?php mensagemSucesso() ?>

    <!-- Paciente -->
    <div class="patient-info">
      <div class="patient-name"><?php echo $nome ?></div>
      <div class="patient-card-number">
        Número da carterinha: <span><?php echo $carteirinha ?? 'xxxx' ?></span><br>

        Endereço cadastrado: <span>
                                <?php 
                                  echo'Rua:  ' .  $rua['rua'];
                                  echo "Número:  " .  $numeroCasa['numero_casa'];
                                  echo 'Bairro:  ' .  $bairro['bairro'];
                                  echo 'Cidade:  ' .  $cidade['cidade']
                                  ?></span>
      </div>
    </div>

    <!-- Grid de configurações -->
    <div class="settings-grid">

      <!-- FONTE -->
      <div class="s-card card-fonte" onclick="handleFontCardClick(event)">
        <span class="s-card-label">Fonte</span>
        <div class="font-stages" id="font-stages">
          <button class="font-stage-btn" data-stage="small" onclick="setFontStage('small',  event)">
            <i class="fa-solid fa-font"></i>
          </button>
          <button class="font-stage-btn" data-stage="medium" onclick="setFontStage('medium', event)">
            <i class="fa-solid fa-font"></i>
          </button>
          <button class="font-stage-btn" data-stage="large" onclick="setFontStage('large',  event)">
            <i class="fa-solid fa-font"></i>
          </button>
        </div>
      </div>

      <!-- ALTERAR DADOS -->
      <button id="btnInfo" class="s-card card-alterar btnInfo">
        <span class="s-card-label">Alterar Endereço</span>
        <i class="fa-solid fa-user-pen s-icon"></i>
      </button>

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

    <!-- Popup -->
    <div class="modal" id="popup">
      <div class="modalConteudo">
        <button class="fecharInfo" id="fecharInfo" aria-label="Fechar popup">
          <i class="fa-solid fa-x"></i>
        </button>

        <h2>Editar Endereço</h2>

        <form method='post'>
          <label for='rua'>Rua:</label>
          <input type='text' name='rua' placeholder='Nome da Rua:'  value='<?php echo $rua['rua'] ?>' aria-label='Nome da Rua:'>

          <label for='numero'>Número da Casa:</label>
          <input type='number' name='numeroCasa' placeholder='Número da Casa:' value='<?php  echo $numeroCasa['numero_casa'] ?>' aria-label='Número da Casa:'>

          <label for='bairro'>Bairro:</label>
          <input type='text' name='bairro' placeholder='Bairro:' value='<?php echo $bairro['bairro'] ?>' aria-label='Bairro:'>

          <label for='cidade'>Cidade:</label>
          <input type='text' name='cidade' placeholder='Cidade:' value='<?php  echo $cidade['cidade'] ?>' aria-label='Cidade:'>

          <button type='submit' class='salvar'>Salvar</button>
        </form>
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
    document.addEventListener('DOMContentLoaded', function() {
      syncFontUI(MedPassSettings.getFont());
      syncDarkUI(MedPassSettings.getDark());
    });
  </script>
  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/esconderHeader.js"></script>
  <script src="./scripts/settings.js"></script>
  <script src="./scripts/popupMedico.js"></script>
</body>

</html>