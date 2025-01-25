<?php require_once HEADER; ?>
<!-- Autor: Vivanco Garcia Angel Enrique -->
<style>
    #buscador {
        padding: 8px;
        width: 300px;
        border: 1px solid var(--primary-950);
        border-radius: 5px;
        box-sizing: border-box;
        height: 40px;
        font-size: 16px;
        flex: 1;
        min-width: 200px;
    }

    .formulario {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }

    .post-card {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .post-content {
        flex: 1;
    }

    .post-content h3 {
        margin: 0;
        font-size: 24px;
        color: #fff;
    }

    .post-content p {
        font-size: 18px;
        color: #fff;
    }

    .buttons {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .btn.delete {
        background-color: var(--danger-base);
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>

<main class="main__container__content">
    <h1 class="title__principal">Posts</h1>

    <!-- <form class="formulario" >
        <input id="buscador" name="asunto" placeholder="Buscar por asunto..." value="<?= htmlspecialchars($_GET['asunto'] ?? '') ?>">
        <?php if (isset($isUserAdmin) && !$isUserAdmin) { ?>
            <div>
                <a href="index.php?c=contact&f=new_view&id=<?php echo $parametro; ?>" class="btn-add">Crear contacto</a>
            </div>
        <?php } ?>
    </form> -->

    <div class="container_post_list">
        <?php foreach ($post as $postt): ?>
            <div class="post-card">
                <div class="post-content">
                    <p>Autor: <?php echo htmlspecialchars($postt['nombre_usuario']); ?></p>
                    <h3><?php echo htmlspecialchars($postt['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($postt['subtitulo']); ?></p>
                </div>
                <div class="buttons">
                    <a href="index.php?c=post&f=new_update&id=<?php echo $postt['ID']; ?>" class="btn">Actualizar</a>
                    <a href="index.php?c=post&f=delete&id=<?php echo $postt['ID']; ?>&i=<?php echo $postt['iniciativa_id']; ?>" class="btn delete">Eliminar</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
    const txtBuscar = document.getElementById("buscador");
    txtBuscar.addEventListener("keyup", cargar);

    function cargar() {
        const url = `index.php?c=contact&f=search&b=${txtBuscar.value}&id=<?php echo $parametro ?>`;
        const xmlh = new XMLHttpRequest();
        xmlh.open("GET", url, true);
        xmlh.send();
        xmlh.onreadystatechange = function() {
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

<?php require_once FOOTER; ?>