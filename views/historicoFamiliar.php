<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/historicoFamiliar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <link rel="stylesheet" href="./styles/accessibility_global.css">
    <title>MedPass- Histórico familiar</title>
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
            <h1 class="titulo">Histórico Familiar</h1> <!-- Titulo via php, o mesmo da aba da guia -->
        </section>

        <div class="topoAcoes">
            <button class="btnAdicionar" id="btnInfo">
                <i class="fa-solid fa-plus"></i>
                Adicionar
            </button>
        </div>

        <section class="cards">
            <div class="card-doenca leve"> <!-- Card da doença -->
                <div class="topo">
                    <h2>Filiação: Mãe</h2> <!-- Tem q mudar a filiação pelo q ta no banco -->
                    <h3>Comorbidade Leve</h3> <!-- isso aq tbm -->
                </div>
                <div class="corpo"> <!-- Divisão pra ficar igual no figma -->
                    <p><strong>Comorbidade: </strong>Diabates tipo II</p> <!-- doença -->
                </div>
                <div class="footer">
                    <button class="editar">Editar</button> <!-- o botao vai abrir um popup igual o do adicionar, mas pra editar a comorbidade -->
                </div>
            </div>
            
            <div class="card-doenca medio">
                <div class="topo">
                    <h2>Filiação: Mãe</h2>
                    <h3>Comorbidade Media</h3>
                </div>
                <div class="corpo">
                    <p><strong>Comorbidade: </strong>Diabates tipo II</p>
                </div>
                <div class="footer">
                    <button class="editar">Editar</button>
                </div>
            </div>

            <div class="card-doenca grave">
                <div class="topo">
                    <h2>Filiação: Mãe</h2>
                    <h3>Comorbidade Grave</h3>
                </div>
                <div class="corpo">
                    <p><strong>Comorbidade: </strong>Diabates tipo II</p>
                </div>
                <div class="footer">
                    <button class="editar">Editar</button>
                </div>
            </div>

            <!-- POPUP DE ADICIONAR -->
            <div class="modal" id="popup">
                <div class="modalConteudo">
                    <button class="fecharInfo" id="fecharInfo" aria-label="Fechar popup">
                        <i class="fa-solid fa-x"></i>
                    </button>

                    <h2>Adicionar doença</h2>

                    <form method="post">
                        <input type="text" name="filiacao" placeholder="O grau de parentesco do paciente que foi diagnosticado" aria-label="Digite o grau de parentesco do paciente que foi diagnosticado" required />
                        <input type="text" name="historico_familiar" placeholder="Digite aqui a doença" aria-label="Digite a doença" required />
                        <button type="submit" class="salvar">Salvar</button>
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
                        <input type="text" name="doenca" placeholder="Editar a doença" aria-label="Editar a doenca" value="" required /> <!-- Seria interessante fazer igual o popup do médico, q apareça a doença antes de editar como valor atual desse input -->
                        <button type="submit" class="salvar">Salvar</button>
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