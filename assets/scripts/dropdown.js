document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll('.sidebar .sidebar-link');
    let activeSubMenu = null;

    sidebarLinks.forEach(function (element) {
        element.addEventListener('click', function (e) {
            let nextEl = element.nextElementSibling;

            if (nextEl && nextEl.classList.contains('submenu')) {
                e.preventDefault();

                if (nextEl === activeSubMenu) {
                    // Clicked on the active submenu, so close it
                    new bootstrap.Collapse(nextEl).hide();
                    activeSubMenu = null;

                    // Remove the "active" id from the previously active submenu/nav-item
                    const activeParentLi = nextEl.closest('.nav-item');
                    if (activeParentLi) {
                        activeParentLi.removeAttribute('id');
                        // Toggle icon classes to "bi-plus" when closing
                        activeParentLi.querySelector('.icon-plus').classList.remove('d-none');
                        activeParentLi.querySelector('.icon-dash').classList.add('d-none');
                    }
                } else {
                    // Clicked on a different submenu, so close the active one (if any) and open the new one
                    if (activeSubMenu) {
                        new bootstrap.Collapse(activeSubMenu).hide();
                        // Remove the "active" id from the previously active submenu/nav-item
                        const activeParentLi = activeSubMenu.closest('.nav-item');
                        if (activeParentLi) {
                            activeParentLi.removeAttribute('id');
                            // Toggle icon classes to "bi-plus" when closing
                            activeParentLi.querySelector('.icon-plus').classList.remove('d-none');
                            activeParentLi.querySelector('.icon-dash').classList.add('d-none');
                        }
                    }
                    new bootstrap.Collapse(nextEl).show();
                    activeSubMenu = nextEl;

                    // Add the "active" id to the clicked submenu/nav-item
                    const activeParentLi = nextEl.closest('.nav-item');
                    if (activeParentLi) {
                        activeParentLi.setAttribute('id', 'active');
                        // Toggle icon classes to "bi-dash" when opening
                        activeParentLi.querySelector('.icon-plus').classList.add('d-none');
                        activeParentLi.querySelector('.icon-dash').classList.remove('d-none');
                    }
                }
            }
        });
    });
});
