const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

//  components navbar
const navHamburguer = $('.nav__hamburguer');
const navOverlay = $('.nav__overlay');

navHamburguer.addEventListener('click', () => {
  navHamburguer.classList.toggle('nav__hamburguer--open');
  navOverlay.classList.toggle('nav__overlay--show');
});
