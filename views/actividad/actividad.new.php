<?php
//Autor:Agurto Pincay Jose
    require_once HEADER;
    require_once 'utils/cleanser.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Actividad</title>
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
    <h2 class="second-tittle">Registrar Actividad</h2>
        <form action="index.php?c=actividad&f=new&ini=<?php echo htmlspecialchars($parametro); ?>" method="POST" name="formActNueva" id="formActNueva">
            
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" 
                value="<?php echo limpiar($form_data['nombre'] ?? ''); ?>"
                class="<?php echo isset($errores['nombre']) ? 'error' : ''; ?>">
            <?php if (isset($errores['nombre'])): ?>
                <span class="error-message"><?php echo limpiar($errores['nombre']); ?></span>
            <?php endif; ?>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion"
                value="<?php echo limpiar($form_data['descripcion'] ?? ''); ?>"
                class="<?php echo isset($errores['descripcion']) ? 'error' : ''; ?>">
            <?php if (isset($errores['descripcion'])): ?>
                <span class="error-message"><?php echo limpiar($errores['descripcion']); ?></span>
            <?php endif; ?>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio"
                value="<?php echo limpiar($form_data['fecha_inicio'] ?? ''); ?>"
                class="<?php echo isset($errores['fecha_inicio']) ? 'error' : ''; ?>">
            <?php if (isset($errores['fecha_inicio'])): ?>
                <span class="error-message"><?php echo limpiar($errores['fecha_inicio']); ?></span>
            <?php endif; ?>

            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="date" name="fecha_cierre" id="fecha_cierre"
                value="<?php echo limpiar($form_data['fecha_cierre'] ?? ''); ?>"
                class="<?php echo isset($errores['fecha_cierre']) ? 'error' : ''; ?>">
            <?php if (isset($errores['fecha_cierre'])): ?>
                <span class="error-message"><?php echo limpiar($errores['fecha_cierre']); ?></span>
            <?php endif; ?>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion"
                value="<?php echo limpiar($form_data['direccion'] ?? ''); ?>"
                class="<?php echo isset($errores['direccion']) ? 'error' : ''; ?>">
            <?php if (isset($errores['direccion'])): ?>
                <span class="error-message"><?php echo limpiar($errores['direccion']); ?></span>
            <?php endif; ?>

            <div class="checkbox-certified">
                <label for="certificado">Otorga certificado:</label>
                <input type="checkbox" value = "1" name="certificado" id="certificado"
                    <?php echo !empty($form_data['certificado']) ? 'checked' : ''; ?>>
            </div>

            <div id="action-buttons">
                <button type="submit">Registrar</button>
                <a href="index.php?c=actividad&f=viewall&id=<?php echo limpiar($parametro); ?>" id="cancel">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
<?php require_once FOOTER; ?>