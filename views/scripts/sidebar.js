document.addEventListener("DOMContentLoaded", () => {
    // Função do menu hamburger
        function toggleSidebar() {
            const icon = document.querySelector(".menu-icon");
            const sidebar = document.getElementById("sidebar");
    
            if (!icon || !sidebar) return;
    
            icon.addEventListener("click", () => {
                icon.classList.toggle("active");
                sidebar.classList.toggle("active");
            });
        }
});
