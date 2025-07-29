document.getElementById("toggleSidebar").addEventListener("click", function () {
    var sidebar = document.getElementById("sidebar");
    var mainContent = document.getElementById("mainContent");
    var logoCont = document.getElementById("logo_cont");

    logoCont.classList.toggle("dis_none");
    sidebar.classList.toggle("collapsed");
    mainContent.classList.toggle("collapsed");
});
document.querySelectorAll(".has-submenu > a").forEach((link) => {
    link.addEventListener("click", function (e) {
        e.preventDefault();
        const parentLi = this.parentElement;
        const submenu = parentLi.querySelector(".nav-treeview");

        // Toggle active class for the clicked item
        parentLi.classList.toggle("active");

        // Smoothly toggle the submenu
        if (parentLi.classList.contains("active")) {
            submenu.style.maxHeight = submenu.scrollHeight + "px"; // Expand
        } else {
            submenu.style.maxHeight = null; // Collapse
        }

        // Only close sibling menus, not child menus
        document
            .querySelectorAll(".nav-item.has-submenu.active")
            .forEach((item) => {
                if (item !== parentLi && !parentLi.contains(item)) {
                    item.classList.remove("active");
                    const siblingSubmenu = item.querySelector(".nav-treeview");
                    siblingSubmenu.style.maxHeight = null; // Collapse sibling submenus
                }
            });
    });
});
