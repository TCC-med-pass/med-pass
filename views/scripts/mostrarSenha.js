document.addEventListener("DOMContentLoaded", () => {
    const botoesMostrarSenha = document.querySelectorAll(".mostrarSenha");

    botoesMostrarSenha.forEach(botao => {
        botao.addEventListener("click", () => {
            const targetId = botao.getAttribute("data-target");
            const inputSenha = document.getElementById(targetId);

            if (inputSenha) {
                if (inputSenha.type === "password") {
                    inputSenha.type = "text";
                } else {
                    inputSenha.type = "password";
                }
            }
        });
    });
});
