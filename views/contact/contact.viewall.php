<?php require_once HEADER; ?>
<!--Autor: Farfan Sanchez Abraham-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        text-align: center; 
        vertical-align: middle; 
    }

    th {
        background-color: var(--primary-500);
        color: black;
        text-align: center; 
    }

    #buscador{
        padding: 8px 15px;
        background-color: black;
        border: 2px solid green;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        flex: 1;
    }

    .btn-add{
        display: flex; 
        justify-content: center; 
        align-items: center; 
        padding: 8px 15px; 
        color: white; 
        background-color: black; 
        border: 2px solid green; 
        border-radius: 5px; 
        text-decoration: none; 
        cursor: pointer; 
    }

    .btn-view, .btn-delete, .btn-edit {
        padding: 8px 15px;
        background-color: black;
        border: 2px solid green;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px;
        text-decoration: none; 
    }

    .formulario {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap; 
        justify-content: center;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }
        
        .btn-view, .btn-edit, .btn-delete {
            padding: 6px 12px;
            font-size: 12px;
        }
    }
</style>
</head>
<body>
<main class="main__container__content">
    <h1 class="title__principal">Lista de Contactos</h1>

    <form class="formulario" >
            <input id="buscador" name="asunto" placeholder="Buscar por asunto..." value="<?= htmlspecialchars($_GET['asunto'] ?? '') ?>">
            <?php if (isset($isUserAdmin) && !$isUserAdmin) { ?>
                <div>
                    <a href="index.php?c=contact&f=new_view&id=<?php echo $parametro;?>" class="btn-add">Crear contacto</a>
                </div>
            <?php } ?>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prioridad</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                        <th>Ver información</th>
                    <?php } ?>
                    <?php if (isset($isUserAdmin) && !$isUserAdmin) { ?>
                        <th>Editar</th>
                    <?php } ?>
                    <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                        <th>Eliminar</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="tablaContacto">
                <?php foreach ($contactos as $contacto): ?>
                    <tr data-id="<?= htmlspecialchars($contacto['ID']);?>">
                        <td><?= htmlspecialchars($contacto['ID']); ?></td>
                        <td><?= htmlspecialchars($contacto['prioridad']); ?></td>
                        <td><?= htmlspecialchars($contacto['asunto']); ?></td>
                        <td><?= htmlspecialchars($contacto['mensaje']); ?></td>
                        <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                            <td>
                                <a href="index.php?c=contact&f=view&id=<?=$contacto['ID'];?>" class="btn-view">Ver</a>
                            </td>
                        <?php } ?>
                        <?php if (isset($isUserAdmin) && !$isUserAdmin) { ?>
                            <td>
                                <a href="index.php?c=contact&f=new_update&id=<?=$contacto['ID'];?>" class="btn-edit">Editar</a>
                            </td>
                        <?php } ?>
                        <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                            <td>
                                <a href="index.php?c=contact&f=delete&id=<?=$contacto['ID'];?>&i=<?=$contacto['iniciativa_id'];?>" class="btn-delete">Eliminar</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
         </table>
    </main>
    <script>
        const txtBuscar = document.getElementById("buscador");
        txtBuscar.addEventListener("keyup", cargar);
        function cargar(){
            const url = `index.php?c=contact&f=search&b=${txtBuscar.value}&id=<?php echo $parametro ?>`;
            const xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true); 
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const respuesta = this.responseText; 
                    actualizar(respuesta);
                }
            };
        }

        function actualizar(respuesta) {
            const tbody = document.getElementById("tablaContacto");
            let contactos = JSON.parse(respuesta); 
            let resul = "";

            contactos.forEach(contacto => {
                resul += `<tr>
                <td>${contacto.ID}</td>
                <td>${contacto.prioridad}</td>
                <td>${contacto.asunto}</td>
                <td>${contacto.mensaje}</td>
                        <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                            <td>
                                <a href="index.php?c=contact&f=view&i=${contacto.id}" class="btn-view">Ver</a>
                            </td>
                        <?php } ?>
                        <?php if (isset($isUserAdmin) && !$isUserAdmin) { ?>
                            <td>
                                <a href="index.php?c=contact&f=new_update&i=${contacto.id}" class="btn-edit">Modificar</a>
                            </td>
                        <?php } ?>
                        <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                            <td>
                                <a href="index.php?c=contact&f=delete&i=${contacto.id}&id=${contacto.iniciativa_id}" class="btn-delete">Eliminar</a>
                            </td>
                        <?php } ?>       
                </tr>`;
            });
            tablaContacto.innerHTML = resul; 
        }
    </script>
</body>
</html>
<?php require_once FOOTER; ?>