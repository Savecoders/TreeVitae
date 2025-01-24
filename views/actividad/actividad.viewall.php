<?php require_once HEADER; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jose Andres Agurto Pincay">
    <title>Actividades</title>
    <style>
        .header-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 900px;
            margin: 0 auto 15px auto;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            font-weight: bold;
        }

        /* Estilos del título */
        .general-tittle {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            padding: 10px;
            width: 150px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .add, .search, .return {
            background-color: rgb(47, 201, 55);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .add:hover {
            background-color: #25eb2c;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin: 0 auto;
        }

        table {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            border-collapse: collapse;
            border: 2px solid #ccc; 
        }

        .botonesTabla {
            display: flex;
            gap: 10px;
        }

        table th {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            background-color: var(--primary-500);
            color: black; 
            border-bottom: 2px solid #ddd;
        }

        table td {
            padding: 10px;
            font-size: 14px;
            border-bottom: 2px solid #ddd;
        }

        table td a {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 3px;
            font-size: 15px;
            cursor: pointer;
        }
        th, td {
            text-align: center; 
            vertical-align: middle; 
        }
        #btnEliminar {
            background-color: rgb(179, 46, 46);
        }

        #btnEliminar:hover {
            background-color: rgb(177, 12, 12);
        }

        * {
            text-decoration: none;
        }

        @media screen and (max-width: 768px) {
            .header-controls {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
        }
    </style>        
</head>
<body>
    <h2 class="general-tittle"> <?php echo ($title)?> </h2>
    <main>
        <div class="header-controls">
            <div class="left-section">
            <?php if (isset($isUserAdmin) && $isUserAdmin){ ?>
                <a href="index.php?c=actividad&f=new_view&ini=<?php echo $parametro;?>">
                    <button class="add">Registrar Actividad</button>
                </a>
            <?php } ?> 
            </div>

            <div class="right-section">
                <form class="search-form">
                    <label for="buscar">Buscar por nombre:</label>
                    <input type="text" name="buscar" id="buscar" placeholder="Buscar...">
                </form>
            </div>
        </div>
    </main>
    <div class="table-container">
            <table id="tabla-registros">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Cierre</th>
                    <th>Dirección</th>
                    <th>Certificación</th>

                    <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                            
                        <th class="th-action">Acciones</th>
                            <?php } ?> 
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                    foreach($actividades as $actividad){
                ?>
                    <tr>
                        <td><?php echo $actividad["ID"]?></td>
                        <td><?php echo $actividad["nombre"]?></td>
                        <td><?php echo $actividad["descripcion"]?></td>
                        <td><?php echo $actividad["fecha_inicio"]?></td>
                        <td><?php echo $actividad["fecha_fin"]?></td>
                        <td><?php echo $actividad["direccion"]?></td>
                        <td>
                            <?php 
                                if($actividad["otorga_certificado"] == 1){
                                    echo "Si";
                                }else{
                                    echo "No";
                                }
                            ?>
                        </td>
                        <td>
                        <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                            
                            <div class="botonesTabla">
                                <a href="index.php?c=actividad&f=update_view&i=<?php echo $actividad["ID"]?>&id=<?php echo $actividad["iniciativa_id"]?>" id="btnEditar">Editar</a>
                                <a onclick="if(!confirm('Está seguro de eliminar el producto?'))return false;" href="index.php?c=actividad&f=delete&i=<?php echo $actividad["ID"]?>&id=<?php echo $actividad["iniciativa_id"]?>" id="btnEliminar">Eliminar</a>
                            </div>
                            <?php } ?>   
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
            </table>
        </div>
    <script>
        const txtBusqueda = document.getElementById("buscar");
        txtBusqueda.addEventListener("keyup", cargar);

        function cargar() {
            const url = `index.php?c=actividad&f=searchAjax&b=${txtBusqueda.value}&id=<?php echo $parametro; ?>&t=${new Date().getTime()}`;

            const xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true); // Corrección aquí
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const respuesta = this.responseText; 
                    actualizar(respuesta);
                }
            };
        }

        function actualizar(respuesta) {
            const tbody = document.getElementById("table-body");
            let actividades = JSON.parse(respuesta); 
            let resul = "";

            actividades.forEach(actividad => {
                resul += `<tr>
                <td>${actividad.ID}</td>
                <td>${actividad.nombre}</td>
                <td>${actividad.descripcion}</td>
                <td>${actividad.fecha_inicio}</td>
                <td>${actividad.fecha_fin}</td>
                <td>${actividad.direccion}</td>
                <td>${actividad.otorga_certificado == 1 ? "Sí" : "No"}</td>
                <td>
                    <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
                        <div class="botonesTabla">
                            <a href="index.php?c=actividad&f=update_view&i=${actividad.ID}&id=${actividad.iniciativa_id}" id="btnEditar">Editar</a>
                            <a href="index.php?c=actividad&f=delete&i=${actividad.ID}&id=${actividad.iniciativa_id}" id="btnEliminar" 
                            onclick="if(!confirm('Está seguro de eliminar el producto?')) return false;">Eliminar</a>  
                        </div>
                    <?php } ?>   
                </td>
                </tr>`;
            });
            tbody.innerHTML = resul; 
        }


    </script>
</body>
</html>
<?php require_once FOOTER; ?>