document.addEventListener('DOMContentLoaded', function () {
    var deleteForms = document.querySelectorAll('[data-confirm]');

    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            var message = form.getAttribute('data-confirm') || 'Confirmer cette action ?';
            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    });
});
