document.addEventListener('DOMContentLoaded', function () {
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');
    const toggleIcon = document.getElementById('toggleIcon');
    const mainNavbar = document.getElementById('mainNavbar');

    // Toggle Mobile Menu
    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            
            if (navMenu.classList.contains('active')) {
                toggleIcon.classList.remove('fa-bars');
                toggleIcon.classList.add('fa-xmark');
            } else {
                toggleIcon.classList.remove('fa-xmark');
                toggleIcon.classList.add('fa-bars');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (e) {
            if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-xmark');
                    toggleIcon.classList.add('fa-bars');
                }
            }
        });

        // Close menu when clicking a link inside
        const menuLinks = navMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                navMenu.classList.remove('active');
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-xmark');
                    toggleIcon.classList.add('fa-bars');
                }
            });
        });
    }

    // Scroll Navbar Effect
    window.addEventListener('scroll', function () {
        if (mainNavbar) {
            if (window.scrollY > 40) {
                mainNavbar.classList.add('scrolled');
            } else {
                mainNavbar.classList.remove('scrolled');
            }
        }
    });
});
