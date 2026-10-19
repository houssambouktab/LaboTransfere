(function () {
    'use strict';

    var form = document.querySelector('[data-login-form]');
    if (!form) return;

    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var passwordToggle = document.querySelector('[data-password-toggle]');
    var submitButton = document.querySelector('[data-submit-button]');
    var buttonLabel = document.querySelector('[data-button-label]');
    var demoMessage = document.querySelector('[data-demo-message]');
    var emailError = document.querySelector('[data-email-error]');
    var passwordError = document.querySelector('[data-password-error]');

    passwordToggle.addEventListener('click', function () {
        var isVisible = password.type === 'text';
        password.type = isVisible ? 'password' : 'text';
        passwordToggle.classList.toggle('is-visible', !isVisible);
        passwordToggle.setAttribute('aria-label', isVisible ? 'Afficher le mot de passe' : 'Masquer le mot de passe');
    });

    function setError(input, messageElement, message) {
        var wrapper = input.closest('.input-wrap');
        messageElement.textContent = message;
        messageElement.classList.toggle('is-visible', Boolean(message));
        wrapper.classList.toggle('has-error', Boolean(message));
    }

    function validate() {
        var valid = true;
        var emailValue = email.value.trim();
        var passwordValue = password.value;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailValue) {
            setError(email, emailError, 'Veuillez renseigner votre adresse e-mail.');
            valid = false;
        } else if (!emailPattern.test(emailValue)) {
            setError(email, emailError, 'Veuillez saisir une adresse e-mail valide.');
            valid = false;
        } else {
            setError(email, emailError, '');
        }

        if (!passwordValue) {
            setError(password, passwordError, 'Veuillez renseigner votre mot de passe.');
            valid = false;
        } else {
            setError(password, passwordError, '');
        }
        return valid;
    }

    email.addEventListener('input', function () { if (email.value) validate(); });
    password.addEventListener('input', function () { if (password.value) validate(); });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (submitButton.classList.contains('is-loading') || !validate()) return;

        submitButton.classList.add('is-loading');
        submitButton.disabled = true;
        buttonLabel.textContent = 'Vérification en cours…';
        window.setTimeout(function () {
            submitButton.classList.remove('is-loading');
            submitButton.disabled = false;
            buttonLabel.textContent = 'Se connecter';
            demoMessage.classList.add('is-visible');
        }, 1100);
    });
}());
