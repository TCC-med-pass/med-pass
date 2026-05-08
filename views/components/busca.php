<?php
require_once '../../controllers/UserControll.php';
$_SESSION['id_paciente'] = '';
$item = $_GET['termo'] ?? null;
$id = $_GET['medico'] ?? null;
if($item && !empty($item)){
    $dado = buscarPaciente($item);
<<<<<<< HEAD
foreach ($dado as $paciente) {
    echo "<a href='medPaciente.php?paciente=" . htmlspecialchars($paciente['id'], ENT_QUOTES, 'UTF-8') . "'>
        <div>
        <p>" . htmlspecialchars($paciente['nome'], ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars(traduz_data_para_exibir($paciente['data_nascimento']), ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars($paciente['tipo'], ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars($paciente['numero_de_carteirinha'], ENT_QUOTES, 'UTF-8') . "</p>
        </div> 
        </a>";
};
}elseif($id){
        
    $dado = pacienteMedicos($id);
    foreach ($dado as $paciente){
        echo "<a href='medPaciente.php?paciente=" . htmlspecialchars($paciente['id'], ENT_QUOTES, 'UTF-8') . "'>
        <div>
        <p>" . htmlspecialchars($paciente['nome'], ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars(traduz_data_para_exibir($paciente['data_nascimento']), ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars($paciente['tipo'], ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars($paciente['numero_de_carteirinha'], ENT_QUOTES, 'UTF-8') . "</p>
        </div> 
        </a>";
    }
}

=======
}else{
    $dado = pacienteMedicos($id);
}
foreach ($dado as $paciente){
    $valor = isset($paciente['tipo']) && $paciente['tipo'] !== '' ? (int)$paciente['tipo'] : 0;
    $tipo = [
         1 => 'leve',
         2 => 'medio',
         3 => 'grave'
    ];
    $nivel = $tipo[$valor] ?? 'leve';
        echo " <a class='card  {$nivel}' href='medPaciente.php?paciente=" . htmlspecialchars($paciente['id'], ENT_QUOTES, 'UTF-8') . "'>
      <h1 class='card-name'>". htmlspecialchars($paciente['nome'], ENT_QUOTES, 'UTF-8') . "</h1>
      <div class='card-body'>
        <p><strong>Data nascimento: </strong> " . htmlspecialchars(traduz_data_para_exibir($paciente['data_nascimento']), ENT_QUOTES, 'UTF-8') . "</p>
        <p class='card-severity'>Condição médica: {$nivel}</p>
        <p class='card-severity'>Cartão de saúde: " . htmlspecialchars($paciente['numero_de_carteirinha'], ENT_QUOTES, 'UTF-8') . "</p>
      </div>
    </a>";
    }



?>
>>>>>>> main
