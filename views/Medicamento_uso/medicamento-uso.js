// ── DADOS (simula banco, usado na página de detalhe) ──────────────
const medicamentos = [
  { id: 0, nome: "Osimertinib (Tagrisso)",      dose: "80 mg",                      freq: "1 Comprimido, uma vez ao dia (Diário)", inicio: "15/03/2024", fim: "Uso contínuo",            medico: "Dr. Guilherme Telles",       obs: "Tomar em jejum, 1h antes das refeições." },
  { id: 1, nome: "Pemetrexede",                  dose: "500 mg/m²",                  freq: "A cada 21 dias",                        inicio: "10/01/2024", fim: "10/07/2024",              medico: "Dr. Bruno Zaia",             obs: "Pré-medicação com ácido fólico e vitamina B12." },
  { id: 2, nome: "Insulina Glargina (Lantus)",   dose: "14 unidades",                freq: "1 Vez ao dia",                          inicio: "05/06/2023", fim: "Uso contínuo",            medico: "Dr. Gustavo Ceschim Britto", obs: "Aplicar sempre no mesmo horário." },
  { id: 3, nome: "Insulina Asparte (Novorapid)", dose: "Variável, calculada por bomba", freq: "1U a cada 10g de Carboidrato",      inicio: "05/06/2023", fim: "Uso contínuo",            medico: "Dr. Gustavo Ceschim Britto", obs: "Aplicar imediatamente antes das refeições." },
];

// Persiste no sessionStorage para a página de detalhe ler
sessionStorage.setItem('medPass_meds', JSON.stringify(medicamentos));

// ── MÁSCARA DE DATA ───────────────────────────────────────────────
function mascaraData(input) {
  input.addEventListener('input', function () {
    let v = this.value.replace(/\D/g, '').slice(0, 8);
    if (v.length >= 5) v = v.slice(0,2) + '/' + v.slice(2,4) + '/' + v.slice(4);
    else if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
    this.value = v;
  });
}

// ── REMOVER LINHA ─────────────────────────────────────────────────
function removerLinha(btn) {
  if (confirm('Deseja remover este medicamento?')) {
    btn.closest('tr').remove();
  }
}

// ── MODAL ─────────────────────────────────────────────────────────
const overlay     = document.getElementById('modalOverlay');
const btnAdd      = document.getElementById('btnAdicionar');
const btnFechar   = document.getElementById('btnFecharModal');
const form        = document.getElementById('formNovoMed');
const corpo       = document.getElementById('corpoTabela');

mascaraData(document.getElementById('mInicio'));
mascaraData(document.getElementById('mFim'));

btnAdd.addEventListener('click', () => overlay.classList.add('active'));

function fecharModal() {
  overlay.classList.remove('active');
  form.reset();
}

btnFechar.addEventListener('click', fecharModal);
overlay.addEventListener('click', e => { if (e.target === overlay) fecharModal(); });

form.addEventListener('submit', function (e) {
  e.preventDefault();

  const nome = document.getElementById('mNome').value.trim();
  const dose = document.getElementById('mDose').value.trim();
  const freq = document.getElementById('mFreq').value.trim();

  if (!nome || !dose || !freq) {
    alert('Preencha ao menos Nome, Dose e Frequência.');
    return;
  }

  // Salva nos dados com id único
  const novoId = Date.now();
  const novo = {
    id:     novoId,
    nome,
    dose,
    freq,
    inicio: document.getElementById('mInicio').value || '—',
    fim:    document.getElementById('mFim').value    || '—',
    medico: '—',
    obs:    document.getElementById('mObs').value    || '—',
  };
  medicamentos.push(novo);
  sessionStorage.setItem('medPass_meds', JSON.stringify(medicamentos));

  // Adiciona linha na tabela
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td>${nome}</td>
    <td>${dose}</td>
    <td>${freq}</td>
    <td class="td-acoes">
      <a href="medicamento_detalhe.html?id=${novoId}" class="tag-abrir">abrir</a>
      <button class="btn-lixeira" onclick="removerLinha(this)" title="Remover">
        <i class="fa-solid fa-trash"></i>
      </button>
    </td>
  `;
  corpo.appendChild(tr);
  fecharModal();
});