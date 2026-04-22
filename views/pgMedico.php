<?php
require_once '../controllers/UserControll.php';
require_once './components/UserComponents.php';
verificarTipo(['medico']);
informacaoMedica();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    voce chegou ao arquivo do medico 
    <br><br>
   <a href="../controllers/logout.php">sair</a>
</body>
</html>