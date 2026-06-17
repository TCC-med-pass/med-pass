document.addEventListener("DOMContentLoaded", () => {
    const botoes = document.querySelectorAll('.editar');
    const popup = document.getElementById('campoEditar');
    const fechar = document.getElementById('fecharPopup');

    if (!botoes || botoes.length === 0) return;

    botoes.forEach(btn => {
        btn.addEventListener('click', () => {
            const parentesco = btn.dataset.parentesco || '';
            const doenca = btn.dataset.doenca || '';
            const descricao = btn.dataset.descricao || '';
            const nivel = btn.dataset.nivel || '';
            const id = btn.dataset.id || '';

            const form = popup ? popup.querySelector('form') : null;

            if (form) {
                const inputParentesco = form.querySelector('[name="parentesco"]');
                const inputDoenca = form.querySelector('[name="doenca"]') || form.querySelector('[name="doença"]');
                const inputDescricao = form.querySelector('[name="descricao"]');
                const selectNivel = form.querySelector('[name="nivel"]');
                const inputId = form.querySelector('#id_historico');

                if (inputParentesco) inputParentesco.value = parentesco;
                if (inputDoenca) inputDoenca.value = doenca;
                if (inputDescricao) inputDescricao.value = descricao;
                if (selectNivel) selectNivel.value = nivel;
                if (inputId) inputId.value = id;
            }

            if (popup) popup.classList.add('ativo');
        });
    });

    if (fechar) {
        fechar.addEventListener('click', () => {
            if (popup) popup.classList.remove('ativo');
        });
    }
});