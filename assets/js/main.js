document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.main-nav');

    if (toggle && nav) {
        toggle.setAttribute('aria-expanded', nav.classList.contains('is-open') ? 'true' : 'false');

        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    if (window.lucide) {
        window.lucide.createIcons();
    }

    if (window.AOS) {
        window.AOS.init({
            duration: 700,
            once: true,
            easing: 'ease-out',
            offset: 80
        });
    }
});
