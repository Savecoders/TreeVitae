document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formulario');

  // Elementos del formulario
  const nombres = document.getElementById('nombres');
  const apellidos = document.getElementById('apellidos');
  const correoElectronico = document.getElementById('correoElectronico');
  const telefono = document.getElementById('telefono');
  const prioridad = document.getElementById('prioridad');
  const asunto = document.getElementById('asunto');
  const mensaje = document.getElementById('mensaje');

  // Mensajes de error
  const errorMessages = {
    nombres: {
      empty: 'Los nombres son requeridos',
      minLength: 'Los nombres deben tener al menos 3 caracteres',
      maxLength: 'Los nombres deben tener menos de 50 caracteres',
    },
    apellidos: {
      empty: 'Los apellidos son requeridos',
      minLength: 'Los apellidos deben tener al menos 3 caracteres',
      maxLength: 'Los apellidos deben tener menos de 50 caracteres',
    },
    correoElectronico: {
      empty: 'El correo electrónico es requerido',
      invalid: 'Por favor, ingrese un correo electrónico válido',
    },
    telefono: {
      empty: 'El teléfono es requerido',
      invalid: 'Por favor, ingrese solo números',
      length: 'El teléfono debe tener exactamente 10 dígitos',
    },
    asunto: {
      empty: 'El asunto es requerido',
    },
    mensaje: {
      empty: 'El mensaje es requerido',
    },
  };

  // Función para mostrar errores
  const showError = (element, message) => {
    const inputContainer = element.closest('.input__container');
    const errorMessage = inputContainer.querySelector('.error__message');
    errorMessage.textContent = message;
    inputContainer.classList.add('error');
  };

  // Función para limpiar errores
  const cleanError = element => {
    const inputContainer = element.closest('.input__container');
    const errorMessage = inputContainer.querySelector('.error__message');
    errorMessage.textContent = '';
    inputContainer.classList.remove('error');
  };

  // Funciones de validación
  const validateText = (field, fieldName, minLen, maxLen) => {
    if (field.value.trim() === '') {
      return `${fieldName} es requerido`;
    }
    if (field.value.length < minLen) {
      return `${fieldName} debe tener al menos ${minLen} caracteres`;
    }
    if (field.value.length > maxLen) {
      return `${fieldName} debe tener menos de ${maxLen} caracteres`;
    }
    return null;
  };

  const validateEmail = field => {
    if (field.value.trim() === '') {
      return 'El correo electrónico es requerido';
    }
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(field.value)) {
      return 'Por favor, ingrese un correo electrónico válido';
    }
    return null;
  };

  const validatePhone = field => {
    if (field.value.trim() === '') {
      return 'El teléfono es requerido';
    }
    if (!/^\d+$/.test(field.value)) {
      return 'Por favor, ingrese solo números';
    }
    if (field.value.length !== 10) {
      return 'El teléfono debe tener exactamente 10 dígitos';
    }
    return null;
  };

  const validateSelect = field => {
    if (field.selectedIndex === 0) {
      return 'Por favor, seleccione una opción';
    }
    return null;
  };

  // Función principal de validación
  const validateForm = () => {
    let isValid = true;

    // Nombres
    const nombresError = validateText(nombres, 'Nombres', 3, 50);
    if (nombresError) {
      showError(nombres, nombresError);
      isValid = false;
    } else {
      cleanError(nombres);
    }

    // Apellidos
    const apellidosError = validateText(apellidos, 'Apellidos', 3, 50);
    if (apellidosError) {
      showError(apellidos, apellidosError);
      isValid = false;
    } else {
      cleanError(apellidos);
    }

    // Correo electrónico
    const emailError = validateEmail(correoElectronico);
    if (emailError) {
      showError(correoElectronico, emailError);
      isValid = false;
    } else {
      cleanError(correoElectronico);
    }

    // Teléfono
    const phoneError = validatePhone(telefono);
    if (phoneError) {
      showError(telefono, phoneError);
      isValid = false;
    } else {
      cleanError(telefono);
    }

    // Asunto
    const subjectError = validateText(asunto, 'Asunto', 1, 100);
    if (subjectError) {
      showError(asunto, subjectError);
      isValid = false;
    } else {
      cleanError(asunto);
    }

    // Mensaje
    const messageError = validateText(mensaje, 'Mensaje', 1, 500);
    if (messageError) {
      showError(mensaje, messageError);
      isValid = false;
    } else {
      cleanError(mensaje);
    }

    // Prioridad
    const priorityError = validateSelect(prioridad);
    if (priorityError) {
      showError(prioridad, priorityError);
      isValid = false;
    } else {
      cleanError(prioridad);
    }

    return isValid;
  };

  // Evento de envío del formulario
  form.addEventListener('submit', event => {
    event.preventDefault();
    const isValid = validateForm();
    console.log('Formulario válido:', isValid); // Depuración
    if (isValid) {
      console.log('Enviando formulario'); // Depuración
      event.target.submit();
    }
  });
});
