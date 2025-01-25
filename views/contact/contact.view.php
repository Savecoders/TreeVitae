<?php require_once HEADER; ?>
<!--Autor: Farfan Sanchez Abraham-->
<style>
    .contact-details {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: var(--primary-100);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        color: black;
        text-align: center;
        font-size: 18px
    }

    .title__principal{
        text-align: center;
        color: var(--primary-500);
        font-weight: 600;
        font-family: 'Raleway', sans-serif;
        font-size: 34px;
        margin: 20px;
    }

    .contact-details{
        text-align: center;
        margin-bottom: 20px;
        color: var(--primary-500);
    }

    .btn-cancel{
        display: inline-block;
        padding: 10px;
        background-color: black; 
        color: white;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        border-radius: 6px;
        border: 2px solid green; 
        margin-top: 20px;
        width: 100%;
        text-transform: uppercase;
    }
    
    .contact-details img {
        border-radius: 50%;
        object-fit: cover;
        height: 150px;
        width: 150px;
        margin: 20px auto;
    }

    .contact-details table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
        border: 1px solid
    }

    .contact-details th, .contact-details td {
        padding: 15px;
        border-radius: 8px;
    }

    .contact-details th {
        color: #fff;
    }

    @media (max-width: 768px) {
    .contact-details {
        max-width: 100%;
        padding: 10px;
    }

    .contact-details table {
        font-size: 14px;
    }

    .contact-details th, .contact-details td {
        padding: 5px;
    }
    }
</style>
<body>
    <main>
        <div class="contact-details">
            <h1 class="title__principal">Detalles del Contacto</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <td id="contactId"><?php echo htmlspecialchars($contacto['ID']); ?></td>
                </tr>
                <tr>
                    <th>Nombres: </th>
                    <td id="contactFirstName"><?php echo htmlspecialchars($contacto['nombres']); ?></td>
                </tr>
                <tr>
                    <th>Apellidos: </th>
                    <td id="contactLastName"><?php echo htmlspecialchars($contacto['apellidos']); ?></td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td id="contactEmail"><?php echo htmlspecialchars($contacto['email']); ?></td>
                </tr>
                <tr>
                    <th>Teléfono: </th>
                    <td id="contactPhone"><?php echo htmlspecialchars($contacto['telefono']); ?></td>
                </tr>
                <tr>
                    <th>Prioridad: </th>
                    <td id="contactPriority"><?php echo htmlspecialchars($contacto['prioridad']); ?></td>
                </tr>
                <tr>
                    <th>Asunto: </th>
                    <td id="contactSubject"><?php echo htmlspecialchars($contacto['asunto']); ?></td>
                </tr>
                <tr>
                    <th>Mensaje: </th>
                    <td id="contactMessage"><?php echo htmlspecialchars($contacto['mensaje']); ?></td>
                </tr>
            </table>
            <div class="container__component">
                <a href="index.php?c=contact&f=viewall&id=<?php echo limpiar($contacto['iniciativa_id']); ?>" class="btn-cancel">Salir</a>
            </div>
        </div>
    </main>
</body>
<?php require_once FOOTER; ?>