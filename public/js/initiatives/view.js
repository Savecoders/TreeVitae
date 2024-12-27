const cardTemplate = {
    initiativeName: 'TreeVitae',
    publicationDate: '| 27d',
    postTittle: '[BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the fly!',
    likes: '44 likes',
    comments: '44 comentarios',
    image: '../../assets/images/iniciativa-default.png'
};

const containerCard = document.querySelector('.cards');

// Función para agregar animaciones de hover y click
function addAnimationEvents(element) {
    element.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';

    // Animación al pasar el ratón
    element.addEventListener('mouseenter', () => {
        element.style.transform = 'scale(1.05)';
        element.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.2)';
    });

    // Revertir al salir el ratón
    element.addEventListener('mouseleave', () => {
        element.style.transform = 'scale(1)';
        element.style.boxShadow = 'none';
    });

    // Efecto al hacer clic
    element.addEventListener('click', () => {
        element.style.transform = 'scale(1.2)';
        element.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.3)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
            element.style.boxShadow = 'none';
        }, 500); // Duración del efecto
    });
}

// Aplicar animaciones a las tarjetas
document.addEventListener('DOMContentLoaded', () => {
    const existingCards = document.querySelectorAll('.card-compact-post');
    existingCards.forEach(addAnimationEvents);
});

// Crear tarjetas dinámicamente
function createCard({ initiativeName, publicationDate, postTittle, likes, comments, image }) {
    const card = document.createElement('div');
    card.classList.add('card-compact-post');

    const header = document.createElement('header');
    const h3 = document.createElement('h3');
    h3.textContent = initiativeName;
    const pDate = document.createElement('p');
    pDate.textContent = publicationDate;

    const h2 = document.createElement('h2');
    h2.textContent = postTittle;

    const footer = document.createElement('footer');
    footer.classList.add('figure');

    const figureLikes = document.createElement('figure');
    figureLikes.classList.add('media__item');
    const imgLikes = document.createElement('img');
    imgLikes.src = '../../assets/icons/users.svg';
    imgLikes.alt = 'user-icon';
    const smallLikes = document.createElement('small');
    smallLikes.textContent = likes;

    figureLikes.appendChild(imgLikes);
    figureLikes.appendChild(smallLikes);

    const figureComments = document.createElement('figure');
    figureComments.classList.add('media__item');
    const imgComments = document.createElement('img');
    imgComments.src = '../../assets/icons/users.svg';
    imgComments.alt = 'user-icon';
    const smallComments = document.createElement('small');
    smallComments.textContent = comments;

    figureComments.appendChild(imgComments);
    figureComments.appendChild(smallComments);

    footer.appendChild(figureLikes);
    footer.appendChild(figureComments);

    const img = document.createElement('img');
    img.style.borderRadius = '8px';
    img.style.filter = 'drop-shadow(0 0 3px #000000)';
    img.src = image;
    img.alt = image;

    header.appendChild(h3);
    header.appendChild(pDate);
    card.appendChild(header);
    card.appendChild(h2);
    card.appendChild(footer);
    card.appendChild(img);

    addAnimationEvents(card); // Agregar animaciones a la tarjeta
    containerCard.appendChild(card);
}

// Agregar animaciones a otros elementos
function applyAnimations() {
    const tags = document.querySelectorAll('.tag');
    const mediaItems = document.querySelectorAll('.media__item');
    const buttons = document.querySelectorAll('.btn-animation');

    tags.forEach(addAnimationEvents);
    mediaItems.forEach(addAnimationEvents);
    buttons.forEach(addAnimationEvents);
}

// Funcion que desactiva el botón
function disableButton(button) {
    button.disabled = true; 
    button.style.cursor = 'not-allowed'; 
    button.style.opacity = '0.4'; 
    button.textContent = 'No hay más Post'; 

    // Eliminar animaciones y eventos de transformación
    button.style.transition = 'none'; 
    button.style.transform = 'none'; 
    button.style.boxShadow = 'none'; 

    // Eliminar eventos previos y prevenir comportamientos predeterminados
    const newButton = button.cloneNode(true); 
    newButton.addEventListener('click', (event) => {
        event.preventDefault(); 
    });
    button.parentNode.replaceChild(newButton, button); 
}

// Función para comprobar si hay más tarjetas disponibles
function checkIfMorePosts(button) {
    const childrens = containerCard.children.length;
    if (childrens >= 25) {
        disableButton(button); 
    }
}

const btnSeeMore = document.getElementById('btnMorePost');
btnSeeMore.addEventListener('click', (event) => {
    event.preventDefault();

    const childrens = containerCard.children.length;
    if (childrens < 25) {
        for (let i = 0; i < 6; i++) {
            createCard(cardTemplate); 
        }
        applyAnimations(); // Reaplicar animaciones a nuevos elementos

        // Verificar si hay más tarjetas disponibles después de agregar
        checkIfMorePosts(btnSeeMore);
    }
});

// Verificar estado del botón al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    checkIfMorePosts(btnSeeMore);
});

// Llamar animaciones para elementos iniciales
applyAnimations();