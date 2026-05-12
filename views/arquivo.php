<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
$titulo = ucwords($_GET['tipo']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?> - MedPass</title>
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/arquivo.css">
</head>

<body>

    <!-- TOP BAR -->
    <div class="topbar">
        <a href="#" class="topbar-icon">
            <i class="fa-solid fa-house"></i>
        </a>
        <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
        <a href="#" class="topbar-icon">
            <i class="fa-solid fa-bars"></i>
        </a>
    </div>

    <!-- SUBHEADER -->
    <div class="subheader">
        <a class="back-btn" href="#">
            <i class="fa-solid fa-chevron-left"></i> Voltar
        </a>
        <div class="subheader-title"><?= $titulo ?></div>
        <div class="subheader-spacer"></div>
    </div>

    <main>

        <!-- ÁREA CENTRAL DO DOCUMENTO -->
        <div class="doc-wrapper">

            <!-- ZONA DE UPLOAD -->
            <div class="upload-zone">
                <?php arquivoIframe(); ?>
            </div>


        </div>

        <!-- BOTTOM BAR -->
        <div class="nav-number-badge">
            <p>Número da carterinha:</p>
            <span>12345678-0</span>
        </div>

    </main>


</body>

</html>