function validarFormulario() {
  eliminarMensajes();
  let esValido = true;
  const validacion = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

  //Validaciones para nombres
  if (nombres.value === '') {
    presentarMensaje('Falta sus nombres', nombres);
    esValido = false;
  } else if (nombres.value.length < 3) {
    presentarMensaje('Nombres muy corto.', nombres);
    esValido = false;
  } else if (!validacion.test(nombres.value)) {
    presentarMensaje('Solo letras.', nombres);
    esValido = false;
  } else {
    eliminarMensaje(nombres);
  }

  //Validaciones para apellidos
  if (apellidos.value === '') {
    presentarMensaje('Falta sus apellidos.', apellidos);
    esValido = false;
  } else if (apellidos.value.length < 3) {
    presentarMensaje('Apellidos muy corto.', apellidos);
    esValido = false;
  } else if (!validacion.test(apellidos.value)) {
    presentarMensaje('Solo letras.', apellidos);
    esValido = false;
  } else {
    eliminarMensaje(apellidos);
  }

  //Validaciones para el correo electronico
  if (correoElectronico.value === '') {
    presentarMensaje('Falta su correo.', correoElectronico);
    esValido = false;
  } else if (telefono.value === '') {
    presentarMensaje('Falta su telefono.', telefono);
    esValido = false;
  } else {
    eliminarMensaje(correoElectronico);
  }

  if (!/^\d+$/.test(telefono.value)) {
    presentarMensaje('Solo numeros.', telefono);
    esValido = false;
  } else if (telefono.value.length !== 10) {
    presentarMensaje('Solo 10 digitos.', telefono);
  } else {
    eliminarMensaje(telefono);
  }

  //Validacion para el mensaje
  if (mensaje.value === '') {
    presentarMensaje('Le falta mensaje.', mensaje);
    esValido = false;
  } else {
    eliminarMensaje(mensaje);
  }
  return esValido;
}

function presentarMensaje(mensaje, elemento) {
  elemento.focus();
  const container = elemento.closest('.input__container');
  const errorMessage = container.querySelector('.error__message');
  errorMessage.textContent = mensaje;
  container.classList.add('error');
}

function eliminarMensaje(elemento) {
  const container = elemento.closest('.input__container');
  container.classList.remove('error');
  container.querySelector('.error__message').textContent = '';
}

function eliminarMensajes() {
  const containers = document.querySelectorAll('.input__container');
  containers.forEach(container => {
    container.classList.remove('error');
    container.querySelector('.error__message').textContent = '';
  });
}
