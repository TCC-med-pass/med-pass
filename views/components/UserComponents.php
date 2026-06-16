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
    if (!empty($_SESSION['erro'])) {

        $mensagem = '';

        if (is_array($_SESSION['erro'])) {
            $mensagem = implode('<br>', $_SESSION['erro']);
        } else {
            $mensagem = $_SESSION['erro'];
        }

        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Erro",
                html: "' . $mensagem . '",
                confirmButtonText: "OK",
            confirmButtonColor: "#007977"
            });
        </script>
        ';


        unset($_SESSION['erro']);
    }
}




function mensagemSucesso()
{
    if (!empty($_SESSION['sucesso'])) {

        echo '
        <script>
        Swal.fire({
            title: "' . $_SESSION['sucesso'] . '",
            icon: "success",
            draggable: true,
            confirmButtonText: "OK",
            confirmButtonColor: "#007977"
        });
        </script>
        ';

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

    foreach ($dado as $problema) {
        echo "<tr data-id='" . htmlspecialchars($problema['id'], ENT_QUOTES, 'UTF-8') . "'>

          <td>" . htmlspecialchars($problema['nome'], ENT_QUOTES, 'UTF-8') . "</td>
          <td>" . htmlspecialchars($problema['status'], ENT_QUOTES, 'UTF-8') . "</td>
          <td>" . htmlspecialchars($problema['tipo'], ENT_QUOTES, 'UTF-8') . "</td>
          <td>" . htmlspecialchars(traduz_data_para_exibir($problema['data']), ENT_QUOTES, 'UTF-8') . "</td>

          <td class='td-acoes'>

            <button
              class='btn-editar'
              onclick='abrirEdicao(this)'
              title='Editar'>

              <i class='fa-solid fa-pen'></i>

            </button>

          </td>

        </tr>";
    }
}





function renderCard($datas_emissoes, $nomes_medicos, $id)
{

    $titulo = $_GET['titulo'];
    if (!$nomes_medicos || !$datas_emissoes) {
        return;
    }

    foreach ($nomes_medicos as $index => $nome_medico) {

        $data_emissao = $datas_emissoes[$index];

        echo "
            <div class='card'>
                <h2>
                    <strong>Médico: </strong> 
                    " . $nome_medico . "   
                </h2>  
                <h3>
                    <strong>Data: </strong>
                    " . $data_emissao . "
                </h3>

        <a href='arquivo.php?arquivo=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "&tipo=$titulo' alt='Botão de mostrar o documento médico'> 
    <button class='card-btn'>Abrir</button>
</a>
            </div>
        ";
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



function showDadosPaciente()
{
    $id = $_GET['paciente'] ?? $_SESSION['id_paciente'];
    $dados = mostrarDadosPaciente($id);

    $carteirinha = $dados['numero_de_carteirinha'] ?? '';
    $altura = $dados['altura'] ?? '';
    $peso = $dados['peso'] ?? '';
    $alergias = $dados['alergias'] ?? '';
    $rua = $dados['rua'] ?? '';
    $bairro = $dados['bairro'] ?? '';
    $cidade = $dados['cidade'] ?? '';
    $numeroCasa = $dados['numero_casa'] ?? '';
    $tipo_sanguineo = $dados['tipo_sanguineo'] ?? '';

    echo "
        <form method='post'>


        <h2>Informações Gerais</h2>
        
        <label for='carterinha'>Número de carteirinha:</label>
        <input type='number' name='carterinha' value='" . htmlspecialchars($carteirinha, ENT_QUOTES, 'UTF-8') . "' placeholder='Insira o n° de carteirinha do Paciente' aria-label='Insira o número de carteirinha do Paciente'>
        
        <label for='altura'>Altura:</label>
        <input type='number' name='altura' placeholder='Insira a altura do Paciente (ex: 1.70)' step='0.01' min='1' max='2.72' lang='en' value='" . htmlspecialchars($altura, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira a altura do Paciente (ex: 1.70)'>
        
        <label for='peso'>Peso:</label>
        <input type='number' name='peso' placeholder='Insira o peso do Paciente em Kg (Ex: 70)' step='0.01' min='2' max='300' lang='en' value='" . htmlspecialchars($peso, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira o peso do Paciente em Kg (Ex: 70)'>
        
        <label for='alergias'>Alergias:</label>
        <input type='text' name='alergias' placeholder='Insira as alergias do Paciente' value='" . htmlspecialchars($alergias, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira as alergias do Paciente'>

        
        <h2>Endereço:</h2>
        
        <label for='rua'>Rua:</label>
        <input type='text' name='rua' placeholder='Insira a rua do Paciente' value='" . htmlspecialchars($rua, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira a rua do Paciente'>

        <label for='bairro'>Bairro:</label>
        <input type='text' name='bairro' placeholder='Insira o bairro do Paciente' value='" . htmlspecialchars($bairro, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira o bairro do Paciente'>

        <label for='cidade'>Cidade:</label>
        <input type='text' name='cidade' placeholder='Insira a cidade do Paciente' value='" . htmlspecialchars($cidade, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira a cidade do Paciente'>

        <label for='n_casa'>Número Casa:</label>
        <input type='text' name='n_casa' placeholder='Insira o número de residência do Paciente' value='" . htmlspecialchars($numeroCasa, ENT_QUOTES, 'UTF-8') . "' aria-label='Insira o número de residência do Paciente'>


        <h2>Tipo Sanguíneo</h2>
        
        <label for='tipo_sanguineo'>Tipo Sanguíneo:</label>
        <input type='text' name='tipo_sanguineo' placeholder='Tipo sanguíneo do Paciente' value='" . htmlspecialchars($tipo_sanguineo, ENT_QUOTES, 'UTF-8') . "' aria-label='Insra o tipo sanguíneo do Paciente'>

        <button type='submit' class='salvar'>Salvar</button>
        </form>
        ";
}



function showLinkNav()
{
    $nivel = $_SESSION['nivel'] ?? '';
    $dados = [];
    if ($nivel === 'paciente') {
        $dados = [
            'prontuario' => 'registros.php?titulo=prontuario',
            'cirurgia' => 'registros.php?titulo=cirurgia',
            'exame' => 'registros.php?titulo=exame',
            'atestado' => 'registros.php?titulo=atestado',
            'laudo' => 'registros.php?titulo=laudo'
        ];
    } elseif ($nivel === 'medico') {
        $dados = [
            'prontuario' => 'repositorio.php?tipo=prontuario&mensagem=prontuario',
            'cirurgia' => 'repositorio.php?tipo=cirurgia&mensagem=cirurgia',
            'exame' => 'repositorio.php?tipo=exame&mensagem=exame',
            'atestado' => 'repositorio.php?tipo=atestado&mensagem=atestado',
            'laudo' => 'repositorio.php?tipo=laudo&mensagem=laudo'
        ];
    }
    return $dados;
}

function renderHistoricoFam($historicos)
{
?>

    <section class="cards">

        <?php foreach ($historicos as $historico): ?>

            <div class="card-doenca <?= strtolower($historico['nivel']) ?>">

                <div class="topo">
                    <h2>
                        Filiação:
                        <?= htmlspecialchars($historico['parentesco']) ?>
                    </h2>

                    <h3>
                        Nível:
                        <?= htmlspecialchars($historico['nivel']) ?>
                    </h3>
                </div>

                <div class="corpo">
                    <p>
                        <strong>Comorbidade:</strong>
                        <?= htmlspecialchars($historico['doenca']) ?>
                    </p>
                    <p>
                        <strong>Descrição:</strong>
                        <?= htmlspecialchars($historico['descricao']) ?>
                    </p>
                </div>

                <div class="footer">
                    <button
                        class="editar"
                        data-id="<?= $historico['id_historico'] ?>">
                        Editar</button>
                </div>

            </div>

        <?php endforeach; ?>

    </section>



<?php
}

function linkAjuda(){
if ($_SESSION['nivel'] === 'paciente') {
    return "./ajuda_paciente.php";
  }elseif ($_SESSION['nivel'] === 'medico') {
    return "./ajuda_medico.php";
}

}
 ?>
