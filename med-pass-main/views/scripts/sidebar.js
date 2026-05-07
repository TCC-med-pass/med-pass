document.addEventListener("DOMContentLoaded", () => {
    function toggleSidebar() {
        const icon = document.querySelector(".menu-icon");
        const sidebar = document.getElementById("sidebar");
        const carteirinha =  document.getElementById("carteirinha");

        if (!icon || !sidebar) return;

        icon.addEventListener("click", () => {
            icon.classList.toggle("active");
            sidebar.classList.toggle("active");

            if (carteirinha) {
                carteirinha.classList.toggle("descer");
            }
        });
    }

    toggleSidebar();
});