document.getElementById('togglePassword').addEventListener('click', function() {
  var passwordField = document.getElementById('password');
  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    this.textContent = 'Cacher';
  } else {
    passwordField.type = 'password';
    this.textContent = 'Afficher';
  }
});
