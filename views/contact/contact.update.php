<?php require_once HEADER; ?>
<style>
    .title__principal {
        font-size: 34px;
        font-weight: 600;
        color: var(--primary-500);
        font-family: 'Raleway', sans-serif;
        text-align: center;
    }

    .container__principal {
        display: flex;
    }

    .container__form {
        padding: 20px;
        width: 900px;
        margin: auto;
        border-radius: 10px;
        margin-top: 50px;
    }

    .container__first {
        display: flex;
        gap: 30px;
    }

    #container__second {
        margin: 20px 0;
        border: 1px solid var(--primary-400);
        border-radius: 5px;
        padding: 10px;
        flex: 3;
    }

    .container__component {
        display: grid;
        padding: 10px;
        gap: 10px;
        width: 100%;
        max-width: 1920px;
        padding-left: max(20px, 4%);
        padding-right: max(20px, 4%);
    }

    #label__form {
        padding: 0 6px;
        font-family: 'Raleway', sans-serif;
        color: var(--text-900);
        border: 1px solid var(--primary-400);
        border-radius: 5px;
    }

    .container__personal {
        display: flex;
        gap: 20px;
    }

    .container__personal .container__component {
        flex: 1;
    }

    .label__name {
        font-size: 1.8ch;
        font-weight: 600;
        color: var(--text-900);
        font-family: 'Raleway', sans-serif;
    }

    .input__text {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid var(--accent-400);
        background-color: var(--background-50);
        color: var(--text-base);
        box-shadow: 0px 0px 10px var(--background-50);
        border-radius: 4px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .input__text:focus {
        border-color: var(--primary-400);
        box-shadow: 0px 0px 12px var(--primary-400);
    }

    .textarea__comment {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid var(--background-950);
        background-color: var(--background-base);
        color: var(--text-base);
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s ease;
        resize: none;
        height: 100px;
    }

    .textarea__comment:focus {
        border-color: var(--primary-base);
    }

    .btn-update{
        width: 100%;
        padding: 10px;
        background-color: black;
        color: white;
        border: 2px solid green; 
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        text-transform: uppercase;
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

    .input__container select {
        width: 100%; 
        padding: 12px 14px; 
        font-size: 1em; 
        font-family: 'Raleway', sans-serif; 
        color: var(--text-base); 
        background-color: var(--background-base);
        border: 1px solid var(--background-950); 
        border-radius: 5px;
        appearance: none; 
        outline: none; 
        cursor: pointer; 
    }

    .input__container select option {
        color: white; 
        background-color: black; 
        padding: 12px;
    }

    .info__container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .info__box {
        flex: 1;
        padding: 20px;
        background-color: var(--background-50);
        border-radius: 10px;
        box-shadow: 0px 0px 10px var(--background-50);
    }

    .title__info {
        margin: 10px;
    }

    .info__box .title__info {
        color: var(--text-900);
        margin-bottom: 10px;
        font-size: 1.7ch;
        line-height: 1.3;
        font-family: 'Raleway', sans-serif;
    }

    .info__box .paragraph__formulario {
        color: var(--text-900);
        font-size: 1.5ch;
        margin: 10px;
        line-height: 1.5;
        font-family: 'Raleway', sans-serif;
    }

    .input__container {
        position: relative;
    }

    .error__message {
        position: absolute;
        top: 0;
        right: 0;
        color: var(--danger-600);
        font-size: 0.85em;
        transform: translateY(-100%);
        margin: -3px;
    }

    .input__container .error {
        margin-bottom: 30px;
    }

    .input__container .error .error__message {
        opacity: 1;
        visibility: visible;
    }

    @media (max-width: 800px) {
        .container__form {
          width: 100%;
          padding: 15px;
        }

        .container__first {
          flex-direction: column;
          gap: 20px;
        }

        #container__second {
          width: 100%;
          padding: 15px;
        }

        .info__container {
          width: 100%;
        }
    }

    @media (max-width: 500px) {
        .input__container {
          display: flex;
          flex-direction: column;
        }

        .error__message {
          position: static;
          margin-top: 5px;
          text-align: left;
          transform: none;
          margin: 5px;
        }
    }
</style>
<body>
    <main class="main__container__content">
        <div class="breadcrumbs flex-row">
            <a href="../home/index.html">Home</a>
            <span class="breadcrumbs__arrow"> / </span>
            <a href="#">Contacto</a>
        </div>

        <h1 class="title__principal">Edita tu contacto</h1>

        <article class="container__principal">
            <form class="container__form" id="formulario" method="POST" action="index.php?c=contact&f=edit&id=<?php echo $contacto["iniciativa_id"]?>">
            <input type="hidden" name="id" id="id" value="<?php echo $contacto["ID"]?>"/>
                <section class="container__first">
                    <fieldset id="container__second">
                        <section class="container__personal">
                            <div class="container__component">
                                <label class="label__name" for="nombres">Nombres: </label>
                                <div class="input__container">
                                    <input type="text" id="nombres" name="nombres" value="<?php echo $contacto["nombres"]?>"/>
                                    <span class="error__message"></span>
                                </div>
                            </div>

                            <div class="container__component">
                                <label class="label__name" for="apellidos">Apellidos: </label>
                                <div class="input__container">
                                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $contacto["apellidos"]?>"/>
                                    <span class="error__message"></span>
                                </div>
                            </div>
                        </section>

                        <section class="container__personal">
                            <div class="container__component">
                                <label class="label__name" for="correoElectronico">Email: </label>
                                <div class="input__container">
                                    <input type="email" id="correoElectronico" name="correoElectronico" value="<?php echo $contacto["email"]?>"/>
                                    <span class="error__message"></span>
                                </div>
                            </div>

                            <div class="container__component">
                                <label class="label__name" for="telefono">Telefóno: </label>
                                <div class="input__container">
                                    <input type="text" id="telefono" name="telefono" value="<?php echo $contacto["telefono"]?>"/>
                                    <span class="error__message"></span>
                                </div>
                            </div>
                        </section>

                        <div class="container__component">
                            <label class="label__name" for="prioridad">Seleccione la Prioridad: </label>
                            <div class="input__container">
                                <select name="prioridad" id="prioridad">
                                    <option value="alta" <?= $contacto['prioridad'] == 'Alta' ? 'selected' : '' ?>>Alta</option>
                                    <option value="media" <?= $contacto['prioridad'] == 'Media' ? 'selected' : '' ?>>Media</option>
                                    <option value="baja" <?= $contacto['prioridad'] == 'Baja' ? 'selected' : '' ?>>Baja</option>
                                </select>
                            </div>
                        </div>

                        <div class="container__component">
                            <label class="label_name" for="asunto">Asunto: </label>
                            <div class="input__container">
                                <span class="error__message"></span>
                                <textarea class="textarea__comment" id="asunto" name="asunto"><?php echo $contacto["asunto"]?></textarea>
                            </div>
                        </div>

                        <div class="container__component">
                            <label class="label__name" for="mensaje">Mensaje: </label>
                            <div class="input__container">
                                <span class="error__message"></span>
                                <textarea class="textarea__comment" id="mensaje" name="mensaje"><?php echo $contacto["mensaje"]?></textarea>
                            </div>
                        </div>

                        <div class="container__component">
                            <button type="submit" class="btn-update">Modificar</button>      
                        </div>

                        <div class="container__component">
                            <a href="index.php?c=contact&f=viewall&id=<?php echo limpiar($contacto['iniciativa_id']); ?>" class="btn-cancel">Cancelar</a>
                        </div>
                    </fieldset>
                </section>
            </form>
        </article>
    </main>
</body>
<!--<script type="module" src="public/js/initiatives/contact.js"></script>-->
<?php require_once FOOTER; ?>