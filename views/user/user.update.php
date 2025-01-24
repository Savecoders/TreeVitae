<?php require_once HEADER; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil | TreeVitae</title>
    <style>
        .main-container-update {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--background-base);
            padding: 20px;
        }

        .update-container {
            background-color: var(--background-base);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .submit-btn,
        .delete-btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .submit-btn {
            background-color: var(--primary-base);
            color: var(--background-base);
        }

        .delete-btn {
            background-color: var(--primary-base);
            color: var(--background-base);
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <main class="main-container-update">
        <div class="update-container">
            <h1 class="text-center mb-4">Editar Perfil</h1>
            <form action="index.php?c=user&f=update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $userData['ID']; ?>">

                <!-- Campos para editar -->
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de Usuario</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario"
                        value="<?php echo htmlspecialchars($userData['nombre_usuario']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email"
                        value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="(dejar en blanco si no desea cambiarla)">
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?php echo htmlspecialchars($userData['fecha_nacimiento']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="foto_perfil">Foto de Perfil</label>
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <div class="gender-options">
                        <div>
                            <input type="radio" id="male" name="genero" value="M"
                                <?php echo ($userData['genero'] == 'M') ? 'checked' : ''; ?>>
                            <label for="male">Masculino</label>
                        </div>
                        <div>
                            <input type="radio" id="female" name="genero" value="F"
                                <?php echo ($userData['genero'] == 'F') ? 'checked' : ''; ?>>
                            <label for="female">Femenino</label>
                        </div>
                        <div>
                            <input type="radio" id="other" name="genero" value="O"
                                <?php echo ($userData['genero'] == 'O') ? 'checked' : ''; ?>>
                            <label for="other">Otro</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Guardar Cambios</button>
            </form>
            <form action="index.php?c=user&f=delete" method="POST">
                <input type="hidden" name="id" value="<?php echo $userData['ID']; ?>">
                <button type="submit" class="delete-btn">Eliminar Cuenta</button>
            </form>
        </div>
    </main>
</body>

</html>
<?php require_once FOOTER; ?>