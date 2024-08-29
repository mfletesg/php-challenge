class RegisterUser {
    constructor() {}

    formValidate(event) {
        event.preventDefault(); // Prevenir el envío del formulario

        let valid = true;

        const username = document.getElementById('inputUserName').value.trim();
        const password = document.getElementById('inputPassword').value.trim();
        const confirmPassword = document.getElementById('inputConfirmPassword').value.trim();
    
        // Validaciones simples
        if (username === '') {
            document.getElementById('usernameError').innerText = 'El nombre de usuario es obligatorio';
            valid = false;
        }
        if (password === '') {
            document.getElementById('passwordError').innerText = 'La contraseña es obligatoria';
            valid = false;
        } else if (password.length < 6) {
            document.getElementById('passwordError').innerText = 'La contraseña debe tener al menos 6 caracteres';
            valid = false;
        }
    
        if (password !== confirmPassword) {
            document.getElementById('passwordError').innerText = 'La contraseña no coincide';
            valid = false;
        }
    
        if (valid) {
            document.getElementById('registrationForm').submit();
        }
    }
}

// Crear una instancia de la clase
const registerUser = new RegisterUser();