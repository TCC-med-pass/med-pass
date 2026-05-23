<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['medico']);
uploadArquivoI();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Novo Prontuário – MedPass</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
  <link rel="stylesheet" href="./styles/upload.css" />
  <link rel="stylesheet" href="./styles/erros.css" />
</head>

<body>
  
  <!-- TOP BAR -->
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

  <!-- SUBHEADER -->
  <div class="subheader">
    <a class="back-btn" href="./medPaciente.php" id="btnVoltar">
      <i class="fa-solid fa-chevron-left"></i> Voltar
    </a>
    <div class="subheader-title">Novo Prontuário</div>
    <div class="subheader-spacer"></div>
  </div>

  <!-- MAIN CONTENT -->
  <main>
    <?php mensagemErro() ?>
  <?php mensagemSucesso() ?>

    <!-- FORM CARD -->
    <div class="card">
      <h2>Novo Prontuário</h2>

      <form id="formProntuario" method="post" enctype="multipart/form-data" novalidate>

        <div class="row">
          <div class="field">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome do prontuário" />
          </div>
        </div>

        <div class="row">
          <div class="field">
            <label for="dataEmissao">Data Emissão:</label>
            <input type="date" id="dataEmissao" name="data_emissao" maxlength="10" />
          </div>
          <div class="field">
            <label for="dataValidade">Data Validade:</label>
            <input type="date" id="dataValidade" name="data_validade" maxlength="10" />
          </div>
        </div>

        <!-- CAMPO TIPO (CAIXA DE SELEÇÃO) -->
        <div class="row">
          <div class="field full">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo">
              <option value="" disabled selected>Selecione o tipo</option>
              <option value="exame">Exame</option>
              <option value="laudo">Laudo</option>
              <option value="receitas">Receita</option>
              <option value="cirurgia">Cirurgia</option>
              <option value="prontuario">Prontuário</option>
              <option value="atestado">Atestado/Declaração</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="field full">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Descrição do prontuário"></textarea>
          </div>
        </div>

        <div class="field">
          <label>Arquivo:</label>
          <div class="upload-box" id="uploadBox">
            <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
            <span id="uploadLabel">Anexar Documentos Médicos</span>
            <input type="file" id="arquivo" name="arquivo" accept=".pdf,.jpg,.jpeg,.png" hidden />
          </div>
        </div>

        <div class="btn-row">
          <button type="button" class="btn btn-cancel" id="btnCancelar">Cancelar</button>
          <button type="submit" class="btn btn-send">Enviar</button>
        </div>

      </form>
    </div>

    <!-- BOTTOM ROW -->
    <div class="bottom-row">
      <div class="bottom-spacer"></div>

      <!-- ── PATIENT BADGE ── -->
      <div class="patient-badge" id="carteirinha">
        <div class="badge-label">Paciente:</div>
        <div class="badge-name"><?php echo $_SESSION['nome_paciente'] ?? 'paciente'; ?></div>
        <div class="badge-severity">Comorbidade <?php echo $_SESSION['comorbidades'] ?? 'desconhecida'; ?></div>
      </div>

      <!-- Sidebar -->
      <nav id="sidebar">
        <div class="contSidebar">
          <h1>Dr. <?php echo $_SESSION['nome_medico'] ?? 'Médico'; ?></h1>
        </div>

        <a href="repositorio.php?tipo=prontuario&mensagem=prontuario" class="opcao">Prontuário</a> <!-- opções do sidebar q ta no figma -->
        <a href="repositorio.php?tipo=cirurgia&mensagem=cirurgia" class="opcao">Cirurgia</a>
        <a href="repositorio.php?tipo=exame&mensagem=exame" class="opcao">Exames</a>
        <a href="repositorio.php?tipo=atestado&mensagem=atestado" class="opcao">Atestados/Declaração</a>
        <a href="repositorio.php?tipo=laudos&mensagem=laudo" class="opcao">Laudo Médico</a>

        <div class="contSidebar">
          <a href="./mudarSenha.php" class="config">
            <h3>Trocar Senha</h3>
          </a>
          <a href="../utils/logout.php" class="config">
            <h3>Sair</h3>
          </a>
        </div>
      </nav>


  </main>
  <script src="./scripts/upload.js"></script>
  <script src="./scripts/sidebar.js"></script>
</body>

</html>