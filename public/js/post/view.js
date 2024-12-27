// Obtener las imágenes y el modal
const images = document.querySelectorAll('.hero');
const modal = document.getElementById('modal');
const modalImage = document.getElementById('modal-image');
const closeModal = document.getElementById('close-modal');

// Añadir el evento de clic en cada imagen
images.forEach(image => {
    image.addEventListener('click', function() {
    const src = this.getAttribute('data-src'); 
    
    // Verificar si la imagen tiene el atributo 'data-src'
    if (src) {
      modalImage.src = src; 
      modal.style.display = 'flex'; 
    }
    });
});

// Cerrar el modal
closeModal.addEventListener('click', function() {
  modal.style.display = 'none'; 
});

// Cerrar el modal al hacer clic fuera de la imagen
modal.addEventListener('click', function(event) {
    if (event.target === modal) {
    modal.style.display = 'none';
    }
});

// Función para actualizar el contador al hacer clic en el ícono de incremento
function updateCounter(button) {
  const likeCount = button.querySelector('.like-count'); 
  const count = parseInt(likeCount.textContent); 
  likeCount.textContent = count + 1; 
}

// Función para asignar eventos al botón
function addReactionEvents(button) {
    const incrementIcon = button.querySelector('.increment-icon');
    const noActionIcon = button.querySelector('.no-action-icon');

  // Añadir una bandera para controlar si ya se hizo clic
    let alreadyLiked = false;

  // Evento para incrementar el contador al hacer clic en el ícono de incremento
    incrementIcon.addEventListener('click', (event) => {
    event.stopPropagation(); 
    
    if (!alreadyLiked) { 
      updateCounter(button); 
      alreadyLiked = true;  
    }
    });
}

// Función principal que inicializa los eventos en el botón
function initializeReactionButtons() {
  const likeButton = document.querySelector('.like-btn'); 
  addReactionEvents(likeButton); 
}
document.addEventListener('DOMContentLoaded', initializeReactionButtons);
const postTitles = document.querySelectorAll('.post-item-title');
// Agrega eventos para resaltar los títulos al pasar el mouse
postTitles.forEach((title) => {
    title.addEventListener('mouseover', () => {
    title.style.color = 'var(--primary-200)'; 
    title.style.textDecoration = 'underline'; 
    });

    title.addEventListener('mouseout', () => {
    title.style.color = 'var(--primary-400)'; 
    title.style.textDecoration = 'none'; // 
    });
});

function apliAniamtion() {
    const tags = document.querySelectorAll('.tags__info');
    const actionBtns = document.querySelectorAll('.action-btn');
  const botonUnirse = document.querySelector('#join-btn'); 

    tags.forEach(addAnimation);
    actionBtns.forEach(addAnimation);
    addAnimation(botonUnirse);
}

function addAnimation(elemento) {
    elemento.style.transition = 'transform 0.2s ease, box-shadow 0.2s ease';

  // Efecto al hacer clic
    elemento.addEventListener('click', () => {
    elemento.style.transform = 'scale(1.03)';
    elemento.style.boxShadow = '0 8px 15px rgba(0, 0, 0, 0.1)';
    setTimeout(() => {
        elemento.style.transform = 'scale(1)';
        elemento.style.boxShadow = 'none';
    }, 300); 
    });
}

document.addEventListener('DOMContentLoaded', () => {
    apliAniamtion();

  // Animaciones en los posts similares
    const posts = document.querySelectorAll('.post-item');
    posts.forEach(addAnimation);
});

document.addEventListener("DOMContentLoaded", function() {
    // Selecciona específicamente el botón de comentario
    const comentarioBtn = document.querySelector(".comment-btn"); 
    const comentarioTextarea = document.querySelector(".comments-section textarea");

  // Agregar el evento de clic al botón de comentario
    comentarioBtn.addEventListener("click", function() {
    comentarioTextarea.focus();
  });
});
