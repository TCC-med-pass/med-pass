<?php
require_once './components/UserComponents.php';
require_once '../controllers/UserControll.php';

$nomePciente = showNome();
$numero_de_carteirinha = showNumCarterinha();

$historicos = showHistoricoFamiliar();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['addHistorico'])) {
        salvarHistoricoFamiliar();
    } elseif (isset($_POST['editarHistorico'])) {
        editarHistorico();
    }
}



?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/historicoFamiliar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <link rel="stylesheet" href="./styles/accessibility_global.css">
    <title>MedPass- Histórico familiar</title>
</head>


<body>

    <?php
    mensagemErro();
    mensagemSucesso();
    ?>
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
            <h1><?php echo $nomePciente ?></h1>
        </div>

        <a href="registros.php?titulo=prontuario" class="opcao">Prontuário</a>

        <a href="registros.php?titulo=cirurgia" class="opcao">Cirurgia</a>
        <a href="registros.php?titulo=exame" class="opcao">Exames</a>
        <a href="registros.php?titulo=atestado" class="opcao">Atestados/Declaração</a>
        <a href="registros.php?titulo=laudo" class="opcao">Laudo Médico</a>

        <div class="contSidebar">
            <a href="./ajuda_paciente.php" class="config">
                <h3>Ajuda</h3>
            </a>
            <a href="configuracoes.php" class="config">
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
            <h1 class="titulo">Histórico Familiar</h1> <!-- Titulo via php, o mesmo da aba da guia -->
        </section>

        <div class="topoAcoes">
            <button class="btnAdicionar" id="btnInfo">
                <i class="fa-solid fa-plus"></i>
                Adicionar
            </button>
        </div>

        <section class="cards">
            <?php renderHistoricoFam($historicos) ?>

            <!-- POPUP DE ADICIONAR -->
            <div class="modal" id="popup">
                <div class="modalConteudo">
                    <button class="fecharInfo" id="fecharInfo" aria-label="Fechar popup">
                        <i class="fa-solid fa-x"></i>
                    </button>

                    <h2>Adicionar doença</h2>

                    <form method="post">
                        <input type="text" name="parentesco" placeholder="O grau de parentesco do paciente que foi diagnosticado" aria-label="Digite o grau de parentesco do paciente que foi diagnosticado" required />
                        <input type="text" name="doença" placeholder="Digite aqui a doença" aria-label="Digite a doença" required />
                        <input type="text" name="descricao" placeholder="Digite aqui a descrição" aria-label="Digite a descrição" required />
                        <input type="text" name="nivel" placeholder="Digite aqui o nível da doença" aria-label="Digite a doença" required />
                        <button type="submit" class="salvar" name="addHistorico">Salvar</button>
                    </form>
                </div>
            </div>


            <!-- POPUP DE EDIÇÃO -->
            <div class="modal" id="campoEditar">
                <div class="modalConteudo">
                    <button class="fecharInfo" id="fecharPopup" aria-label="Fechar popup">
                        <i class="fa-solid fa-x"></i>
                    </button>

                    <h2>Editar doença</h2>

                    <form method="post">
                        <input type="text" name="parentesco" placeholder="Editar o parentesco" aria-label="Editar a doenca" value="" required /> <!-- Seria interessante fazer igual o popup do médico, q apareça a doença antes de editar como valor atual desse input -->
                        <input type="text" name="doença" placeholder="Editar a doença" aria-label="Editar a doenca" value="" required />
                        <input type="text" name="descricao" placeholder="Editar a descrição" aria-label="Editar a descrição" value="" required />
                        <input type="text" name="nivel" placeholder="Editar o nível" aria-label="Editar a doenca" value="" required />
                        <input type="hidden" name="id_historico" id="id_historico">
                        <button name="editarHistorico" type="submit" class="salvar">Salvar</button>
                    </form>
                </div>
            </div>
        </section>

        <div class="carteirinha" id="carteirinha"> <!-- pra fazer a carteirinha descer qnd o sidebar abre PRECISA ter o id "carteirinha"!! -->
            <p>Número da carteirinha:</p>
            <span><?php echo $numero_de_carteirinha ?></span> <!-- Aqui puxa o n da carteirinha do back -->
        </div>
    </main>
    <script>
        // Isso aq pega a cor da borda do card e coloca no header e botao de editar no card :)
        const cards = document.querySelectorAll('.card-doenca');

        cards.forEach(card => {
            const topo = card.querySelector('.topo');
            const btnEditar = card.querySelector('.editar')
            const corBorda = getComputedStyle(card).borderColor;

            topo.style.backgroundColor = corBorda;
            btnEditar.style.backgroundColor = corBorda;
        });
    </script>
    <script src="./scripts/sidebar.js"></script>
    <script src="./scripts/esconderHeader.js"></script>
    <script src="./scripts/settings.js"></script>
    <script src="./scripts/popupMedico.js"></script>
    <script src="./scripts/popupDoencas.js"></script>
</body>

</html>