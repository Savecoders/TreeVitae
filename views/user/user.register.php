<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="author" content="Alex Gabriel Vera Lopez" />
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="public/css/styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="public/assets/icons/logo.svg" type="image/svg+xml" />
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v6.7.0/css/all.css"
        crossorigin="anonymous">
    <title>Registro | TreeVitae</title>
    <style>
        .maincontainerregister {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--background-base);
            width: 100%;
            padding: 20px;
        }

        .register_container {
            background-color: var(--background-base);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }

        .tittle_register {
            text-align: center;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .form-group.error .error-message {
            display: block;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .gender-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-base);
            color: var(--background-base);
            border: none;
            border-radius: 8px;
            font-size: 2.2ch;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group .file-input-label {
            display: inline-block;
            padding: 0.75rem 1rem;
            background-color: var(--background-base);
            border: 1px solid var(--text-700);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #profile-photo {
            display: none;
        }

        .profile-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-top: 1rem;
            display: none;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 40px;
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        @media (max-width: 600px) {
            .register_container {
                padding: 1rem;
            }

            .gender-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <main class="main__container__register">
        <div class="register_container">
            <h1 class="tittle_register">Registro</h1>
            <form id="registerForm" action="index.php?c=user&f=agregar" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="nombre_usuario" />
                    <span class="error-message">Por favor ingresa tu nombre</span>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" />
                    <span class="error-message">Por favor ingresa un correo electrónico válido</span>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" />
                    <img
                        src="public/assets/icons/Inactive_Paswword.svg"
                        alt="Mostrar contraseña"
                        class="password-toggle"
                        id="passwordToggle" />
                    <span class="error-message">La contraseña debe tener al menos 8 caracteres</span>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirmar contraseña</label>
                    <input type="password" id="confirm-password" name="confirm-password" />
                    <img
                        src="public/assets/icons/Inactive_Paswword.svg"
                        alt="Mostrar contraseña"
                        class="password-toggle"
                        id="confirmPasswordToggle" />
                    <span class="error-message">Las contraseñas no coinciden</span>
                </div>

                <div class="form-group">
                    <label for="birthdate">Fecha de nacimiento</label>
                    <input type="date" id="birthdate" name="fecha_nacimiento" />
                    <span class="error-message">Por favor selecciona tu fecha de nacimiento</span>
                </div>

                <div class="form-group">
                    <label for="profile-photo">Foto de perfil</label>
                    <label class="file-input-label" for="profile-photo">
                        Seleccionar archivo
                        <input type="file" id="profile-photo" name="foto_perfil" accept="image/*" />
                    </label>
                    <img id="preview" class="profile-preview" src="#" alt="Vista previa" />
                    <span class="error-message">Por favor selecciona una imagen</span>
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <div class="gender-options">
                        <div class="gender-option">
                            <input type="radio" id="male" name="genero" value="M" />
                            <label for="male">Masculino</label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" id="female" name="genero" value="F" />
                            <label for="female">Femenino</label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" id="other" name="genero" value="O" />
                            <label for="other">Otro</label>
                        </div>
                    </div>
                    <span class="error-message">Por favor selecciona tu género</span>
                </div>

                <button class="submit-btn">Registrarse</button>
            </form>
            <?php if (isset($_SESSION['mensaje'])) { ?>
                <div class="notify-messages">
                    <?php if ($_SESSION['type'] == 'success') { ?>
                        <div class="message success" role="alert">
                            <?php echo $_SESSION['mensaje']; ?>
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    <?php } else { ?>
                        <div class="message error" role="alert">
                            <?php echo $_SESSION['mensaje']; ?>
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                    <?php } ?>
                </div>

            <?php
                unset($_SESSION['mensaje']);
                unset($_SESSION['type']);
            } ?>
        </div>
    </main>
    <script type="module" src="public/js/components/message.js"></script>
    <script type="module" src="public/js/user/registro.js"></script>
</body>

</html>