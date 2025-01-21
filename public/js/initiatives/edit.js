// validacion de formulario

const form = document.querySelector('#initiative-form');
const title = document.querySelector('#name');
const description = document.querySelector('#description');
const cover = document.querySelector('#cover');
const logo = document.querySelector('#logo');
const tagsLabel = document.querySelector('#tags__label');
const tags = document.querySelector('.tags');

// mensajes de error
const errorMessages = {
  title: {
    empty: 'El nombre es requerido y no puede estar vacio',
    minLength: 'El nombre debe tener al menos 5 caracteres',
    maxLength: 'El nombre debe tener menos de 50 caracteres',
  },
  description: {
    empty: 'La descripcion es requerida y no puede estar vacia',
    minLength: 'La descripcion debe tener al menos 10 caracteres',
    maxLength: 'La descripcion debe tener menos de 500 caracteres',
  },
  cover: {
    empty: 'La imagen de portada es requerida y no puede estar vacia',
  },
  logo: {
    empty: 'El logo es requerido y no puede estar vacio',
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
  } else if (element.id === 'logo') {
    const logoError = document.querySelector('#logo-error');
    logoError.textContent = message;
  } else {
    element.nextElementSibling.textContent = message;
  }
};

const cleanError = element => {
  if (element.id === 'cover') {
    const coverError = document.querySelector('#cover-error');
    coverError.textContent = '';
  } else if (element.id === 'logo') {
    const logoError = document.querySelector('#logo-error');
    logoError.textContent = '';
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
    return errorMessages.cover.empty;
  }
};

const validateLogo = () => {
  if (logo.files.length === 0) {
    return errorMessages.logo.empty;
  }
};

const validateTags = () => {
  const tagsSelected = document.querySelectorAll('.tag--clicked');
  if (tagsSelected.length === 0) {
    return errorMessages.tags.empty;
  }
};

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
  const [titleError, descriptionError, coverError, logoError, tagsError] = [
    validateTitle(),
    validateDescription(),
    validateCover(),
    validateLogo(),
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

  if (logoError) {
    showError(logo, logoError);
  } else {
    cleanError(logo);
  }

  if (tagsError) {
    showError(tagsLabel, tagsError);
  } else {
    cleanError(tagsLabel);
  }

  return !titleError && !descriptionError && !coverError && !tagsError;
};

form.addEventListener('submit', event => {
  event.preventDefault();
  const isValid = validateForm();
  if (isValid) {
    const selectedTags = document.querySelector('#selected_tags').value;
    if (!selectedTags) {
      showError(tagsLabel, errorMessages.tags.empty);
      return;
    }
    event.target.submit();
  }
});

tags.addEventListener('click', event => {
  const tag = event.target;
  const selectedTagsInput = document.querySelector('#selected_tags');
  let selectedTags = selectedTagsInput.value ? selectedTagsInput.value.split(',') : [];

  if (tag.classList.contains('tag--clicked')) {
    tag.classList.remove('tag--clicked');
    selectedTags = selectedTags.filter(id => id !== tag.dataset.id);
  } else {
    tag.classList.add('tag--clicked');
    selectedTags.push(tag.dataset.id);
  }
  selectedTagsInput.value = selectedTags.join(',');
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

logo.addEventListener('change', e => {
  const file = e.target.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => {
    const preview = document.querySelector('#logo-preview');
    preview.src = reader.result;
    preview.classList.remove('logo-preview');
  };
});

document.addEventListener('DOMContentLoaded', function () {
  const coverInput = document.getElementById('cover');
  const coverPreview = document.getElementById('preview');

  const logoInput = document.getElementById('logo');
  const logoPreview = document.getElementById('logo-preview');

  coverPreview.style.display = 'block';
  logoPreview.style.display = 'block';

  // Update the preview when a new file is selected
  coverInput.addEventListener('change', function () {
    const file = coverInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        coverPreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  logoInput.addEventListener('change', function () {
    const file = logoInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        logoPreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
});
