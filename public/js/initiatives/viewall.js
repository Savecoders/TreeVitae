const initiatives = [
  {
    title: 'CamioncitosSa',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    tags: ['recolección', 'reciclaje', 'limpieza', 'mantenimiento'],
  },
  {
    title: 'CamioncitosBolivar',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    tags: ['recolección'],
  },
  {
    title: 'CamioncitosVivanco',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    tags: ['recolección', 'reciclaje', 'limpieza'],
  },
  {
    title: 'TreeVitae',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    tags: ['limpieza', 'mantenimiento'],
  },
  {
    title: 'TreeVitae',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    tags: ['recolección', 'reciclaje', 'limpieza', 'mantenimiento'],
  },
  {
    title: 'TreeVitae',
    description:
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    image: '../../assets/images/iniciativa-default.png',
    tags: ['recolección', 'reciclaje'],
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

const componentTag = tag => {
  const tagNode = document.createElement('div');
  tagNode.classList.add('tag__content');
  tagNode.textContent = tag;
  return tagNode;
};

const componentDefaultCard = ({ title, description, image, tags }) => {
  const asideNode = document.createElement('aside');
  asideNode.classList.add('card');

  const cardArticuleNode = document.createElement('article');
  cardArticuleNode.classList.add('card__content');

  const cardTitleNode = document.createElement('a');
  cardTitleNode.classList.add('card__title');
  cardTitleNode.href = './view.html';
  cardTitleNode.textContent = title;

  const cardTagsContainer = document.createElement('div');
  cardTagsContainer.classList.add('card__tags__content');

  tags.forEach(tag => {
    cardTagsContainer.appendChild(componentTag(tag));
  });

  const cardDescriptionNode = document.createElement('p');
  cardDescriptionNode.classList.add('card__description');
  cardDescriptionNode.textContent = description;

  cardArticuleNode.appendChild(cardTitleNode);
  cardArticuleNode.appendChild(cardTagsContainer);
  cardArticuleNode.appendChild(cardDescriptionNode);

  const cardPictureNode = document.createElement('picture');
  cardPictureNode.classList.add('card__picture');

  const cardPictureImgNode = document.createElement('img');
  cardPictureImgNode.src = image;
  cardPictureImgNode.alt = title;

  cardPictureNode.appendChild(cardPictureImgNode);
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
  return Math.floor(Math.random() * initiatives.length);
};

// patron observer
btnLoadMore.addEventListener('click', () => {
  const childrens = containerCard.children.length;
  if (childrens < 25) {
    for (let i = 0; i < 6; i++) {
      addCard(componentDefaultCard(initiatives[getRandomCardValue()]));
    }
  } else {
    alert('no more iniciativas');
  }
});

const showDefaultCards = () => {
  for (let i = 0; i < 6; i++) {
    addCard(componentDefaultCard(initiatives[i]));
  }
};

const removeAllCards = () => {
  while (containerCard.lastElementChild) {
    containerCard.removeChild(containerCard.lastElementChild);
  }
};

const filterCardNames = textCriteria => {
  // convert NodeList to array -> containerCard.children is a NodeList
  const elementByContainer = [...containerCard.children]; // array elements
  const getFindsElements = elementByContainer.filter(el => {
    const title = el.querySelector('.card__title').textContent;
    return title.includes(textCriteria);
  });

  removeAllCards();

  // apply filter
  getFindsElements.forEach(el => {
    containerCard.appendChild(el);
  });
};

const filterCardByTags = textCriteria => {
  removeAllCards(); // remove all cards
  showDefaultCards(); // show default cards

  const elementByContainer = [...containerCard.children]; // array elements

  const getFindsElements = elementByContainer.filter(el => {
    const tags = el.querySelectorAll('.tag__content');
    const tagsElements = [...tags];
    const tagsText = tagsElements.map(tag => tag.textContent);
    return tagsText.includes(textCriteria);
  });

  removeAllCards();

  // apply filter
  getFindsElements.forEach(el => {
    containerCard.appendChild(el);
  });
};

btnSearch.addEventListener('click', () => {
  const textCriteria = searchInput.value;
  if (textCriteria) {
    filterCardNames(textCriteria);
  } else {
    showDefaultCards();
  }
});

// tag filter
const tagFilter = document.querySelectorAll('.tag');
tagFilter.forEach(tag => {
  tag.addEventListener('click', () => {
    // check if tag is clicked
    if (tag.classList.contains('tag--clicked')) {
      tag.classList.remove('tag--clicked');
      removeAllCards();
      showDefaultCards();
      return;
    }

    // check if other tag is clicked
    const otherTags = document.querySelectorAll('.tag--clicked');

    if (otherTags.length > 0) {
      otherTags.forEach(tag => tag.classList.remove('tag--clicked'));
    }

    const tagName = tag.textContent.toLowerCase();
    tag.classList.add('tag--clicked');
    filterCardByTags(tagName);
  });
});

//siempre se va a ejecutar la pagina
showDefaultCards();
