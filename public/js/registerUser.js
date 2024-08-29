class RegisterUser {
    constructor() {}

    formValidate(event) {
        event.preventDefault(); // Prevenir el envío del formulario

        let valid = true;

        const username = document.getElementById('inputUserName').value.trim();
        const password = document.getElementById('inputPassword').value.trim();
        const confirmPassword = document.getElementById('inputConfirmPassword').value.trim();
        let message = '';
        // Validaciones simples
        if (username === '') {
            message = 'El nombre de usuario es obligatorio';
            valid = false;
        }
        if (password === '') {
            message = 'La contraseña es obligatoria';
            valid = false;
        } else if (password.length < 6) {
            message = 'La contraseña debe tener al menos 6 caracteres';
            valid = false;
        }
    
        if (password !== confirmPassword) {
            message = 'La contraseña no coincide';
            valid = false;
        }
    
        if (valid) {
            document.getElementById('registrationForm').submit();
        }
        else{
            let html = `<div class='alert alert-warning' role='alert'>${message}</div>`
            document.getElementById('passwordError').innerHTML = html
        }
    }
}

// Crear una instancia de la clase
const registerUser = new RegisterUser();