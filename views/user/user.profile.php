<?php require_once HEADER; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        .main__container__profile {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(50vh - 100px);
            background-color: var(--background-base);
            width: 100%;
            padding: 20px;
        }

        .profile-container {
            background-color: var(--background-base);
            border-radius: 10px;
            padding: 2rem;
            width: 100%;
            max-width: 1000px;
            /* Increased max-width */
        }

        .profile_header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        .info_perfil {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .info_perfil {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .form_campos {
            background-color: var(--background-100);
            padding: 0.75rem;
            border-radius: 8px;
        }

        .form_campos label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: var(--text-color);
            font-size: 0.9rem;
        }

        .form_campos input {
            width: 100%;
            max-width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid var(--border-color);
            padding: 0.5rem 0;
            color: var(--text-color);
            font-size: 1rem;
            outline: none;
        }

        .form_campos input:read-only {
            cursor: not-allowed;
            opacity: 0.7;
        }
    </style>
    </style>
</head>

<body>
    <main class="main__container__profile">
        <div class="profile-container">
            <form method="POST" action="index.php?c=user&f=update_profile">
                <div class="profile_header">
                    <!-- Foto de perfil -->
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($userData['foto_perfil']); ?>" alt="Foto de Perfil" class="profile-photo">
                </div>
                <div class="info_perfil">
                    <div class="form_campos">
                        <label for="nombre_usuario">Nombre de Usuario:</label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($userData['nombre_usuario']); ?>" readonly>
                    </div>
                    <div class="form_campos">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>
                    </div>
                    <div class="form_campos">
                        <label for="fecha_registro">Fecha de Registro:</label>
                        <input type="text" id="fecha_registro" name="fecha_registro" value="<?php echo htmlspecialchars($userData['fecha_registro']); ?>" readonly>
                    </div>
                    <div class="form_campos">
                        <label for="genero">Género:</label>
                        <input type="text" id="genero" name="genero" value="<?php
                                                                            switch ($userData['genero']) {
                                                                                case 'M':
                                                                                    echo 'Masculino';
                                                                                    break;
                                                                                case 'F':
                                                                                    echo 'Femenino';
                                                                                    break;
                                                                                case 'O':
                                                                                    echo 'Otro';
                                                                                    break;
                                                                                default:
                                                                                    echo 'No especificado';
                                                                            }
                                                                            ?>" readonly>
                    </div>
                </div>
            </form>
    </main>

</body>

</html>
<?php require_once FOOTER; ?>