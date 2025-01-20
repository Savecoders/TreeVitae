<?php require_once HEADER; ?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: black;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: var(--primary-500);
        color: black;
        text-align: center; 
    }

    img {
        max-width: 150px;
        max-height: 150px;
        border-radius: 5px;
    }

    a {
        text-decoration: none;
    }

    .btn-view {
        background-color: #4CAF50; 
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .btn-view:hover {
        background-color: #45a049;
    }

    .btn-delete {
        background-color: #f44336; 
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-delete:hover {
        background-color: #e53935;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-buttons button {
        margin-right: 10px;
    }
</style>
<body>
    <main class="main__container__content">
    <h1>Lista de Contactos</h1>
        
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
                                    <img src="data:image;base64,<?php echo base64_encode($contacto['imagen']); ?>" />
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="submit"class="btn-view" onclick="window.location.href='index.php?c=contact&f=viewall&id=<?= htmlspecialchars($contacto['ID']); ?>'">Ver</button>
                                <button type="submit" class="btn-delete" data-id="<?= htmlspecialchars($contacto['ID']); ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Confirmar eliminación</h2>
                    <p>¿Está seguro de eliminar este contacto?</p>
                    <div class="modal-buttons">
                        <button id="cancelDelete">Cancelar</button>
                        <button id="confirmDelete">Confirmar</button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>No hay contactos registrados.</p>
        <?php endif; ?>
    </main>
</body>

<script type="module" src="public/js/initiatives/contact.js"></script>
<?php require_once FOOTER; ?>