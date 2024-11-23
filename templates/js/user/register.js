document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registerForm');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const passwordToggle = document.getElementById('passwordToggle');
  const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
  const profilePhotoInput = document.getElementById('profile-photo');
  const previewImage = document.getElementById('preview');
  const formGroups = form.querySelectorAll('.form-group');

  const togglePasswordVisibility = (input, toggleIcon) => {
    toggleIcon.addEventListener('click', () => {
      if (input.type === 'password') {
        input.type = 'text';
        toggleIcon.src = '../../assets/icons/Active_Password.svg';
        toggleIcon.alt = 'Ocultar contraseña';
      } else {
        input.type = 'password';
        toggleIcon.src = '../../assets/icons/Inactive_Paswword.svg';
        toggleIcon.alt = 'Mostrar contraseña';
      }
    });
  };

  togglePasswordVisibility(passwordInput, passwordToggle);
  togglePasswordVisibility(confirmPasswordInput, confirmPasswordToggle);

  // Validaciones en tiempo real
  form.addEventListener('input', event => {
    const target = event.target;
    if (target.hasAttribute('required')) {
      validateField(target);
    }
    if (target.id === 'confirm-password' || target.id === 'password') {
      validatePasswordsMatch();
    }
  });

  // Validación al enviar el formulario
  form.addEventListener('submit', event => {
    let isValid = true;

    formGroups.forEach(group => {
      const input = group.querySelector('input, select');
      if (input) {
        isValid = validateField(input) && isValid;
      }
    });

    if (!validatePasswordsMatch()) {
      isValid = false;
    }

    if (!isValid) {
      event.preventDefault();
    } else {
      // Limpiar campos y mensajes de error
      form.reset(); // Resetear los campos del formulario
      formGroups.forEach(group => {
        group.classList.remove('error'); // Eliminar clases de error
        const errorMessage = group.querySelector('.error-message');
        if (errorMessage) {
          errorMessage.style.display = 'none'; // Ocultar mensajes de error
        }
      });
      previewImage.style.display = 'none'; // Ocultar la imagen previa
    }
  });

  // Validar un campo específico
  const validateField = input => {
    const group = input.closest('.form-group');
    const errorMessage = group.querySelector('.error-message');

    if (!input.validity.valid) {
      group.classList.add('error');
      errorMessage.style.display = 'block';
      return false;
    } else {
      group.classList.remove('error');
      errorMessage.style.display = 'none';
      return true;
    }
  };

  // Validar que las contraseñas coincidan
  const validatePasswordsMatch = () => {
    const group = confirmPasswordInput.closest('.form-group');
    const errorMessage = group.querySelector('.error-message');

    if (passwordInput.value !== confirmPasswordInput.value) {
      group.classList.add('error');
      errorMessage.textContent = 'Las contraseñas no coinciden';
      return false;
    } else {
      group.classList.remove('error');
      return true;
    }
  };

  // Previsualizar la imagen de perfil
  profilePhotoInput.addEventListener('change', () => {
    const file = profilePhotoInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = e => {
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      previewImage.style.display = 'none';
    }
  });
});
