<!--autor:Alex Vera Lopez-->
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php require_once HEADER; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/styles.css" />
    <link rel="icon" href="public/assets/icons/logo.svg" type="image/svg+xml" />
    <title>Búsqueda de Usuarios | TreeVitae</title>
    <style>
        .main-container {
            padding: 20px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-form input {
            width: 100%;
            padding: 10px;

            border-radius: 4px;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: var(--primary-base);
            color: var(--background-base);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--background-200);
        }

        a {
            color: var(--primary-base);
            text-decoration: none;
            text-decoration: underline;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            margin-bottom: x;
        }

        .error-message {
            color: var(--error-color);
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <main class="main-container">
        <h1>Búsqueda de Usuarios con Iniciativas</h1>
        <form class="search-form" action="index.php" method="GET">
            <input type="hidden" name="c" value="user">
            <input type="hidden" name="f" value="search_view">
            <input type="text" name="name" placeholder="Buscar por nombre de usuario..." value="<?php echo htmlspecialchars($_GET['name'] ?? ''); ?>">
            <button type="submit">Buscar</button>
        </form>

        <div class="table-container">
            <?php if (isset($users) && !empty($users)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Iniciativa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td>
                                    <a href="index.php?c=user&f=profile_view&id=<?php echo $user['ID']; ?>">
                                        <i class="fa-solid fa-up-right-from-square"></i>
                                        <?php echo htmlspecialchars($user['nombre_usuario']); ?>

                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>Administrador</td>
                                <td>

                                    <a href="index.php?c=iniciativa&f=view&id=<?php echo $user['iniciativa_id']; ?>">
                                        <i class="fa-solid fa-up-right-from-square"></i>
                                        <?php echo htmlspecialchars($user['iniciativa_nombre']); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p class="error-message">No se encontraron usuarios con iniciativas que coincidan con el término de búsqueda.</p>
            <?php } ?>
        </div>
    </main>
    <script type="module" src="public/js/components/message.js"></script>
</body>

</html>
<?php require_once FOOTER; ?>