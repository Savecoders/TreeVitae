const data = [
  {
    title: 'CamioncitosSa',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    users: 10,
    links: 10,
    hearts: 10,
    images: 10,
  },
  {
    title: 'CamioncitosBolivar',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    users: 10,
    links: 10,
    hearts: 10,
    images: 10,
  },
  {
    title: 'CamioncitosVivanco',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    users: 10,
    links: 10,
    hearts: 10,
    images: 10,
  },
  {
    title: 'TreeVitae',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    users: 10,
    links: 10,
    hearts: 10,
    images: 10,
  },
  {
    title: 'TreeVitae',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    users: 10,
    links: 10,
    hearts: 10,
    images: 10,
  },
  {
    title: 'TreeVitae',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    users: 10,
    links: 10,
    hearts: 10,
    images: 10,
  },
];

const dataCopy = Object.assign([], data);

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

// tradicional
// const containerCard = document.querySelector('.container__cards');

const containerCard = $('.container__cards');

function createCard({ title, description, image, users, links, hearts, images }) {
  const card = `
            <aside class="card">
            <div class="media__row">
            <figure class="media__item">
            <img src="../../assets/icons/users.svg" alt="user-icon" />
            <small>${users}</small>
            </figure>
            <figure class="media__item">
            <img src="../../assets/icons/link-2.svg" alt="link-icon" />
            <small>${links}</small>
            </figure>
            <figure class="media__item">
            <img src="../../assets/icons/heart-pulse.svg" alt="heart-icon" />
            <small>${hearts}</small>
              </figure>
              <figure class="media__item">
                <img src="../../assets/icons/image.svg" alt="image-icon" />
                <small>${images}</small>
              </figure>
            </div>
            <article class="card__content">
              <a class="card__title" href="./view.html">${title}</a>
              <p class="card__description">
                ${description}
                </p>
                </article>
                <picture class="card__picture">
                <img src=${image} alt=${title} />
                </picture>
                </aside>`;

  containerCard.innerHTML += card;
}

const btnLoadMore = document.getElementById('loadMore');

// patron observer
btnLoadMore.addEventListener('click', () => {
  const childrens = containerCard.children.length;

  if (childrens < 25) {
    for (let i = 0; i < 6; i++) {
      createCard(data[1]);
    }
  } else {
    alert('no more iniciativas');
  }
});

// search input and button

const searchInput = $('#searchInput');

const btnSearch = $('#btnSearch');

const filterCardInContainer = textCriteria => {
  // convert NodeList to array -> containerCard.children is a NodeList
  const elementByContainer = [...containerCard.children]; // array elements
  const getFindsElements = elementByContainer.filter(el => {
    const title = el.querySelector('.card__title').textContent;
    return title.includes(textCriteria);
  });

  containerCard.innerHTML = '';
  getFindsElements.forEach(el => {
    // append child | agregar un elemento hijo
    containerCard.appendChild(el);
  });
};

const pageLoad = () => {
  data.forEach(el => {
    createCard(el);
  });
};

btnSearch.addEventListener('click', () => {
  const textCriteria = searchInput.value;
  if (textCriteria) {
    filterCardInContainer(textCriteria);
  } else {
    containerCard.innerHTML = '';
    pageLoad();
  }
});
//siempre se va a ejecutar la pagina
pageLoad();

const cards = $$('.card');

cards.forEach(card => {
  card.addEventListener('click', () => {
    if (card.classList.contains('card--clicked')) {
      card.classList.remove('card--clicked');
    } else {
      card.classList.add('card--clicked');
    }
  });
});
