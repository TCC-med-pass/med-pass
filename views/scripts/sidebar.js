(function initSidebar() {
    const icon = document.querySelector(".menu-icon");
    const sidebar = document.getElementById("sidebar");
    const carteirinha = document.getElementById("carteirinha");

    if (!icon || !sidebar) return;

    icon.addEventListener("click", (event) => {
        event.stopPropagation();
        icon.classList.toggle("active");
        sidebar.classList.toggle("active");

        if (carteirinha) {
            carteirinha.classList.toggle("descer");
        }
    });

    document.addEventListener("click", (event) => {
        if (!sidebar.contains(event.target) && !icon.contains(event.target)) {
            sidebar.classList.remove("active");
            icon.classList.remove("active");
            if (carteirinha) {
                carteirinha.classList.remove("descer");
            }
        }
    });
})();
