const passwordField = document.getElementById('senha');
const showPasswordIcon = document.getElementById('show-password');

showPasswordIcon.addEventListener('click', () => {
  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    showPasswordIcon.classList.remove('fa-eye');
    showPasswordIcon.classList.add('fa-eye-slash');
  } else {
    passwordField.type = 'password';
    showPasswordIcon.classList.remove('fa-eye-slash');
    showPasswordIcon.classList.add('fa-eye');
  }
});
