<?php
// Oq tinha na pagina do paciente que dava pra usar pra mostrar as informações eu coloquei

require_once '../controllers/UserControll.php';
verificarTipo(['paciente']);

/*$titulo = $_GET['titulo'] ?? 'Home'; // deixei 'Home' como padrao caso a variavel estiver vazia



if ($titulo == 'Prontuário') {
    $data_emissao = showDataEmissaoProntuario();
} elseif ($titulo == 'Cirurgia') {
    $data_emissao = showDataEmissaoCirurgia();
} elseif ($titulo == 'Exames') {
    $data_emissao = showDataEmissaoExames();
} elseif ($titulo == 'Atestados/Declaração') {
    $data_emissao = showDataEmissaoAtestado();
} elseif ($titulo == 'Laudo Médico') {
    $data_emissao = showDataEmissaoLaudo();
}*/



$titulo = showTitulo();
$data_emissao =  showDataEmissao();
$nomePciente = showNome();
$numero_de_carteirinha = showNumCarterinha();


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

        <form action="registros.php" method="GET"> <!-- adicionei a tag de formulario e a tag de botao para conseguir enviar os dados-->
            <button class="opcao" name="titulo" type="submit" value="Prontuário">Prontuário</button> <!-- opções do sidebar q ta no figma -->
        </form>

        <form action="registros.php" method="GET">
            <button class="opcao" name="titulo" type="submit" value="Cirurgia">Cirurgia</button>
        </form>

        <form action="registros.php" method="GET">
            <button class="opcao" name="titulo" type="submit" value="Exames">Exames</button>
        </form>

        <form action="registros.php" method="GET">
            <button class="opcao" name="titulo" type="submit" value="Atestados/Declaração">Atestados/Declaração</button>
        </form>

        <form action="registros.php" method="GET">
            <button class="opcao" name="titulo" type="submit" value="Laudo Médico">Laudo Médico</button>
        </form>
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
            <h1><?php echo $titulo ?></h1> <!-- Titulo via php, o mesmo da aba da guia -->
        </section>


        <section class="cards">
            <div class="card">
                <h3>TESTE</h3> <!-- nome do medico/paciente dependendo da tela -->
                <p><strong>Data emissão: </strong> <?php $data_emissao ?></p> <!-- data da emissão (tem em todos) -->

                <button>Abrir</button>
            </div>

            <div class="card">
                <h3>TESTE</h3>
                <p><strong>Data emissão: </strong> data aqui</p>

                <button>Abrir</button>
            </div>

            <div class="card">
                <h3>TESTE</h3>
                <p><strong>Data emissão: </strong> data aqui</p>

                <button>Abrir</button>
            </div>

            <div class="card">
                <h3>TESTE</h3>
                <p><strong>Data emissão: </strong> data aqui</p>
                <button>Abrir</button>
            </div>

            <div class="card">
                <h3>TESTE</h3>
                <p><strong>Data emissão: </strong> data aqui</p>

                <button>Abrir</button>
            </div>
        </section>

        <div class="carteirinha" id="carteirinha"> <!-- pra fazer a carteirinha descer qnd o sidebar abre PRECISA ter o id "carteirinha"!! -->
            <p>Número da carteirinha:</p>
            <span><?php echo $numero_de_carteirinha ?></span> <!-- Aqui puxa o n da carteirinha do back -->
        </div>
    </main>

    <script src="./scripts/sidebar.js"></script>
</body>

</html>