<?php
require_once './components/UserComponents.php';
require_once '../controllers/UserControll.php';
verificarTipo(['paciente']);

$variaveldeteste = 10;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['tel_emergencia'])) {
        salvarTelEmergencia();
    }

    if (isset($_POST['Altura'])) {
        salvarAltura();
    }

    if (isset($_POST['Alergia'])) {
        salvarAlergia();
    }

    if (isset($_POST['Genero'])) {
        salvarGenero();
    }

    if (isset($_POST['Peso'])) {
        salvarPeso();
    }
}



// salvarHistoricoFamiliar(); só deve ser chamada no submit


$telefoneDeEmergencia = showTelEmergencia();
$nomePciente = showNome();
$cpf = showCPF();
$altura = showAltura();
$alergia = showAlergia();
$genero = showGenero();
$sangue = showSangue();
$peso = showPeso();
$idade = showIdade();
$data_nascimento = showDataNasc();
$numero_de_carteirinha = showNumCarterinha();
$historico_familiar = showHistoricoFamiliar();

$problemaLeve =  showProblemaLeve();
$problemaMedio = showProblemaMedio();
$problemaGrave = showProblemaGrave();


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/paciente.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <title>Página do Paciente- Início</title>
</head>

<body>
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

    <nav id="sidebar">
        <div class="contSidebar">
            <h1><?php echo $nomePciente ?></h1>
        </div>

        <a href="registros.php?titulo=prontuario" class="opcao">Prontuário</a> <!-- opções do sidebar q ta no figma -->
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


    <!-- conteúdo da página -->
    <main>
        <div class="contMain">
            <div class="parte">
                <div class="cardSaude">
                    <div class="titulo">
                        <h1>Cartão Nacional de Saúde</h1>
                    </div>

                    <div class="contTexto">
                        <!-- grid pra fazer as colunas com as informações -->
                        <div class="coluna">


                            <div class="campo">
                                <p style="color: white;"><strong>Nome:</strong></p>
                                <p class="texto"><?php echo $nomePciente ?></p>
                                <span></span>
                            </div>

                            <div class="campo">
                                <p style="color: white;"><strong>CPF:</strong></p>
                                <p class="texto"><?php echo $cpf ?></p>
                                <span></span>
                            </div>

                            <form method="POST">
                                <div class="campo">
                                    <p style="color: white;"><strong>Altura:</strong></p>
                                    <p class="texto"><?php echo $altura ?></p>
                                    <input name="altura" class="input hidden" type="text" placeholder="Ex: 1,80" required>

                                    <button type="button" class="editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button class="salvar hidden" type="submit" name="Altura" value="salvar">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </form>

                            <form method="POST">
                                <div class="campo">
                                    <p style="color: white;"><strong>Alergia:</strong></p>
                                    <p class="texto"><?php echo $alergia ?></p>
                                    <input name="alergia" class="input hidden" type="text" placeholder="Ex: Amendoim">

                                    <button type="button" class="editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button class="salvar hidden" type="submit" name="Alergia" value="salvar">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="coluna">
                            <form method="POST">
                                <div class="campo">
                                    <p style="color: white;"><strong>Gênero:</strong></p>
                                    <p class="texto"><?php echo $genero ?></p>

                                    <select class="input hidden" name="genero" required>
                                        <option value="">Selecione seu gênero</option>
                                        <option value="m">Masculino</option>
                                        <option value="f">Feminino</option>
                                        <option value="i">Indefinido</option>
                                    </select>

                                    <button type="button" class="editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button class="salvar hidden" type="submit" name="Genero" value="salvar">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </form>

                            <div class="campo">
                                <p style="color: white;"><strong>Sangue:</strong></p>
                                <p class="texto"><?php echo $sangue ?></p>
                                <span></span>
                            </div>
                            <form method="POST">
                                <div class="campo">
                                    <p style="color: white;"><strong>Peso:</strong></p>
                                    <p class="texto"><?php echo $peso ?></p>
                                    <input class="input hidden" type="text" value="" name="peso" placeholder="Ex: 80Kg">

                                    <button type="button" class="editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button class="salvar hidden" type="submit" name="Peso" value="salvar">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="coluna">

                            <div class="campo">
                                <p style="color: white;"><strong>Idade:</strong></p>
                                <p class="texto idade"><?php echo $idade ?></p>
                                <span></span> <!-- ta aq so pro flex jogar o 30 no meio -->
                            </div>

                            <div class="campo">
                                <p style="color: white;"><strong>Nascimento:</strong></p>
                                <p class="texto"><?php echo $data_nascimento ?></p>
                                <span></span>
                            </div>

                            <div class="campo">
                                <p style="color: white;"><strong>N Carteirinha:</strong></p>
                                <p class="texto"><?php echo $numero_de_carteirinha ?></p>
                                <span></span>
                            </div>

                            <form method="POST">
                                <div class="campo">
                                    <p style="color: white;"><strong>Tel. de Emergencia:</strong></p>
                                    <p class="texto"><?php echo $telefoneDeEmergencia ?></p>
                                    <input name="telefone" class="input hidden" type="text" value="" placeholder="Ex: (**) *****-****">

                                    <button type="button" class="editar">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <button class="salvar hidden" type="submit" name="tel_emergencia" value="salvar">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>

                    <!-- Tabela expandida -->
                    <div class="tabela-expandida">
                        <h2>Doenças e comorbidades</h2>
                        <?php echo renderTable($problemaLeve, $problemaMedio, $problemaGrave) ?>
                    </div>

                    <button class="btnExpandir" type="button">Expandir</button>
                </div>
            </div>

            <div class="parte">
                <div class="gridBtn">
                    <a href="./medicamento_uso.php"><button class="btnMenu">Medicamento em Uso</button></a>
                    <a href="./receitas_medicas.php"><button class="btnMenu">Receita Médica</button></a>
                    <a href=""><button class="btnMenu">Histório Familiar</button></a>
                </div>
            </div>
        </div>
    </main>

    <script src="./scripts/menu.js"></script>
    <script src="./scripts/sidebar.js"></script>
    <script src="./scripts/esconderHeader.js"></script>
</body>

</html>