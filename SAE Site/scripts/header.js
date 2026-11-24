document.addEventListener('DOMContentLoaded', function () {
  const toggleButton = document.querySelector('.mobile-menu-toggle');
  const navMenu = document.querySelector('header nav');

  toggleButton.addEventListener('click', function () {
    navMenu.classList.toggle('open');
    document.body.classList.toggle('nav-open');
  });

  // Close menu when clicking outside
  document.body.addEventListener('click', function (e) {
    if (!navMenu.contains(e.target) && !toggleButton.contains(e.target)) {
      navMenu.classList.remove('open');
      document.body.classList.remove('nav-open');
    }
  });
});
