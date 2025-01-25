<?php
//Autor:Agurto Pincay Jose
    require_once 'utils/cleanser.php';
    require_once HEADER;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Actividad</title>
    <style>
        main {
            width: 100%;
            max-width: 450px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .second-tittle {
            color: rgb(252, 245, 245);
            text-align: center;
            margin: 10px 0 20px 0;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 15px;
            color:rgb(252, 245, 245);
        }

        input:not([type="checkbox"]) {
            font-size: 16px;
            padding: 10px;
            margin: 0 0 20px 0;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .checkbox-certified input[type="checkbox"] {
            width: 20px;
            height: 17px;
            margin: 0;
        }

        .error {
            background-color: #f8d7da;
        }

        .error-message {
            color: red;
            font-size: 15px;
            margin-bottom: 20px; 
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        #action-buttons{
            display: flex;
            margin-top: 20px;
            text-align: center;
        }

        #action-buttons a{
            text-decoration: none;
            background-color:rgb(61, 185, 175);
        }

        #action-buttons a:hover{
            background-color:rgb(86, 185, 177);
        }

        button, #cancel {
            padding: 10px;
            margin-top: 10px;
            background-color: var(--primary-base);
            color: black;
            border: none;
            border-radius: 4px;
            font-size: 19px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: auto;
            min-width: 150px;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color:rgb(91, 221, 145);
        }

        button:focus {
            outline: none;
        }

        @media (max-width: 768px) {
            main {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <main>
        <h2 class="second-tittle"><?php echo ($title)?></h2>
        <form action="index.php?c=actividad&f=update&i=<?php echo $actividad['ID']; ?>&id=<?php echo $idIni; ?>" method="POST" name="formActNueva" id="formActNueva">
            <!-- Nombre -->
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre"
                value="<?php echo limpiar($_SESSION['form_data']['nombre'] ?? $actividad['nombre'] ?? ''); ?>" 
                class="<?php echo !empty($_SESSION['errores']['nombre']) ? 'error' : ''; ?>">
            <?php if (!empty($_SESSION['errores']['nombre'])): ?>
                <span class="error-message"><?php echo $_SESSION['errores']['nombre']; ?></span>
            <?php endif; ?>

            <!-- Descripción -->
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion"
                value="<?php echo limpiar($_SESSION['form_data']['descripcion'] ?? $actividad['descripcion'] ?? ''); ?>"
                class="<?php echo !empty($_SESSION['errores']['descripcion']) ? 'error' : ''; ?>">
            <?php if (!empty($_SESSION['errores']['descripcion'])): ?>
                <p class="error-message"><?php echo $_SESSION['errores']['descripcion']; ?></p>
            <?php endif; ?>

            <!-- Fecha de Inicio -->
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio"
                value="<?php echo limpiar($_SESSION['form_data']['fecha_inicio'] ?? $actividad['fecha_inicio'] ?? ''); ?>"
                class="<?php echo !empty($_SESSION['errores']['fecha_inicio']) ? 'error' : ''; ?>">
            <?php if (!empty($_SESSION['errores']['fecha_inicio'])): ?>
                <p class="error-message"><?php echo $_SESSION['errores']['fecha_inicio']; ?></p>
            <?php endif; ?>

            <!-- Fecha de Cierre -->
            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="date" name="fecha_cierre" id="fecha_cierre"
                value="<?php echo limpiar($_SESSION['form_data']['fecha_cierre'] ?? $actividad['fecha_fin'] ?? ''); ?>"
                class="<?php echo !empty($_SESSION['errores']['fecha_cierre']) ? 'error' : ''; ?>">
            <?php if (!empty($_SESSION['errores']['fecha_cierre'])): ?>
                <p class="error-message"><?php echo $_SESSION['errores']['fecha_cierre']; ?></p>
            <?php endif; ?>

            <!-- Dirección -->
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion"
                value="<?php echo limpiar($_SESSION['form_data']['direccion'] ?? $actividad['direccion'] ?? ''); ?>"
                class="<?php echo !empty($_SESSION['errores']['direccion']) ? 'error' : ''; ?>">
            <?php if (!empty($_SESSION['errores']['direccion'])): ?>
                <p class="error-message"><?php echo $_SESSION['errores']['direccion']; ?></p>
            <?php endif; ?>

            <!-- Otorga Certificado -->
            <div class="checkbox-certified">
                <label for="certificado">Otorga certificado:</label>
                <input type="checkbox" value = "1" name="certificado" id="certificado"
                    <?php echo (!empty($_SESSION['form_data']['certificado']) || (!empty($actividad['otorga_certificado']) && $actividad['otorga_certificado'] == 1)) ? 'checked' : ''; ?>>
            </div>

            <!-- Botones de acción -->
            <div id="action-buttons">
                <button type="submit">Actualizar</button>
                <a href="index.php?c=actividad&f=viewall&id=<?php echo limpiar($actividad['iniciativa_id']); ?>" id="cancel">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
<?php require_once FOOTER; ?>