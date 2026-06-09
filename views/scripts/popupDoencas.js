document.addEventListener("DOMContentLoaded", () => {
    const botoesEditar = document.querySelectorAll(".editar");
    const fechar = document.getElementById("fecharPopup");
    const popup = document.getElementById("campoEditar");

    botoesEditar.forEach(botao => {
        botao.addEventListener("click", () => {
            popup.classList.add("ativo");
        });
    });

    fechar.addEventListener("click", () => {
        popup.classList.remove("ativo");
    });
});

document.querySelectorAll('.editar').forEach(botao => {

    botao.addEventListener('click', () => {

        const idHistorico = botao.dataset.id;

        document.getElementById('id_historico').value = idHistorico;
    });

});