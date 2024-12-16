// validacion de formulario

const form = document.querySelector('#initiative-form');
const title = document.querySelector('#title');
const description = document.querySelector('#description');
const cover = document.querySelector('#cover');
const gallery = document.querySelector('#gallery');
const tagsLabel = document.querySelector('#tags__label');
const dropZone = document.querySelector('.drop__zone');
const tags = document.querySelector('.tags');
const galleryImages = document.querySelector('.gallery__images');

// mensajes de error
const errorMessages = {
  title: {
    empty: 'El titulo es requerido y no puede estar vacio',
    minLength: 'El titulo debe tener al menos 5 caracteres',
    maxLength: 'El titulo debe tener menos de 50 caracteres',
  },
  description: {
    empty: 'La descripcion es requerida y no puede estar vacia',
    minLength: 'La descripcion debe tener al menos 10 caracteres',
    maxLength: 'La descripcion debe tener menos de 500 caracteres',
  },
  cover: {
    empty: 'La imagen de portada es requerida y no puede estar vacia',
  },
  gallery: {
    empty: 'La galeria es requerida debe tener al menos 2 imagenes',
  },
  tags: {
    empty: 'De de seleccionar al menos 1 tag como limpieza, etc',
  },
};

const validateTitle = () => {
  if (title.value.trim() === '') {
    return errorMessages.title.empty;
  }

  if (title.value.length < 5) {
    return errorMessages.title.minLength;
  }

  if (title.value.length > 50) {
    return errorMessages.title.maxLength;
  }
  return null;
};

const showError = (element, message) => {
  if (element.id === 'cover') {
    const coverError = document.querySelector('#cover-error');
    coverError.textContent = message;
  } else if (element.id === 'gallery') {
    const galleryError = document.querySelector('#gallery-error');
    galleryError.textContent = message;
  } else {
    element.nextElementSibling.textContent = message;
  }
};

const cleanError = element => {
  if (element.id === 'cover') {
    const coverError = document.querySelector('#cover-error');
    coverError.textContent = '';
  } else if (element.id === 'gallery') {
    const galleryError = document.querySelector('#gallery-error');
    galleryError.textContent = '';
  } else {
    element.nextElementSibling.textContent = '';
  }
};

const validateDescription = () => {
  if (description.value.trim() === '') {
    return errorMessages.description.empty;
  }
  if (description.value.length < 10) {
    return errorMessages.description.minLength;
  }
  if (description.value.length > 500) {
    return errorMessages.description.maxLength;
  }
};

const validateCover = () => {
  // validar si el archivo es una imagen
  if (cover.files.length === 0) {
    console.log('no hay archivo');
    return errorMessages.cover.empty;
  }
};

const validateGallery = () => {
  if (galleryImages.childNodes.length < 2) {
    return errorMessages.gallery.empty;
  }
};

const validateTags = () => {
  const tagsSelected = document.querySelectorAll('.tag--clicked');
  if (tagsSelected.length === 0) {
    return errorMessages.tags.empty;
  }
};

const addImageToGallery = file => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => {
    const img = document.createElement('img');
    img.src = reader.result;
    galleryImages.appendChild(img);
  };
};

gallery.addEventListener('change', e => {
  const files = [...e.target.files];

  files.forEach(file => {
    addImageToGallery(file);
  });
});

dropZone.addEventListener('drop', e => {
  console.log('drop');
  e.preventDefault();
  const files = [...e.dataTransfer.files];
  files.forEach(file => {
    addImageToGallery(file);
  });
});

cover.addEventListener('change', e => {
  const file = e.target.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  console.log(reader);
  reader.onload = () => {
    const preview = document.querySelector('#preview');
    preview.src = reader.result;
    preview.classList.remove('cover-preview');
  };
});

const validateForm = () => {
  const [titleError, descriptionError, coverError, galleryError, tagsError] = [
    validateTitle(),
    validateDescription(),
    validateCover(),
    validateGallery(),
    validateTags(),
  ];

  if (titleError) {
    showError(title, titleError);
  } else {
    cleanError(title);
  }

  if (descriptionError) {
    showError(description, descriptionError);
  } else {
    cleanError(description);
  }
  if (coverError) {
    showError(cover, coverError);
  } else {
    cleanError(cover);
  }
  if (galleryError) {
    showError(gallery, galleryError);
  } else {
    cleanError(gallery);
  }
  if (tagsError) {
    showError(tagsLabel, tagsError);
  } else {
    cleanError(tagsLabel);
  }

  return !titleError && !descriptionError && !coverError && !galleryError && !tagsError;
};

form.addEventListener('submit', event => {
  event.preventDefault();
  const isValid = validateForm();
  if (isValid) {
    event.target.submit();
  }
});

tags.addEventListener('click', event => {
  const tag = event.target;
  if (tag.classList.contains('tag--clicked')) {
    tag.classList.remove('tag--clicked');
  } else {
    tag.classList.add('tag--clicked');
  }
});

cover.addEventListener('change', e => {
  const file = e.target.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  console.log(reader);
  reader.onload = () => {
    const preview = document.querySelector('#preview');
    preview.src = reader.result;
    preview.classList.remove('cover-preview');
  };
});
