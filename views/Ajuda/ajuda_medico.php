<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MedPass &ndash; Ajuda (Médico)</title>
  <link rel="icon" type="image/png" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,400;0,500;0,700;1,400&display=swap');

  :root{
    --teal:#1a8f85; --teal-dark:#155f56; --teal-mid:#22998a; --banner:#178b80;
    --white:#ffffff; --gray-100:#f4f6f8; --gray-200:#e8ecef; --gray-600:#6b7a82;
    --text:#1c2b30; --red:#e53935;
  }
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Aleo',Georgia,serif;background:var(--gray-100);color:var(--text);min-height:100vh;display:flex;flex-direction:column;}

  .topbar{background:var(--teal);display:flex;align-items:center;justify-content:space-between;padding:2px 78px;position:sticky;top:0;z-index:100;}
  .topbar-icon{color:var(--white);font-size:20px;text-decoration:none;opacity:.9;transition:opacity .2s;}
  .topbar-icon:hover{opacity:1;}
  .logo-img{height:120px;object-fit:contain;}

  .subheader{background:var(--white);border-bottom:2px solid var(--gray-200);display:flex;align-items:center;padding:14px 24px;gap:12px;position:relative;}
  .back-btn{display:flex;align-items:center;gap:6px;color:var(--teal);font-weight:700;font-size:15px;text-decoration:none;transition:opacity .2s;}
  .back-btn:hover{opacity:.75;}
  .subheader-title{position:absolute;left:50%;transform:translateX(-50%);font-size:20px;font-weight:800;color:var(--teal);display:flex;align-items:center;gap:8px;white-space:nowrap;pointer-events:none;}
  .subheader-spacer{flex:1;}

  main{flex:1;padding:28px 24px 48px;}
  .ajuda-wrap{max-width:900px;margin:0 auto;background:var(--white);border-radius:16px;padding:28px 32px;box-shadow:0 4px 18px rgba(0,0,0,.08);}

  .banner{background:var(--banner);color:#fff;border-radius:12px;padding:16px 20px 16px 64px;position:relative;font-size:1em;max-width:620px;margin-bottom:6px;}
  .banner .q{position:absolute;left:16px;top:50%;transform:translateY(-50%);width:34px;height:34px;border-radius:50%;background:#fff;color:var(--teal);display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:18px;}

  .content{display:flex;gap:36px;}
  .col{flex:1;}
  h2{font-size:1.06em;font-weight:700;margin:20px 0 4px;display:flex;align-items:baseline;gap:8px;color:var(--text);}
  h2::before{content:"\2022";color:var(--teal);font-size:1.1em;}
  p{font-size:.95em;margin:2px 0;}
  ul{list-style:disc;margin:4px 0 6px 22px;font-size:.95em;}
  li{margin:2px 0;}
  .sub{font-weight:700;font-size:.95em;margin:8px 0 2px;}
  .tip{font-size:.95em;margin:6px 0;}
  .tip b{font-weight:700;}

  @media(max-width:680px){.content{flex-direction:column;gap:0;} .topbar{padding:2px 20px;} .logo-img{height:80px;}}
  </style>
</head>
<body>

  <div class="topbar">
    <a href="#" class="topbar-icon"><i class="fa-solid fa-house"></i></a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <a href="#" class="topbar-icon"><i class="fa-solid fa-bars"></i></a>
  </div>

  <div class="subheader">
    <a class="back-btn" href="#"><i class="fa-solid fa-chevron-left"></i> Voltar</a>
    <div class="subheader-title"><i class="fa-solid fa-circle-question"></i> Ajuda</div>
    <div class="subheader-spacer"></div>
  </div>

  <main>
    <div class="ajuda-wrap">

      <div class="banner">
        <div class="q">?</div>
        Nesta seção, você encontra orientações para usar as abas principais do aplicativo médico e resolver eventuais problemas.
      </div>

      <div class="content">
        <!-- Coluna esquerda -->
        <div class="col">
          <h2>Menu de Navegação (Lateral ou Superior)</h2>
          <p>Nesta tela, você visualiza e gerencia informações essenciais da sua prática médica, como:</p>
          <ul>
            <li>Agenda de atendimentos</li>
            <li>Lista de pacientes cadastrados</li>
            <li>Histórico clínico e prontuários</li>
            <li>Resultados de exames enviados pelos pacientes</li>
            <li>Atestados e prescrições emitidas</li>
            <li>Notificações importantes (ex.: resultados críticos, solicitações pendentes)</li>
          </ul>
          <p class="tip"><b>&ndash; Dica:</b> itens marcados em vermelho indicam ações urgentes, como pendências de assinatura digital ou atualizações obrigatórias.</p>

          <h2>Perguntas Frequentes (FAQ)</h2>
          <p class="sub">Posso acessar o sistema em mais de um dispositivo?</p>
          <p>Sim, desde que utilize o mesmo login médico.</p>
          <p class="sub">Estou recebendo a mensagem "Usuário não autorizado". O que fazer?</p>
          <p>Verifique se sua conta está ativa junto à administração da unidade. Se persistir, entre em contato com o suporte.</p>
        </div>

        <!-- Coluna direita -->
        <div class="col">
          <h2>Suporte Técnico e Contato</h2>
          <p>Se encontrar algum problema no sistema:</p>
          <p>Entre em contato com o suporte:</p>
          <ul>
            <li>E-mail: suporte@medplus.com.br</li>
            <li>Telefone/WhatsApp: (XX) XXXX-XXXX</li>
            <li>Horário: Segunda a sexta, das 8h às 18h</li>
          </ul>

          <h2>Menu de Navegação (Lateral ou Superior)</h2>
          <p>Para abrir o menu, toque no ícone de três linhas (&#9776;) no canto superior direito.</p>
          <p>No menu, você encontra:</p>
          <ul>
            <li>Prontuários - Histórico resumido dos atendimentos e anotações médicas.</li>
            <li>Laudos - Relatórios e diagnósticos emitidos para o paciente.</li>
            <li>Exames / Cirurgias - Lista de exames realizados e procedimentos cirúrgicos.</li>
            <li>Receitas / Medicamentos - Prescrições emitidas e medicamentos em uso.</li>
            <li>Atestados - Atestados anteriores e emissão de novos documentos.</li>
          </ul>

          <p class="sub" style="margin-top:22px;">Não consigo visualizar um prontuário. Por quê?</p>
          <p>Algumas informações podem ser restritas conforme o nível de permissão da unidade. Verifique com a administração.</p>
        </div>
      </div>

    </div>
  </main>
</body>
</html>