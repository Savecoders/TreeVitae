const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

//  components navbar
const navHamburguer = $('.nav__hamburguer');
const navOverlay = $('.nav__overlay');
const listCanOpen = $$('.can__open');

let currentDropdown = navOverlay;

navHamburguer.addEventListener('click', () => {
  navHamburguer.classList.toggle('nav__hamburguer--open');
  navOverlay.classList.toggle('nav__overlay--show');
});

// overlay listner
listCanOpen.forEach(list => {
  list.addEventListener('click', e => {
    e.preventDefault();
    const currentElement = e.target;
    const arrow = currentElement.children[0];

    // replace arrow fa-solid fa-angle-down arrow__down
    if (arrow.classList.contains('fa-angle-down')) {
      arrow.classList.replace('fa-angle-down', 'fa-angle-up');
    } else {
      arrow.classList.replace('fa-angle-up', 'fa-angle-down');
    }

    if (isActive(currentElement, 'nav__parent')) {
      const subMenu = currentElement.parentElement.children[1];

      if (window.innerWidth < 1200) {
        let height = subMenu.clientHeight == 0 ? subMenu.scrollHeight : 0;

        subMenu.style.height = `${height}px`;
      } else {
        if (!isActive(subMenu, 'nav__inner--show')) {
          closeDropdown(currentDropdown);
        }
        subMenu.classList.toggle('nav__inner--show');

        currentDropdown = subMenu;
      }
    }
  });
});

function isActive(element, string) {
  return element.classList.value.includes(string);
}

function closeDropdown(currentDropdown) {
  if (isActive(currentDropdown, 'nav__inner--show')) {
    currentDropdown.classList.remove('nav__inner--show');
  }
}

window.addEventListener('resize', () => {
  closeDropdown(currentDropdown);

  if (window.innerWidth > 1200) {
    const navInners = document.querySelectorAll('.nav__inner');

    navInners.forEach(navInner => {
      navInner.style.height = '';
    });
  }
});
