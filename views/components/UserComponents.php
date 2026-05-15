<?php


function showMedicamento()
{

    if ($_SESSION['nivel'] === 'paciente') {
        $id = $_SESSION['id_usuario'];
    } elseif ($_SESSION['nivel'] === 'medico') {
        $id = $_SESSION['id_paciente'];
    } {
        $_SESSION['erro'][] = "usuário não encontrado";
    }

    $tipo = $_SESSION['nivel'];
    $dado = medicamento($id, $tipo);

    if (empty($dado)) {
        $dado = [[
            "nome" => "Não tem medicamento",
            "dosagem" => "--------",
            "frequencia" => "--------",
            "id" => 0

        ]];
    }
    $delete = '';

    foreach ($dado as $remedio) {
        if ($tipo === 'medico') {
            $delete = "<button class='btn-lixeira' onclick='confirmarExclusao(" . htmlspecialchars($remedio['id'], ENT_QUOTES, 'UTF-8') . ")' title='Remover'>
    <i class='fa-solid fa-trash'></i>
</button>";
        }
        if ($remedio['id'] === 0) {
            $mostrar = '--------';
        } else {
            $mostrar = "<a  href='informacao.php?medicamento=" . htmlspecialchars($remedio['id'], ENT_QUOTES, 'UTF-8') . "' class='tag-abrir'>detalhes</a>  $delete ";
        }
        echo "<tr>
        <td>" . htmlspecialchars($remedio['nome'], ENT_QUOTES, 'UTF-8') . "</td>
        <td>" . htmlspecialchars($remedio['dosagem'], ENT_QUOTES, 'UTF-8') . "</td>
         <td>" . htmlspecialchars($remedio['frequencia'], ENT_QUOTES, 'UTF-8') . "</td>
         <td class='td-acoes'>" . $mostrar . "
         </tr>";
    }
}

function mensagemErro()
{
    global $pdo;
    if (!empty($_SESSION['erro'])) {
        echo "<ul>";

        foreach ($_SESSION['erro'] as $erro) {
            echo "<li>" . htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . "</li>";
        }

        echo "</ul>";
        unset($_SESSION['erro']);
    }
}
function mensagemSucesso()
{
    if (!empty($_SESSION['sucesso'])) {
        echo "<p>" . htmlspecialchars($_SESSION['sucesso'], ENT_QUOTES, 'UTF-8') . "</p>";
        unset($_SESSION['sucesso']);
    }
}

function showReceitas()
{
    $id = $_SESSION['id_usuario'];
    $dado = receitas($id);

    foreach ($dado as $receita) {
        echo "<div class='card'>
      <div class='card-name'>Dr. " . htmlspecialchars($receita['medico'], ENT_QUOTES, 'UTF-8') . "</div>
      <div class='card-meta'>
        <div class='card-date-label'>Data emissão:</div>
        <div class='card-date-value'>" . htmlspecialchars(traduz_data_para_exibir($receita['data']), ENT_QUOTES, 'UTF-8') . "</div>
        <div class='card-desc-label'>Descrição:</div>
        <div class='card-desc-value'>" . htmlspecialchars($receita['descricao'], ENT_QUOTES, 'UTF-8') . "</div>
      </div>
      <a href='arquivo.php?arquivo=" . htmlspecialchars($receita['id'], ENT_QUOTES, 'UTF-8') . "&tipo=minha%20receita' alt='Botão de mostrar o documento médico'
>
      <button  class='card-btn'>Abrir</button>
      </a>
    </div>";
    }
}

function arquivoIframe()
{
    if (isset($_GET['arquivo'])) {
        $id = trim($_GET['arquivo']);
        echo "<iframe src='../servico/chamados/user_arquivo.php?arquivo=$id' alt='Mostrando documento médico em PDF'></iframe>";
    } else {
        $_SESSION['erro'][] = "Arquivo não informado";
    }
}

