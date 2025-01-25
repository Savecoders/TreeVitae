const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const containerCard = $('.container__cards');
const searchInput = $('#searchInput');
const btnSearch = $('#btnSearch');
const btnLoadMore = document.getElementById('loadMore');

// Create initiative card component
const createInitiativeCard = initiative => {
  const card = document.createElement('aside');
  card.className = 'card';
  console.log(initiative);
  card.innerHTML = `
        <article class="card__content">
            <a class="card__title" href="index.php?c=iniciativa&f=view&id=${initiative.id}">
                ${initiative.nombre}
            </a>
            <div class="card__tags__content">
                ${initiative.tags
                  .map(
                    tag => `
                    <div class="tag__content">${tag.nombre}</div>
                `,
                  )
                  .join('')}
            </div>
            <p class="card__description">${initiative.descripcion}</p>
        </article>
        <picture class="card__picture">
            <img src="data:image;base64,${initiative.cover}" alt="${initiative.nombre}">
        </picture>
    `;

  return card;
};

// Search initiatives function
const searchInitiatives = searchTerm => {
  const xhr = new XMLHttpRequest();
  const url = `index.php?c=iniciativa&f=getAllFilterByName&name=${encodeURIComponent(searchTerm)}`;

  xhr.open('GET', url, true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);

      removeAllCards();

      if (data.success && data.data) {
        console.log(data.data);
        data.data.forEach(initiative => {
          console.log(initiative);
          containerCard.appendChild(createInitiativeCard(initiative));
        });
      } else {
        containerCard.innerHTML = `<p class="no-results">No se encontraron iniciativas</p>`;
      }
    } else {
      containerCard.innerHTML = `<p class="error">Error al buscar iniciativas</p>`;
    }
  };

  xhr.onerror = function () {
    console.error('Error al buscar iniciativas:', xhr.statusText);
    containerCard.innerHTML = `<p class="error">Error al buscar iniciativas</p>`;
  };

  xhr.send();
};

// Clean container helper
const removeAllCards = () => {
  while (containerCard.lastElementChild) {
    containerCard.removeChild(containerCard.lastElementChild);
  }
};

// Search event listeners
btnSearch.addEventListener('click', e => {
  e.preventDefault();
  const searchTerm = searchInput.value;
  if (searchTerm || searchTerm === '') {
    searchInitiatives(searchTerm);
  }
});

searchInput.addEventListener('keypress', e => {
  if (e.key === 'Enter') {
    e.preventDefault();
    const searchTerm = searchInput.value();
    if (searchTerm || searchTerm === '') {
      searchInitiatives(searchTerm);
    }
  }
});

// Tag filtering
const tagFilter = document.querySelectorAll('.tag');
tagFilter.forEach(tag => {
  tag.addEventListener('click', () => {
    if (tag.classList.contains('tag--clicked')) {
      tag.classList.remove('tag--clicked');
      // Reset search
      searchInput.value = '';
      searchInitiatives('');
      return;
    }

    const otherTags = document.querySelectorAll('.tag--clicked');
    if (otherTags.length > 0) {
      otherTags.forEach(tag => tag.classList.remove('tag--clicked'));
    }

    const tagName = tag.textContent.trim();
    tag.classList.add('tag--clicked');
    searchInitiatives(tagName);
  });
});
