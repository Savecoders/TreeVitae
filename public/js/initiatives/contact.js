document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formulario');
  const modal = document.getElementById('modalExito');
  const closeModal = document.querySelector('.modal__close');
  const deleteButtons = document.querySelectorAll('button.btn-delete');
  const deleteModal = document.getElementById('deleteModal');
  const cancelButton = document.getElementById('cancelDelete');
  const confirmButton = document.getElementById('confirmDelete');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    if (validarFormulario()) {
      modal.style.display = 'block';
      form.reset();
    }
    if (vistaPrevia) {
      vistaPrevia.innerHTML = '';
    }
  });

  closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', event => {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });

  deleteButtons.forEach(button => {
    button.addEventListener('click', openDeleteModal);
  });

  cancelButton.addEventListener('click', closeDeleteModal);
  confirmButton.addEventListener('click', confirmDelete);

  const nombres = document.getElementById('nombres');
  const apellidos = document.getElementById('apellidos');
  const correoElectronico = document.getElementById('correoElectronico');
  const telefono = document.getElementById('telefono');
  const prioridad = document.getElementById('prioridad');
  const asunto = document.getElementById('asunto');
  const mensaje = document.getElementById('mensaje');
  const foto = document.getElementById('foto');

  function validarFormulario() {
    eliminarMensajes();
    let esValido = true;
    const validacion = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    //Validaciones para nombres
    if (nombres && !validarCampo(nombres, 'Falta sus nombres', 'Nombres muy corto.', validacion)) {
      esValido = false;
    }

    //Validaciones para apellidos
    if (
      apellidos &&
      !validarCampo(apellidos, 'Falta sus apellidos.', 'Apellidos muy corto.', validacion)
    ) {
      esValido = false;
    }

    //Validaciones para el correo electronico
    if (correoElectronico && correoElectronico.value === '') {
      presentarMensaje('Falta su correo.', correoElectronico);
      esValido = false;
    } else if (correoElectronico) {
      eliminarMensaje(correoElectronico);
    }

    // Validaciones para teléfono
    if (telefono && !validarTelefono(telefono)) {
      esValido = false;
    }

    //Validacion para el mensaje
    if (mensaje && mensaje.value === '') {
      presentarMensaje('Le falta mensaje.', mensaje);
      esValido = false;
    } else if (mensaje) {
      eliminarMensaje(mensaje);
    }

    //Validaciones para el asunto
    if (asunto && asunto.value === '') {
      presentarMensaje('Le falta el asunto.', asunto);
      esValido = false;
    } else if (asunto) {
      eliminarMensaje(asunto);
    }

    // Validaciones para la foto
    if (foto && !foto.files.length) {
      presentarMensaje('Debe subir una foto.', foto);
      esValido = false;
    }

    return esValido;
  }

  function validarCampo(campo, mensajeVacio, mensajeCorto, regex) {
    if (campo.value === '') {
      presentarMensaje(mensajeVacio, campo);
      return false;
    } else if (campo.value.length < 3) {
      presentarMensaje(mensajeCorto, campo);
      return false;
    } else if (!regex.test(campo.value)) {
      presentarMensaje('Solo letras.', campo);
      return false;
    } else {
      eliminarMensaje(campo);
      return true;
    }
  }

  function validarTelefono(campo) {
    if (campo.value === '') {
      presentarMensaje('Falta su telefono.', campo);
      return false;
    } else if (!/^\d+$/.test(campo.value)) {
      presentarMensaje('Solo numeros.', campo);
      return false;
    } else if (campo.value.length !== 10) {
      presentarMensaje('Solo 10 digitos.', campo);
      return false;
    } else {
      eliminarMensaje(campo);
      return true;
    }
  }

  function presentarMensaje(mensaje, elemento) {
    if (elemento) {
      elemento.focus();
      const container = elemento.closest('.input__container');
      if (container) {
        const errorMessage = container.querySelector('.error__message');
        if (errorMessage) {
          errorMessage.textContent = mensaje;
          container.classList.add('error');
        }
      }
    }
  }

  function eliminarMensaje(elemento) {
    if (elemento) {
      const container = elemento.closest('.input__container');
      if (container) {
        container.classList.remove('error');
        const errorMessage = container.querySelector('.error__message');
        if (errorMessage) {
          errorMessage.textContent = '';
        }
      }
    }
  }

  function eliminarMensajes() {
    const containers = document.querySelectorAll('.input__container');
    containers.forEach(container => {
      if (container) {
        container.classList.remove('error');
        const errorMessage = container.querySelector('.error__message');
        if (errorMessage) {
          errorMessage.textContent = '';
        }
      }
    });
  }

  function mostrarVistaPrevia(event) {
    const vistaPrevia = document.getElementById('vistaPrevia');
    if (vistaPrevia) {
      vistaPrevia.innerHTML = '';

      const archivo = event.target.files[0];
      if (archivo) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.alt = 'Vista previa de la imagen';
          img.style.maxWidth = '100%';
          img.style.height = 'auto';
          vistaPrevia.appendChild(img);
        };
        reader.readAsDataURL(archivo);
      } else {
        vistaPrevia.textContent = 'No se seleccionó ninguna imagen.';
      }
    }
  }

  if (foto) {
    foto.addEventListener('change', mostrarVistaPrevia);
  }

  function openDeleteModal(e) {
    console.log('Botón de eliminación clickeado');
    const contactId = e.target.dataset.id;
    if (contactId) {
      deleteModal.style.display = 'block';
      deleteModal.dataset.contactId = contactId;
    } else {
      console.error('No se encontró el ID del contacto.');
    }
  }

  function closeDeleteModal() {
    deleteModal.style.display = 'none';
  }

  function confirmDelete() {
    const contactId = deleteModal.dataset.contactId;
    if (contactId) {
      fetch(`index.php?c=contact&f=delete&id=${contactId}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            document.querySelector(`tr[data-id="${contactId}"]`).remove();
            closeDeleteModal();
            alert('Contacto eliminado con éxito');
          } else {
            alert('Error al eliminar el contacto');
          }
        })
        .catch(error => console.error('Error:', error));
    } else {
      console.error('No se encontró el ID del contacto en el modal.');
    }
  }

  // Agregar evento para cerrar el modal al hacer clic fuera de él
  window.addEventListener('click', function (event) {
    if (event.target == deleteModal) {
      closeDeleteModal();
    }
  });

  // Agregar evento para cerrar el modal al presionar ESC
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeDeleteModal();
    }
  });
});
