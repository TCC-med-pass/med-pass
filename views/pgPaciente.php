<?php
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


$telefoneDeEmergencia = showTelEmergencia(); // variavel que deve ser usada no front para mostrar o Telefone
$nomePciente = showNome(); // variavel que deve ser usada no front para mostrar o Nome
$cpf = showCPF(); // variavel que deve ser usada no front para mostrar o CPF
$altura = showAltura(); // variavel que deve ser usada no front para mostrar a altura
$alergia = showAlergia(); // variavel que deve ser usada no front para mostrar a alergia
$genero = showGenero(); // variavel que deve ser usada no front para mostrar o genero
$sangue = showSangue(); // variavel que deve ser usada no front para mostrar o sangue
$peso = showPeso(); // variavel que deve ser usada no front para mostrar o peso
$idade = showIdade(); // variavel que deve ser usada no front para mostrar a idade
$data_nascimento = showDataNasc(); // variavel que deve ser usada no front para mostrar a data de nascimento
$numero_de_carteirinha = showNumCarterinha(); // variavel que deve ser usada no front para mostrar o numero da carterinha
$historico_familiar = showHistoricoFamiliar(); // variavel que deve ser usada no front para mostrar o Historico Familiar
$problemaLeve =  showProblemaLeve(); // variavel que deve ser usada no front para mostrar os problemas leve de saude
$problemaMedio = showProblemaMedio(); // // variavel que deve ser usada no front para mostrar os problemas medios de saude 
$problemaGrave = showProblemaGrave(); // // variavel que deve ser usada no front para mostrar os problemas graves de saude


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
    <header>
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

                                    <button class="salvar hidden" type="submit" name="Altura" value="salvar">
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

                                    <button class="salvar hidden" type="submit" name="Altura" value="salvar">
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

                                    <button class="salvar hidden" type="submit" name="Altura" value="salvar">
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

                                    <button class="salvar hidden" type="submit" name="Altura" value="salvar">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>

                    <!-- Tabela expandida -->
                    <div class="tabela-expandida">
                        <h2>Doenças e comorbidades</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Comorbidade</th>
                                    <th>Grau de Urgência</th>
                                    <th>Observações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>doenca1</td> <!-- Aq o back coloca as informações na tabela -->
                                    <td>
                                        <p class="leve">Leve</p>
                                    </td> <!-- Vou deixar feito a estilização de uma classe leve, medio e grave, mudando a cor do texto de acordo com o grau da doença -->
                                    <td>obs.</td>
                                </tr>
                                <tr>
                                    <td>doenca2</td>
                                    <td>
                                        <p class="medio">Médio</p>
                                    </td>
                                    <td>obs.</td>
                                </tr>
                                <tr>
                                    <td>doenca3</td>
                                    <td>
                                        <p class="grave">Grave</p>
                                    </td>
                                    <td>obs.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button class="btnExpandir" type="button">Expandir</button>
                </div>
            </div>

            <div class="parte">
                <div class="gridBtn">
                    <a href=""><button class="btnMenu">Medicamento em Uso</button></a>
                    <a href=""><button class="btnMenu">Receita Médica</button></a>
                    <a href=""><button class="btnMenu">Histório Familiar</button></a>
                </div>
            </div>
        </div>
    </main>

    <script src="./scripts/menu.js"></script>
    <script src="./scripts/sidebar.js"></script>
</body>

</html>