function showRepositorio()
{
    $id = $_SESSION['id_paciente'] ?? '';
    $tipo = $_GET['tipo'] ?? '';
    $mensagem = $_GET['mensagem'] ?? '';

    if (empty($id) || empty($tipo)) {
        $_SESSION['erro'][] = "Parâmetros inválidos para mostrar repositório.";
        return;
    }

    $dado = repositorio($id, $tipo);

    if (empty($dado)) {
        echo "<p>Nenhum documento encontrado.</p>";
        return;
    }

    foreach ($dado as $item) {
        echo "<div class='card'>
  <div class='card-meta'>
    <div class='card-row'>
      <span class='card-date-label'>Nome:</span>
      <span class='card-date-value'>" . htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') . "</span>
    </div>
    <div class='card-row'>
      <span class='card-desc-label'>Data emissão:</span>
      <span class='card-desc-value'>" . htmlspecialchars(traduz_data_para_exibir($item['data']), ENT_QUOTES, 'UTF-8') . "</span>
    </div>
  </div>
  <a href='arquivo.php?arquivo=" . htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') . "&tipo=$mensagem' alt='Botão de mostrar o documento médico'> 
  <button class='card-btn'>Abrir</button>
  </a>
</div>";
    }
}
function showInformacaoMedicamentoUso()
{
    $id = $_GET['medicamento'];
    $dado = mostrarMedicamentoUso($id);

    if ($dado === false) {
        $_SESSION['erro'][] = "Informação do medicamento não encontrada.";
        return;
    }

    foreach ($dado as $info) {
        echo "<div class='detalhe-header'>
        <i class='fa-solid fa-pills'></i>
        <h2 id='det-nome'>" . htmlspecialchars($info['nome'], ENT_QUOTES, 'UTF-8') . "</h2>
      </div>
      <div class='detalhe-grid'>
        <div class='detalhe-item'>
          <span class='detalhe-label'><i class='fa-solid fa-syringe'></i> Dose</span>
          <span class='detalhe-valor' id='det-dose'>" . htmlspecialchars($info['dosagem'], ENT_QUOTES, 'UTF-8') . "</span>
        </div>
        <div class='detalhe-item'>
          <span class='detalhe-label'><i class='fa-solid fa-clock'></i> Frequência</span>
          <span class='detalhe-valor' id='det-freq'>" . htmlspecialchars($info['frequencia'], ENT_QUOTES, 'UTF-8') . "</span>
        </div>
        <div class='detalhe-item'>
          <span class='detalhe-label'><i class='fa-solid fa-calendar-day'></i> Data de início</span>
          <span class='detalhe-valor' id='det-inicio'>" . htmlspecialchars($info['dataInicio'], ENT_QUOTES, 'UTF-8') . "</span>
        </div>
        <div class='detalhe-item'>
          <span class='detalhe-label'><i class='fa-solid fa-calendar-xmark'></i> Data de término</span>
          <span class='detalhe-valor' id='det-fim'>" . htmlspecialchars($info['dataFim'], ENT_QUOTES, 'UTF-8') . "</span>
        </div>
        <div class='detalhe-item'>
          <span class='detalhe-label'><i class='fa-solid fa-user-doctor'></i> Médico responsável</span>
          <span class='detalhe-valor' id='det-medico'>" . htmlspecialchars($info['medico'], ENT_QUOTES, 'UTF-8') . "</span>
        </div>
        <div class='detalhe-item detalhe-full'>
          <span class='detalhe-label'><i class='fa-solid fa-file-lines'></i> Observações</span>
          <span class='detalhe-valor' id='det-obs'>" . htmlspecialchars($info['observacao'], ENT_QUOTES, 'UTF-8') . "</span>
        </div>
      </div>";
    }
}
function showProblemaSaude()
{
    $id = $_SESSION['id_paciente'] ?? '';
    $dado = mostrarProblemaSaude($id);

    // foreach ($dado as $problema) {
    // }
}





function renderCard($datas_emissoes, $nomes_medicos)
{
    if (!$nomes_medicos || !$datas_emissoes) {
        return;
    }

    foreach ($nomes_medicos as $index => $nome_medico) {

        $data_emissao = $datas_emissoes[$index];

        echo '
            <div class="card">
                <h2>
                    <strong>Médico: </strong> 
                    ' . $nome_medico . '   
                </h2>  
                <h3>
                    <strong>Data: </strong>
                    ' . $data_emissao . '
                </h3>

                <button>Abrir</button>
            </div>
        ';
    }
}


function renderTable($problemaLeve, $problemaMedio, $problemaGrave)
{
    $html = '
    <table>
        <thead>
            <tr>
                <th>Doenças Leves</th>
                <th>Doenças Médias</th>
                <th>Doenças Graves</th>
            </tr>
        </thead>
        <tbody>
    ';

    $max = max(
        count($problemaLeve),
        count($problemaMedio),
        count($problemaGrave)
    );

    for ($i = 0; $i < $max; $i++) {

        $leve  = $problemaLeve[$i]['nome'] ?? '';
        $medio = $problemaMedio[$i]['nome'] ?? '';
        $grave = $problemaGrave[$i]['nome'] ?? '';

        $html .= '
            <tr>
                <td>' . $leve . '</td>
                <td>' . $medio . '</td>
                <td>' . $grave . '</td>
            </tr>
        ';
    }

    $html .= '
        </tbody>
    </table>
    ';

    return $html;
}
