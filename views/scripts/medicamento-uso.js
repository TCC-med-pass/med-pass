

// ── MODAL ─────────────────────────────────────────────────────────
const overlay     = document.getElementById('modalOverlay');
const btnAdd      = document.getElementById('btnAdicionar');
const btnFechar   = document.getElementById('btnFecharModal');
const form        = document.getElementById('formNovoMed');
const corpo       = document.getElementById('corpoTabela');


btnAdd.addEventListener('click', () => overlay.classList.add('active'));

function fecharModal() {
  overlay.classList.remove('active');
  form.reset();
}

 btnFechar.addEventListener('click', fecharModal);
overlay.addEventListener('click', e => { if (e.target === overlay) fecharModal(); });


// ====================================================================================
function confirmarExclusao(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `../utils/deletMedicamento.php?id=${id}`;
        }
    });
}
