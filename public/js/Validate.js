function validateForm() {
    var name = document.getElementById('name').value;
    var birthdate = document.getElementById('birthdate').value;
    var phone = document.getElementById('phone').value;
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var passwordConfirmation = document.getElementById('password_confirmation').value;
  
    if (name.trim() === '') {
        showInvalidFeedback('name', 'Por favor, ingrese su nombre.');
        return false;
    }
  
    if (birthdate.trim() === '') {
        showInvalidFeedback('birthdate', 'Por favor, ingrese su fecha de nacimiento.');
        return false;
    }
  
    if (phone.trim() === '') {
        showInvalidFeedback('phone', 'Por favor, ingrese su número de teléfono.');
        return false;
    }
  
    if (username.trim() === '') {
        showInvalidFeedback('username', 'Por favor, ingrese su usuario.');
        return false;
    }
  
    if (email.trim() === '') {
        showInvalidFeedback('email', 'Por favor, ingrese su email.');
        return false;
    }
  
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showInvalidFeedback('email', 'Por favor, ingrese un correo electrónico válido.');
        return false;
    }

    if (password.length < 8) {
        showInvalidFeedback('password', 'La contraseña debe tener al menos 8 caracteres.');
        return false;
    }
  
    if (password !== passwordConfirmation) {
        showInvalidFeedback('password_confirmation', 'Las contraseñas no coinciden.');
        return false;
    }
  
    return true;
}

function validateFormLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    if (username.trim() === '') {
        showInvalidFeedback('username', 'Por favor, ingrese su usuario.');
        return false;
    }
  
    if (birthdate.trim() === '') {
        showInvalidFeedback('birthdate', 'Por favor, ingrese su fecha de nacimiento.');
        return false;
    }
  
    if (phone.trim() === '') {
        showInvalidFeedback('phone', 'Por favor, ingrese su número de teléfono.');
        return false;
    }
  
    if (username.trim() === '') {
        showInvalidFeedback('username', 'Por favor, ingrese su usuario.');
        return false;
    }
  
    if (password.trim() === '') {
        showInvalidFeedback('password', 'Por favor, ingrese su contraseña.');
        return false;
    }
  
    return true;
}

function showInvalidFeedback(inputId, message) {
    var input = document.getElementById(inputId);
    input.classList.add('is-invalid');
    var feedback = input.nextElementSibling;
    feedback.innerText = message;
}