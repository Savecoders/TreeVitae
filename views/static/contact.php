<?php require_once HEADER; ?>
<style>
    .title__principal {
        font-size: 4ch;
        font-weight: 600;
        color: var(--text-900);
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

    .submit__button {
        width: 100%;
        padding: 10px;
        background-color: var(--primary-base);
        color: var(--background-base);
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 500;
        transition: all 0.1s ease-in-out;
    }

    .submit__button:hover {
        background-color: var(--primary-500);
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
<main class="main__container__content">
    <div class="breadcrumbs flex-row">
        <a href="../home/index.html">Home</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">Contacto</a>
    </div>

    <!-- Elaborado por Abraham Farfan -->
    <h1 class="title__principal">Contactanos</h1>
    <article class="container__principal">
        <form class="container__form" id="formulario" onsubmit="return validarFormulario()">
            <section class="container__first">
                <fieldset id="container__second">
                    <legend id="label__form">Datos Personales</legend>
                    <section class="container__personal">
                        <div class="container__component">
                            <label class="label__name" for="nombres">Nombres: </label>
                            <div class="input__container">
                                <input type="text" id="nombres" name="nombres" />
                                <span class="error__message"></span>
                            </div>
                        </div>

                        <div class="container__component">
                            <label class="label__name" for="apellidos">Apellidos: </label>
                            <div class="input__container">
                                <input type="text" id="apellidos" name="apellidos" />
                                <span class="error__message"></span>
                            </div>
                        </div>
                    </section>

                    <section class="container__personal">
                        <div class="container__component">
                            <label class="label__name" for="correoElectronico">Email: </label>
                            <div class="input__container">
                                <input type="email" id="correoElectronico" name="correoElectronico" />
                                <span class="error__message"></span>
                            </div>
                        </div>

                        <div class="container__component">
                            <label class="label__name" for="telefono">Telefóno: </label>
                            <div class="input__container">
                                <input type="text" id="telefono" name="telefono" />
                                <span class="error__message"></span>
                            </div>
                        </div>
                    </section>

                    <div class="container__component">
                        <label class="label__name" for="mensaje">Mensaje: </label>
                        <div class="input__container">
                            <span class="error__message"></span>
                            <textarea class="textarea__comment" id="mensaje" name="mensaje"></textarea>
                        </div>
                    </div>

                    <div class="container__component">
                        <button type="submit" class="submit__button">Enviar mensaje</button>
                    </div>
                </fieldset>

                <section class="info__container">
                    <div class="info__box">
                        <h3 class="title__info">Dirección</h3>
                        <p class="paragraph__formulario">Av.9 de Octubre.</p>
                        <br />
                        <h3 class="title__info">Contacto</h3>
                        <p class="paragraph__formulario">Telefóno: 0987654123</p>
                        <p class="paragraph__formulario">Correo Electrónico: treeVitae@gmail.com</p>
                        <br />
                        <h3 class="title__info">Horario de atención</h3>
                        <p class="paragraph__formulario">
                            Abierto: 8:00 a.m <br />
                            Cerrado: 17:00 p.m
                        </p>
                    </div>
                </section>
            </section>
        </form>
    </article>
</main>

<script src="public/js/initiatives/contact.js"></script>
<?php require_once FOOTER; ?>