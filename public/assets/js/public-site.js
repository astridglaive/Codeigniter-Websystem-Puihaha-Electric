document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const confirmation = document.getElementById('confirm_password');

    if (password && confirmation) {
        confirmation.addEventListener('input', function () {
            confirmation.setCustomValidity(
                password.value === confirmation.value ? '' : 'Passwords do not match'
            );
        });
    }

    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function () {
            const button = form.querySelector('button[type="submit"]');
            if (button && form.checkValidity()) {
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            }
        });
    });
});
