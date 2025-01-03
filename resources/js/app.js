import './bootstrap';

const passwordInput = document.getElementById('password');
const togglePasswordButton = document.getElementById('togglePassword');
const eyeOpenIcon = document.getElementById('eyeOpen');
const eyeClosedIcon = document.getElementById('eyeClosed');

togglePasswordButton.addEventListener('click', () => {
const isPasswordHidden = passwordInput.type === 'password';
passwordInput.type = isPasswordHidden ? 'text' : 'password';
eyeOpenIcon.classList.toggle('hidden', !isPasswordHidden);
eyeClosedIcon.classList.toggle('hidden', isPasswordHidden);
});