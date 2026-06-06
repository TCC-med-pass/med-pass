// ──────────────────────────────────────────────
//  MedPass – Novo Prontuário  |  novo-prontuario.js
// ──────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {

  // ── Elementos ──────────────────────────────
  const uploadBox   = document.getElementById('uploadBox');
  const fileInput   = document.getElementById('arquivo');
  const uploadLabel = document.getElementById('uploadLabel');
  const form        = document.getElementById('formProntuario');
  const btnCancelar = document.getElementById('btnCancelar');
  const btnVoltar   = document.getElementById('btnVoltar');

  // Campos de data
  const dataEmissao  = document.getElementById('dataEmissao');
  const dataValidade = document.getElementById('dataValidade');

  // ── Máscara de data (DD/MM/AAAA) ───────────
  function aplicarMascara(input) {
    if (!input) return;
    // Se for input do tipo date (YYYY-MM-DD), não aplicar máscara DD/MM/AAAA.
    // A máscara vai quebrar o valor e pode deixar o campo vazio no submit.
    if (input.type === 'date') return;

    const aplicar = () => {
      const raw = input.value ?? '';
      const vDigits = raw.replace(/\D/g, '').slice(0, 8);
      if (vDigits.length === 0) return; // evita limpar o campo por eventos intermediários

      let v = vDigits;
      if (v.length > 4) v = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4);
      else if (v.length > 2) v = v.slice(0, 2) + '/' + v.slice(2);

      input.value = v;
    };

    input.addEventListener('input', aplicar);
    input.addEventListener('change', aplicar);
    input.addEventListener('blur', aplicar);
  }

  aplicarMascara(dataEmissao);
  aplicarMascara(dataValidade);

  // ── Constantes ─────────────────────────────
  const TIPOS_ACEITOS  = ['application/pdf', 'image/jpeg', 'image/png'];
  const EXTENSOES      = ['.pdf'];
  const TAMANHO_MAX_MB = 10;


  // ── Upload: clicar na caixa ─────────────────
  uploadBox.addEventListener('click', () => fileInput.click());

  // ── Upload: drag & drop ────────────────────
  uploadBox.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadBox.classList.add('drag-over');
  });

  uploadBox.addEventListener('dragleave', () => {
    uploadBox.classList.remove('drag-over');
  });

  uploadBox.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadBox.classList.remove('drag-over');
    const arquivo = e.dataTransfer.files[0];
    if (arquivo) processarArquivo(arquivo);
  });

  // ── Upload: seleção via input ──────────────
  fileInput.addEventListener('change', () => {
    const arquivo = fileInput.files[0];
    if (arquivo) processarArquivo(arquivo);
  });

  // ── Processar arquivo selecionado ──────────
  function processarArquivo(arquivo) {
    // Validar tipo
    if (!TIPOS_ACEITOS.includes(arquivo.type)) {
      mostrarErroUpload(`Formato inválido. Aceitos: ${EXTENSOES.join(', ')}`);
      limparInput();
      return;
    }

    // Validar tamanho
    const tamanhoMB = arquivo.size / (1024 * 1024);
    if (tamanhoMB > TAMANHO_MAX_MB) {
      mostrarErroUpload(`Arquivo muito grande. Máximo: ${TAMANHO_MAX_MB} MB`);
      limparInput();
      return;
    }

    // Garantir que o arquivo fique no <input type="file">
    // (em alguns browsers, fileInput.files é somente-leitura; por isso usamos DataTransfer)
    const dt = new DataTransfer();
    dt.items.add(arquivo);
    fileInput.files = dt.files;

    mostrarPreview(arquivo);
  }

  // ── Mostrar preview do arquivo ─────────────
  function mostrarPreview(arquivo) {
    // Remove preview anterior se existir
    removerPreviewExistente();

    uploadBox.classList.add('has-file');
    uploadBox.classList.remove('upload-error');

    // Ícone por tipo
    const icone = document.querySelector('#uploadBox .upload-icon');
    icone.className = 'fa-solid upload-icon';
    if (arquivo.type === 'application/pdf') {
      icone.classList.add('fa-file-pdf');
      icone.style.color = '#e53935';
    } else {
      icone.classList.add('fa-file-image');
      icone.style.color = '#0097a7';
    }

    // Nome + tamanho
    const tamanhoMB = (arquivo.size / (1024 * 1024)).toFixed(2);
    uploadLabel.innerHTML = `
      <span class="file-name">${arquivo.name}</span>
      <span class="file-size">${tamanhoMB} MB</span>
    `;

    // Botão remover
    const btnRemover = document.createElement('button');
    btnRemover.type = 'button';
    btnRemover.className = 'btn-remover-arquivo';
    btnRemover.title = 'Remover arquivo';
    btnRemover.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    btnRemover.addEventListener('click', (e) => {
      e.stopPropagation();
      limparUpload();
    });
    uploadBox.appendChild(btnRemover);

    // Preview de imagem
    if (arquivo.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = (ev) => {
        const img = document.createElement('img');
        img.src = ev.target.result;
        img.className = 'img-preview';
        img.alt = 'Preview';
        uploadBox.appendChild(img);
      };
      reader.readAsDataURL(arquivo);
    }
  }

  // ── Mostrar erro de upload ─────────────────
  function mostrarErroUpload(mensagem) {
    uploadBox.classList.add('upload-error');
    uploadBox.classList.remove('has-file');

    const icone = document.querySelector('#uploadBox .upload-icon');
    icone.className = 'fa-solid fa-triangle-exclamation upload-icon';
    icone.style.color = '#e53935';

    uploadLabel.textContent = mensagem;

    // Volta ao estado normal após 3s
    setTimeout(() => {
      if (uploadBox.classList.contains('upload-error')) limparUpload();
    }, 3000);
  }

  // ── Limpar estado do upload ────────────────
  function limparUpload() {
    removerPreviewExistente();
    limparInput();
    uploadBox.classList.remove('has-file', 'upload-error');

    const icone = document.querySelector('#uploadBox .upload-icon');
    icone.className = 'fa-solid fa-cloud-arrow-up upload-icon';
    icone.style.color = '';

    uploadLabel.textContent = 'Anexar Documentos Médicos';
  }

  function removerPreviewExistente() {
    const btnAntigo = uploadBox.querySelector('.btn-remover-arquivo');
    const imgAntiga = uploadBox.querySelector('.img-preview');
    if (btnAntigo) btnAntigo.remove();
    if (imgAntiga) imgAntiga.remove();
  }

  function limparInput() {
    fileInput.value = '';
  }

   // ── Validação e envio do formulário ─────────
   form.addEventListener('submit', (e) => {
     const nome   = document.getElementById('nome').value.trim();
     const status = document.getElementById('status').value.trim();
     const tipo   = document.getElementById('tipo').value;

     let temErro = false;

     if (!nome) {
       alertaCampo('nome', 'Informe o nome do prontuário');
       temErro = true;
     }
     if (!status) {
       alertaCampo('status', 'Informe o status');
       temErro = true;
     }
     if (!tipo) {
       alertaCampo('tipo', 'Selecione o tipo');
       temErro = true;
     }
     if (fileInput.files.length === 0) {
       mostrarErroUpload('Selecione um arquivo para anexar.');
       temErro = true;
     }

     if (temErro) {
       e.preventDefault();
     }
     // Se não houver erro, o formulário será enviado normalmente
   });

  function alertaCampo(id, msg) {
    const el = document.getElementById(id);
    el.focus();
    el.classList.add('campo-invalido');
    el.addEventListener('input', () => el.classList.remove('campo-invalido'), { once: true });
    mostrarToast(msg, 'erro');
  }

  // ── Toast de feedback ──────────────────────
  function mostrarToast(msg, tipo) {
    const toast = document.createElement('div');
    toast.className = `toast toast-${tipo}`;
    toast.innerHTML = `
      <i class="fa-solid ${tipo === 'sucesso' ? 'fa-circle-check' : 'fa-circle-exclamation'}"></i>
      ${msg}
    `;
    document.body.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('toast-show'));
    setTimeout(() => {
      toast.classList.remove('toast-show');
      setTimeout(() => toast.remove(), 400);
    }, 3000);
  }

  // ── Cancelar / Voltar ──────────────────────
  btnCancelar.addEventListener('click', () => {
    if (confirm('Deseja cancelar? As alterações serão perdidas.')) {
      form.reset();
      limparUpload();
    }
  });

  btnVoltar.addEventListener('click', (e) => {
    e.preventDefault();
    history.back();
  });

});
