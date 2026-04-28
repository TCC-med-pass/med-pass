<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Selecione um Paciente</title>
  <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="paciente.css">
</head>
<body>

  <!-- ── HEADER ── -->
  <div class="topbar">
    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-house"></i>
    </a>
    <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass" class="logo-img" />
    <a href="#" class="topbar-icon">
      <i class="fa-solid fa-bars"></i>
    </a>
  </div>

  <!-- ── SUBHEADER / VOLTAR ── -->
  <div class="subheader">
    <a class="back-btn" href="#">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      Voltar
    </a>
    <span class="subheader-title">Selecione um paciente</span>
  </div>

  <!-- ── MAIN ── -->
  <main>

    <!-- Search -->
    <div class="search-wrapper">
      <input class="search-input" type="text" value="123456" placeholder="Buscar paciente..." />
      <button class="clear-btn" onclick="document.querySelector('.search-input').value = ''">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <!-- Grid -->
    <div class="grid">

      <!-- Felipe Cesco da Silva — Comorbidade grave -->
    <a class="card grave" href="#">
      <div class="card-name">Felipe Cesco da Cilva</div>
      <div class="card-body">
        <div><strong>Data nascimento:</strong> 10/11/2005</div>
        <div class="card-severity">Comorbidade grave</div>
      </div>
    </a>

      <!-- Carlos Belli — Comorbidade leve -->
    <a class="card leve" href="#">
      <div class="card-name">Carlos Belli</div>
      <div class="card-body">
        <div><strong>Data nascimento:</strong> 01/11/2003</div>
        <div class="card-severity">Comorbidade leve</div>
      </div>
    </a>

      <!-- Davi Campos — Comorbidade leve -->
    <a class="card leve" href="#">
      <div class="card-name">Davi Campos</div>
      <div class="card-body">
        <div><strong>Data nascimento:</strong> 10/01/2002</div>
        <div class="card-severity">Comorbidade leve</div>
      </div>
    </a>

      <!-- Carlos Matheus — Sem comorbidades -->
    <a class="card sem" href="#">
      <div class="card-name">Carlos Matheus</div>
      <div class="card-body">
        <div><strong>Data nascimento:</strong> 07/11/1990</div>
        <div class="card-severity">Sem comorbidades</div>
      </div>
    </a>

      <!-- Ana Beatriz Pereira Costa — Comorbidade grave -->
    <a class="card grave" href="#">
      <div class="card-name">Ana Beatriz Pereira Costa</div>
      <div class="card-body">
        <div><strong>Data nascimento:</strong> 10/11/1989</div>
        <div class="card-severity">Comorbidade grave</div>
      </div>
    </a>
    
    </div>
  </main>

</body>
</html>