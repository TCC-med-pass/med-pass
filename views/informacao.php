<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['paciente', 'medico']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhe do Medicamento – MedPass</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/informacaoMedicamento.css">
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

    <!-- Top bar -->
    <div class="topbar">
        <a href="#" class="topbar-icon"><i class="fa-solid fa-house"></i></a>
        <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
        <a href="#" class="topbar-icon"><i class="fa-solid fa-bars"></i></a>
    </div>

    <!-- Sub-header -->
    <div class="subheader">
        <a href="medicamento_uso.html" class="back-btn">
            <i class="fa-solid fa-chevron-left"></i> Voltar
        </a>
        <span class="subheader-title" id="det-titulo">Detalhes do Medicamento</span>
        <div class="subheader-spacer"></div>
    </div>

    <!-- Main content -->
    <div class="content" style="gap: 24px;">

        <div class="detalhe-card">
            <?php showInformacaoMedicamentoUso(); ?>
        </div>

    </div>

</body>

</html>