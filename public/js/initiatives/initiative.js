function validarFormulario() {
    eliminarMensajes(); // Limpia los mensajes previos
    let esValido = true;

    // Validar nombre de la actividad
    let nombre = document.getElementById("nombre_actividad");
    let nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    if (nombre.value === "") {
        cargarMensaje("El nombre de la actividad es obligatorio**", nombre);
        esValido = false;
    } else if (nombre.value.length < 3) {
        cargarMensaje("El nombre debe tener al menos 3 caracteres**", nombre);
        esValido = false;
    } else if (!nombreRegex.test(nombre.value)) {
        cargarMensaje("El nombre solo puede contener letras y espacios**", nombre);
        esValido = false;
    }

    // Validar descripción de la actividad
    let descripcion = document.getElementById("descripcion_actividad");
    if (descripcion.value === "") {
        cargarMensaje("La descripción de la actividad es obligatoria**", descripcion);
        esValido = false;
    } else if (descripcion.value.length < 10) {
        cargarMensaje("La descripción debe tener al menos 10 caracteres**", descripcion);
        esValido = false;
    }

    // Validar fechas
    let fechaInicio = document.getElementById("fecha_inicio");
    let fechaFin = document.getElementById("fecha_fin");
    let fechaActual = new Date(); 
    fechaActual.setHours(0, 0, 0, 0); 

    let fechaInicioValor = fechaInicio.value ? new Date(fechaInicio.value) : null;
    let fechaFinValor = fechaFin.value ? new Date(fechaFin.value) : null;

    if (fechaInicioValor) fechaInicioValor.setHours(0, 0, 0, 0);
    if (fechaFinValor) fechaFinValor.setHours(0, 0, 0, 0);

    // Validación de la fecha de inicio
    if (!fechaInicio.value) {
        cargarMensaje("La fecha de inicio es obligatoria**", fechaInicio);
        esValido = false;
    } else if (fechaInicioValor <= fechaActual) {
        cargarMensaje("La fecha debe ser posterior a la fecha de hoy**", fechaInicio);
        esValido = false;
    }

    // Validación de la fecha de finalización
    if (!fechaFin.value) {
        cargarMensaje("La fecha de finalización es obligatoria**", fechaFin);
        esValido = false;
    } else if (fechaInicioValor && fechaFinValor <= fechaInicioValor) {
        cargarMensaje("La fecha debe ser posterior a la fecha de inicio**", fechaFin);
        esValido = false;
    }

    // Validar ubicación
    let ubicacion = document.getElementById("ubicacion");
    if (ubicacion.value === "") {
        cargarMensaje("La ubicación es obligatoria**", ubicacion);
        esValido = false;
    } else if (ubicacion.value.length < 5) {
        cargarMensaje("La ubicación debe tener al menos 5 caracteres**", ubicacion);
        esValido = false;
    }

    // Validar opción seleccionada en "Es virtual"
    let esVirtual = document.querySelector('input[name="es_virtual"]:checked');
    if (!esVirtual) {
        let contenedorVirtual = document.querySelector('.input__radio-group');
        cargarMensaje("Seleccione si la actividad es o no virtual**", contenedorVirtual);
        esValido = false;
    }

    return esValido;
}

function cargarMensaje(mensaje, elemento) {
    let span = document.createElement("span");
    span.textContent = mensaje;
    span.classList.add("error");

    // Buscar el label asociado al elemento
    let parentDiv = elemento.closest(".container__component");
    let label = parentDiv.querySelector("label");

    if (label) {
        label.appendChild(span);
    }
}

function eliminarMensajes() {
    let mensajes = document.querySelectorAll(".error");
    mensajes.forEach((mensaje) => mensaje.remove());
}

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
}

const btnCreateActivity = document.querySelector('.btn-animation');
addAnimationEvents(btnCreateActivity); 