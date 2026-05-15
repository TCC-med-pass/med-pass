<?php
// Oq tinha na pagina do paciente que dava pra usar pra mostrar as informações eu coloquei

require_once './components/UserComponents.php';
require_once '../controllers/UserControll.php';
verificarTipo(['paciente']);





$titulo = showTitulo();

$nomePciente = showNome();
$numero_de_carteirinha = showNumCarterinha();


$nomes_medicos = showNomeMedico();
$datas_emissoes =  showDataEmissao();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/registros.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <title>MedPass-<?php echo $titulo ?></title>
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
            <h1 class="titulo">
                <?php
                if ($titulo == 'prontuario') {
                    echo ucfirst(str_replace("a", "á", $titulo));
                } else if ($titulo == 'laudo') {
                    echo 'Laudo Médico';
                } else if ($titulo == 'atestado') {
                    echo 'Atestado/Declaração';
                } else {
                    echo ucfirst($titulo);
                }

                ?></h1> <!-- Titulo via php, o mesmo da aba da guia -->
        </section>


        <section class="cards">

            <?php renderCard($datas_emissoes, $nomes_medicos) ?>

        </section>

        <div class="carteirinha" id="carteirinha"> <!-- pra fazer a carteirinha descer qnd o sidebar abre PRECISA ter o id "carteirinha"!! -->
            <p>Número da carteirinha:</p>
            <span><?php echo $numero_de_carteirinha ?></span> <!-- Aqui puxa o n da carteirinha do back -->
        </div>
    </main>

    <script src="./scripts/sidebar.js"></script>
    <script src="./scripts/esconderHeader.js"></script>
</body>

</html>