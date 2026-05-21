<?php
// Oq tinha na pagina do paciente que dava pra usar pra mostrar as informações eu coloquei

require_once './components/UserComponents.php';
require_once '../controllers/UserControll.php';
verificarTipo(['paciente']);

$nomePciente = showNome();
$numero_de_carteirinha = showNumCarterinha();

salvarHistoricoFamiliar();
$historico_familiar = showHistoricoFamiliar();
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./styles/historicoFamiliar.css" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet" />
  <link
    rel="icon"
    type="image/svg+xml"
    href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png"
    alt="Med-Pass-Icon" />
  <title>MedPass- Histórico Familiar</title>
</head>

<body>
  <header id="header">
    <div class="container">
      <a href="pgPaciente.php">
        <i class="fa-solid fa-house btnCasa"></i>
      </a>
    </div>
    <div class="container">
      <img
        src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png"
        alt="Logo MedPass" />
    </div>
    <div class="container">
      <!--Menu hamburguer-->
      <i class="fa-solid fa-bars menu-icon"></i>
    </div>
  </header>

  <nav id="sidebar">
    <div class="contSidebar">
      <h1><?php echo $nomePciente ?></h1>
    </div>

    <a href="registros.php?titulo=prontuario" class="opcao">Prontuário</a>

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

  <main>
    <section class="topoPagina">
      <a href="pgPaciente.php" class="btnVoltar">
        <i class="fa-solid fa-chevron-left"></i>
        Voltar
      </a>
      <h1 class="titulo">Histórico familiar</h1>
    </section>

    <section class="historico">
      <!-- Topo do conteúdo -->
      <div class="tituloPagina">
        <div class="containerTexto">
          <h1>Histórico Familiar</h1>
          <h3>Doenças registradas no histórico familiar do paciente.</h3>
        </div>
        <button class="adicionar" id="acionarPopup">
          <i class="fa-solid fa-plus"></i> Adicionar
        </button>
      </div>

      <!-- Tabela com as doenças -->

      <?php renderHistoricoFami($historico_familiar) ?>
   

      <!-- Pop up de adicionar doença -->
      <div class="modal" id="popup">
        <div class="modalConteudo">
          <button class="fechar" id="fecharPopup" aria-label="Fechar popup">
            <i class="fa-solid fa-x"></i>
          </button>

          <h2>Adicionar doença</h2>

          <form method="post">
            <input
              type="text"
              name="historico_familiar"
              placeholder="Digite aqui a doença"
              aria-label="Digite a doença"
              required />
            <button type="submit" class="salvar">Salvar</button>
          </form>
        </div>
      </div>
    </section>

    <div class="carteirinha" id="carteirinha">
      <!-- pra fazer a carteirinha descer qnd o sidebar abre PRECISA ter o id "carteirinha"!! -->
      <p>Número da carteirinha:</p>
      <span><?php echo $numero_de_carteirinha ?></span>
    </div>
  </main>

  <script src="./scripts/sidebar.js"></script>
  <script src="./scripts/esconderHeader.js"></script>
  <script src="./scripts/popupDoencas.js"></script>
</body>

</html>