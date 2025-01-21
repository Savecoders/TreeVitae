<?php require_once HEADER; ?>
<style>
    #titulo {
        color: var(--primary-500);
        text-align: center;
        margin-bottom: 20px;
        font-size: 28px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: black;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
        text-align: center; 
        vertical-align: middle; 
    }

    th {
        background-color: var(--primary-500);
        color: black;
        text-align: center; 
    }

    #foto {
        max-width: 120px;
        max-height: 120px;
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #buscador {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        gap: 10px;
    }

    #buscador input[type="text"] {
        padding: 8px;
        width: 300px;
        border: 1px solid var(--primary-500);
        border-radius: 5px;
        box-sizing: border-box;
        height: 40px; 
        font-size: 16px;
    }

    .btn-search {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 15px; 
        height: 40px; 
        background-color: black;
        border: 2px solid green;
        color: white;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #buscador, .btn-view,
    .btn-delete {
        padding: 8px 15px;
        background-color: black;
        border: 2px solid green;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }


    .btn-view:hover{
        background-color: green;
        border: 5px solid green;
        color: black;
    }

    .btn-delete:hover{
        background-color: red;
        border: 5px solid red;
        color: black;
    }

    .no-results {
        text-align: center;
        color: var(--danger-500);
        font-size: 18px;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }
        
        .btn-view, .btn-delete {
            padding: 6px 12px;
            font-size: 12px;
        }
    }
</style>
<body>
    <main class="main__container__content">
    <h1 id="titulo">Lista de Contactos</h1>

        <form method="GET" action="index.php?c=contact&f=search" style="margin-bottom: 20px;">
            <input type="hidden" name="c" value="contact">
            <input type="hidden" name="f" value="search">
            <input type="text" name="asunto" placeholder="Buscar por asunto..." value="<?= htmlspecialchars($_GET['asunto'] ?? '') ?>">
            <button class="btn-search" type="submit">
                <img src="public/assets/icons/search.svg" alt="search icon" />
                Buscar
            </button>
        </form>
        
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message"><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>
        <?php if (!empty($contactos)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Prioridad</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactos as $contacto): ?>
                        <tr data-id="<?= htmlspecialchars($contacto['ID']);?>">
                            <td><?= htmlspecialchars($contacto['ID']); ?></td>
                            <td><?= htmlspecialchars($contacto['nombres']); ?></td>
                            <td><?= htmlspecialchars($contacto['apellidos']); ?></td>
                            <td><?= htmlspecialchars($contacto['email']); ?></td>
                            <td><?= htmlspecialchars($contacto['telefono']); ?></td>
                            <td><?= htmlspecialchars($contacto['prioridad']); ?></td>
                            <td><?= htmlspecialchars($contacto['asunto']); ?></td>
                            <td><?= htmlspecialchars($contacto['mensaje']); ?></td>
                            <td>
                                <?php if (!empty($contacto['imagen'])): ?>
                                    <img id="foto" src="data:image;base64,<?php echo base64_encode($contacto['imagen']); ?>" />
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn-view" onclick="window.location.href='index.php?c=contact&f=view&id=<?=$contacto['ID'];?>'">Ver</button>
                                <button type="button" class="btn-delete" onclick="window.location.href='index.php?c=contact&f=delete&id=<?=$contacto['ID'];?>'">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-results">No existe ese Asunto que está buscando.</p>
        <?php endif; ?>
    </main>
</body>
<?php require_once FOOTER; ?>