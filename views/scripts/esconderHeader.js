document.addEventListener("DOMContentLoaded", () => {
    const header = document.getElementById("header");
    const sidebar = document.getElementById("sidebar");

    if (!header || !sidebar) return;

    let ultimoScroll = 0;

    window.addEventListener("scroll", () => {
        // Verifica se existe scroll
        const scroll = document.body.scrollHeight > window.innerHeight;

        // Sidebar aberta
        const sidebarAberta = sidebar.classList.contains("active");

        //Sem scroll ou sidebar aberta
        if (!scroll || sidebarAberta) {
            header.classList.remove("esconder");
            return;
        }

        const scrollAtual = window.scrollY;

        // Evita bug no topo
        if (scrollAtual <= 0) {
            header.classList.remove("esconder");
            return;
        }

        //Scroll pra baixo
        if (scrollAtual > ultimoScroll) {
            header.classList.add("esconder");
        } else { //scroll pra cima
            header.classList.remove("esconder");
        }

        ultimoScroll = scrollAtual;
    })
});