document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("postForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); 

        let isValid = true;

        // Limpiar mensajes de error previos
        clearErrors();

        // Validar Título
        const title = document.getElementById("title");
        if (title.value.trim() === "") {
            setError("title", "El título del post no puede estar vacío.");
            isValid = false;
        } else if (title.value.trim().length < 20) {
            setError("title", "El título debe tener al menos 20 caracteres.");
            isValid = false;
        }

        // Validar Subtítulo
        const subtitle = document.getElementById("subtitle");
        if (subtitle.value.trim() === "") {
            setError("subtitle", "El subtítulo no puede estar vacío.");
            isValid = false;
        } else if (subtitle.value.trim().length < 5) {
            setError("subtitle", "El subtítulo debe tener al menos 5 caracteres.");
            isValid = false;
        }

        // Validar Tags
        const tags = document.getElementById("tags");
        if (tags.value === "") {
            setError("tags", "Debes seleccionar un tag.");
            isValid = false;
        }

        // Validar Contenido
        const content = document.getElementById("content");
        if (content.value.trim() === "") {
            setError("content", "El contenido no puede estar vacío.");
            isValid = false;
        } else if (content.value.trim().length < 50) {
            setError("content", "El contenido debe tener al menos 50 caracteres.");
            isValid = false;
        }

        // Validar Imagen
        const image = document.getElementById("image");
        if (image.files.length > 0) {
            const file = image.files[0];
            const fileSizeMB = file.size / 1024 / 1024; 
            const validExtensions = ["image/jpeg", "image/png", "image/gif"];

            if (!validExtensions.includes(file.type)) {
                setError("image", "Solo se permiten imágenes JPEG, PNG y GIF.");
                isValid = false;
            } else if (fileSizeMB > 5) {
                setError("image", "La imagen no debe exceder los 5 MB.");
                isValid = false;
            }
        } else {
            setError("image", "Debes seleccionar una imagen.");
            isValid = false;
        }

        // Si la validación es correcta, enviar el formulario y limpiar campos
        if (isValid) {
            console.log("Formulario válido. Enviando...");
            clearFormFields(); // Limpia los campos
        }
    });

    // Función para limpiar mensajes de error
    function clearErrors() {
        document.querySelectorAll(".error").forEach((element) => {
            element.textContent = "";
        });

        document.querySelectorAll("input, select, textarea").forEach((input) => {
            input.classList.remove("error-border");
        });
    }

    // Función para mostrar mensajes de error
    function setError(field, message) {
        const errorElement = document.getElementById(field + "Error");
        errorElement.textContent = message;

        const inputElement = document.getElementById(field);
        inputElement.classList.add("error-border");
    }

    // Función para limpiar los campos del formulario
    function clearFormFields() {
        form.reset(); 
    }
});
