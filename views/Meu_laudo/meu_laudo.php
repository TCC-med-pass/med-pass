<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meu Laudo - MedPass</title>
<link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="./meu_laudo.css">
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
  <div class="subheader-title">Meu Laudo</div>
  <div class="subheader-spacer"></div>
</div>

<main>

  <!-- ÁREA CENTRAL DO DOCUMENTO -->
  <div class="doc-wrapper">

    <!-- ZONA DE UPLOAD -->
    <label class="upload-zone">
      <input type="file" multiple accept=".pdf,.jpg,.png,.doc,.docx" onchange="handleFiles(this.files)">
      <div class="upload-icon">📎</div>
      <p>Clique para anexar documentos</p>
      <small>PDF — até 10MB por arquivo</small>
    </label>

  </div>

  <!-- BOTTOM BAR -->
    <div class="nav-number-badge">
    <p>Número da carterinha:</p>
    <span>12345678-0</span>
  </div>

</main>

<script>
function handleFiles(files) {
  const list = document.getElementById('fileList');
  Array.from(files).forEach(file => {
    const size = file.size < 1024*1024
      ? (file.size/1024).toFixed(0) + ' KB'
      : (file.size/1024/1024).toFixed(1) + ' MB';

    const ext = file.name.split('.').pop().toUpperCase();
    const icons = { PDF: '📄'};
    const icon = icons[ext] || '📎';

    const item = document.createElement('div');
    item.className = 'file-item';
    list.appendChild(item);
  });
}
</script>

</body>
</html>