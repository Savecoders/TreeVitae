<?php require_once HEADER; ?>
<!--Autor: Farfan Sanchez Abraham-->
<style>
    .title__principal{
        color: var(--primary-500);
        text-align: center;
        font-weight: 600;
        font-family: 'Raleway', sans-serif;
        font-size: 34px;
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

    #buscador{
        padding: 8px;
        width: 300px;
        border: 1px solid var(--primary-500);
        border-radius: 5px;
        box-sizing: border-box;
        height: 40px; 
        font-size: 16px;
        flex: 1;
        min-width: 200px;
    }

    .btn-add{
        display: inline-flex; 
        justify-content: center; 
        align-items: center; 
        padding: 8px 15px; 
        height: 40px; 
        font-size: 16px; 
        color: white; 
        background-color: black; 
        border: 2px solid green; 
        border-radius: 5px; 
        text-decoration: none; 
        cursor: pointer; 
        transition: all 0.3s ease; 
        white-space: nowrap;
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
    .btn-delete,.btn-edit {
        padding: 8px 15px;
        background-color: black;
        border: 2px solid green;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none; 
    }

    .no-results {
        text-align: center;
        color: var(--danger-500);
        font-size: 18px;
        margin-top: 20px;
    }

    .formulario {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap; 
        justify-content: center;
        margin-bottom: 20px;
    }

    .button-container {
        display: flex;
        justify-content: flex-end; 
        margin-bottom: 10px; 
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
    <h1 class="title__principal">Lista de Contactos</h1>

        <form class="formulario" method="GET" action="index.php?c=contact&f=search" style="margin-bottom: 20px;">
            <input type="hidden" name="c" value="contact">
            <input type="hidden" name="f" value="search">
            <input id="buscador" name="asunto" placeholder="Buscar por asunto..." value="<?= htmlspecialchars($_GET['asunto'] ?? '') ?>">
            <button class="btn-search" type="submit">
                <img src="public/assets/icons/search.svg" alt="search icon" />
                Buscar
            </button>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prioridad</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <th>Imagen</th>
                    <th>Ver información</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $contacto): ?>
                    <tr data-id="<?= htmlspecialchars($contacto['ID']);?>">
                        <td><?= htmlspecialchars($contacto['ID']); ?></td>
                        <td><?= htmlspecialchars($contacto['prioridad']); ?></td>
                        <td><?= htmlspecialchars($contacto['asunto']); ?></td>
                        <td><?= htmlspecialchars($contacto['mensaje']); ?></td>
                        <td>
                            <?php if (!empty($contacto['imagen'])): ?>
                                <img id="foto" src="data:image;base64,<?php echo base64_encode($contacto['imagen']); ?>" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?c=contact&f=view&id=<?=$contacto['ID'];?>" class="btn-view">Ver</a>
                        </td>
                        <td>
                            <a href="index.php?c=contact&f=new_update&id=<?=$contacto['ID'];?>" class="btn-edit">Editar</a>
                        </td>
                        <td>
                            <a href="index.php?c=contact&f=delete&id=<?=$contacto['ID'];?>" class="btn-delete">Eliminar</a>
                        </td>
                    </tr>
                    <div class="button-container">
                        <a href="index.php?c=contact&f=new_view&id=<?=$contacto['iniciativa_id']; ?>" class="btn-add">Crear contacto</a>
                    </div>
                <?php endforeach; ?>
            </tbody>
         </table>
    </main>
</body>
<?php require_once FOOTER; ?>