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

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

// tradicional
// const containerCard = document.querySelector('.container__cards');
// or
// const searchInput = document.getElementById('searchInput');
// const btnSearch = document.getElementById('btnSearch');

const containerCard = $('.container__cards');
const searchInput = $('#searchInput');
const btnSearch = $('#btnSearch');
const btnLoadMore = document.getElementById('loadMore');

const componentDefaultCard = ({ title, description, image, users, links, hearts, images }) => {
  const asideNode = document.createElement('aside');
  asideNode.classList.add('card');

  const mediaRowNode = document.createElement('div');
  mediaRowNode.classList.add('media__row');

  const mediaItemUserNode = document.createElement('figure');
  mediaItemUserNode.classList.add('media__item');

  const userIconNode = document.createElement('img');
  userIconNode.src = '../../assets/icons/users.svg';
  userIconNode.alt = 'user-icon';

  const userNode = document.createElement('small');
  userNode.textContent = users;

  mediaItemUserNode.appendChild(userIconNode);
  mediaItemUserNode.appendChild(userNode);

  const mediaItemLinkNode = document.createElement('figure');
  mediaItemLinkNode.classList.add('media__item');

  const linkIconNode = document.createElement('img');
  linkIconNode.src = '../../assets/icons/link-2.svg';
  linkIconNode.alt = 'link-icon';

  const linkNode = document.createElement('small');
  linkNode.textContent = links;

  mediaItemLinkNode.appendChild(linkIconNode);
  mediaItemLinkNode.appendChild(linkNode);

  const mediaItemHeartNode = document.createElement('figure');
  mediaItemHeartNode.classList.add('media__item');

  const heartIconNode = document.createElement('img');
  heartIconNode.src = '../../assets/icons/heart-pulse.svg';
  heartIconNode.alt = 'heart-icon';

  const heartNode = document.createElement('small');
  heartNode.textContent = hearts;

  mediaItemHeartNode.appendChild(heartIconNode);
  mediaItemHeartNode.appendChild(heartNode);

  const mediaItemImageNode = document.createElement('figure');
  mediaItemImageNode.classList.add('media__item');

  const imageIconNode = document.createElement('img');
  imageIconNode.src = '../../assets/icons/image.svg';
  imageIconNode.alt = 'image-icon';

  const imageNode = document.createElement('small');
  imageNode.textContent = images;

  mediaItemImageNode.appendChild(imageIconNode);
  mediaItemImageNode.appendChild(imageNode);

  mediaRowNode.appendChild(mediaItemUserNode);
  mediaRowNode.appendChild(mediaItemLinkNode);
  mediaRowNode.appendChild(mediaItemHeartNode);
  mediaRowNode.appendChild(mediaItemImageNode);

  const cardArticuleNode = document.createElement('article');
  cardArticuleNode.classList.add('card__content');

  const cardTitleNode = document.createElement('a');
  cardTitleNode.classList.add('card__title');
  cardTitleNode.href = './view.html';
  cardTitleNode.textContent = title;

  const cardDescriptionNode = document.createElement('p');
  cardDescriptionNode.classList.add('card__description');
  cardDescriptionNode.textContent = description;

  cardArticuleNode.appendChild(cardTitleNode);
  cardArticuleNode.appendChild(cardDescriptionNode);

  const cardPictureNode = document.createElement('picture');
  cardPictureNode.classList.add('card__picture');

  const cardPictureImgNode = document.createElement('img');
  cardPictureImgNode.src = image;
  cardPictureImgNode.alt = title;

  cardPictureNode.appendChild(cardPictureImgNode);
  cardArticuleNode.appendChild(cardTitleNode);
  cardArticuleNode.appendChild(cardDescriptionNode);

  asideNode.appendChild(mediaRowNode);
  asideNode.appendChild(cardArticuleNode);
  asideNode.appendChild(cardPictureNode);

  asideNode.addEventListener('click', () => {
    if (asideNode.classList.contains('card--clicked')) {
      asideNode.classList.remove('card--clicked');
    } else {
      asideNode.classList.add('card--clicked');
    }
  });

  return asideNode;
};

const addCard = card => {
  containerCard.appendChild(card);
};

const getRandomCardValue = () => {
  return Math.floor(Math.random() * data.length);
};

// patron observer
btnLoadMore.addEventListener('click', () => {
  const childrens = containerCard.children.length;
  if (childrens < 25) {
    for (let i = 0; i < 6; i++) {
      addCard(componentDefaultCard(data[getRandomCardValue()]));
    }
  } else {
    alert('no more iniciativas');
  }
});

const filterCardInContainer = textCriteria => {
  // convert NodeList to array -> containerCard.children is a NodeList
  const elementByContainer = [...containerCard.children]; // array elements
  const getFindsElements = elementByContainer.filter(el => {
    const title = el.querySelector('.card__title').textContent;
    return title.includes(textCriteria);
  });

  // containerCard.innerHTML = '';
  while (containerCard.lastElementChild) {
    containerCard.removeChild(containerCard.lastElementChild);
  }

  getFindsElements.forEach(el => {
    containerCard.appendChild(el);
  });
};

const pageLoad = () => {
  data.forEach(card => {
    addCard(componentDefaultCard(card));
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
