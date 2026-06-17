<?php
require_once '../../controllers/UserControll.php';
$_SESSION['id_paciente'] = '';
$item = $_GET['termo'] ?? null;
$id = $_GET['medico'] ?? null;


if ($item && !empty($item)) {
    $dado = buscarPaciente($item);
} else {
    $dado = pacienteMedicos($id);
}


if (!empty($dado)) {
    foreach ($dado as $paciente) {
        if (empty($paciente['nome'])) continue;
       
        $valor = isset($paciente['tipo']) && $paciente['tipo'] !== '' ? (int)$paciente['tipo'] : 0;
        $tipo = [
            1 => 'leve',
            2 => 'medio',
            3 => 'grave'
        ];
        $nivel = $tipo[$valor] ?? 'leve';


        echo "<a class='card' href='medPaciente.php?paciente=" . htmlspecialchars($paciente['id'], ENT_QUOTES, 'UTF-8') . "&tipo=" . $nivel . "'>
          <h1 class='card-name'>" . htmlspecialchars($paciente['nome'], ENT_QUOTES, 'UTF-8') . "</h1>
          <div class='card-body'>
            <p><strong>Data nascimento: </strong>" . htmlspecialchars(traduz_data_para_exibir($paciente['data_nascimento']), ENT_QUOTES, 'UTF-8') . "</p>
            <p class='card-severity {$nivel}'>Condição médica: <b class='{$nivel}'>{$nivel}</b></p>
            <p class='card-severity'>Cartão de saúde: " . htmlspecialchars($paciente['numero_de_carteirinha'], ENT_QUOTES, 'UTF-8') . "</p>
          </div>
        </a>";
    }
}
?>
