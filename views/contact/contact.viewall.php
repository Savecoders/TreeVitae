<?php require_once HEADER; ?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f4f4f4;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    img {
        max-width: 50px;
        max-height: 50px;
    }
</style>
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
                    <tr>
                        <td><?= htmlspecialchars($contacto['id']); ?></td>
                        <td><?= htmlspecialchars($contacto['nombres']); ?></td>
                        <td><?= htmlspecialchars($contacto['apellidos']); ?></td>
                        <td><?= htmlspecialchars($contacto['email']); ?></td>
                        <td><?= htmlspecialchars($contacto['telefono']); ?></td>
                        <td><?= htmlspecialchars($contacto['prioridad']); ?></td>
                        <td><?= htmlspecialchars($contacto['asunto']); ?></td>
                        <td><?= htmlspecialchars($contacto['mensaje']); ?></td>
                        <td>
                            <?php if (!empty($contacto['imagen'])): ?>
                                <img src="<?= htmlspecialchars($contacto['imagen']); ?>" alt="Imagen de <?= htmlspecialchars($contacto['nombres']); ?>" width="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="view.php?id=<?= htmlspecialchars($contacto['id']); ?>">Ver</a>
                            <a href="delete.php?id=<?= htmlspecialchars($contacto['id']); ?>" onclick="return confirm('¿Está seguro de eliminar este contacto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay contactos registrados.</p>
    <?php endif; ?>
</main>
<?php require_once FOOTER; ?>