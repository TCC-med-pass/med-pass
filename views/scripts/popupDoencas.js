document.addEventListener("DOMContentLoaded", () => {
    const abrir = document.getElementById("acionarPopup");
    const fechar = document.getElementById("fecharPopup");
    const popup = document.getElementById("popup");

    abrir.addEventListener("click", () => {
        popup.classList.add("ativo");
    });

    fechar.addEventListener("click", () => {
        popup.classList.remove("ativo");
    });
})