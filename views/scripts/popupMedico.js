document.addEventListener("DOMContentLoaded", () => {
    const abrir = document.getElementById("btnInfo");
    const fechar = document.getElementById("fecharInfo");
    const popup = document.getElementById("popup");

    abrir.addEventListener("click", () => {
        popup.classList.add("ativo");
    });

    fechar.addEventListener("click", () => {
        popup.classList.remove("ativo");
    });
})