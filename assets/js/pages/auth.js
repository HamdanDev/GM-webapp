const formLogin = document.getElementById('form-login');
const formRegister = document.getElementById('form-register');

function showRegister() {
  formLogin.classList.add('d-none');
  formRegister.classList.remove('d-none');
  const url = new URL(window.location.href);
  url.searchParams.set('mode', 'register');
  window.history.replaceState({}, '', url);
}

function showLogin() {
  formRegister.classList.add('d-none');
  formLogin.classList.remove('d-none');
  const url = new URL(window.location.href);
  url.searchParams.delete('mode');
  window.history.replaceState({}, '', url);
}

document.querySelectorAll('[data-go="register"]').forEach((link) => {
  link.addEventListener('click', showRegister);
});

document.querySelectorAll('[data-go="login"]').forEach((link) => {
  link.addEventListener('click', showLogin);
});
