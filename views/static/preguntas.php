<?php require_once HEADER; ?>
<style>
    /* Titulo principal */
    .main__title {
        color: var(--text-base);
    }

    /* Contenedor de la imagen */
    .image__container {
        position: relative;
        border-radius: 32px;
        width: 100%;
        max-height: 540px;
        overflow: hidden;
    }

    /* Imagen */
    .image__phrase {
        width: 100%;
        height: auto;
        object-fit: cover;
        aspect-ratio: 16/9;
        display: block;
    }

    /* Contenedor del mensaje */
    .messagge__container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 26, 20, 0.6);
        color: var(--primary-500);
        text-align: center;
        padding: 16px;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80%;
        border-radius: 8px;
    }

    /* Mensaje */
    .messagge {
        font-size: 3vw;
    }

    /* Autor de la frase */
    .author__phrase {
        font-size: 14px;
    }

    /* article principal */
    #article__main {
        margin: 10px;
    }

    /* Contenedor de los cards */
    .container__cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto repeat(2, 1fr);
        gap: 16px;
        margin: 10px;
    }

    /*Titulo de los contribuidores*/
    .title__contributors {
        grid-column: 1 / -1;
        font-size: 24px;
        color: var(--secondary-base);
        text-align: center;
        margin-bottom: 20px;
    }

    /* Card de la informacion de los contribuidores */
    .card {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        position: relative;
    }

    /* Pseudoclase */
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* Pseudoelemento */
    .answer__question::selection {
        background-color: var(--primary-300);
        color: var(--background-950);
    }

    .questions::selection {
        background-color: var(--primary-300);
        color: var(--background-950);
    }

    /* Imagen de los contribuidores */
    .image {
        width: 250px;
        height: 270px;
        border-radius: 10px;
        display: block;
    }

    /* Nombre de los contribuidores */
    .name__contributors {
        position: absolute;
        bottom: -4%;
        left: 50%;
        width: 55%;
        text-align: center;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 10px;
        box-sizing: border-box;
        border-radius: 5px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Titulo preguntas */
    .title__questions {
        color: var(--secondary-base);
        margin-bottom: 20px;
        font-size: 30px;
    }

    /* Mensaje final */
    .messagge__end {
        color: var(--primary-500);
        text-align: right;
        font-size: 18px;
    }

    /* Oculta el triángulo que sale por defecto */
    details summary::marker {
        display: none;
    }

    /* Colocar el triangulo a la derecha */
    details summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        cursor: pointer;
    }

    /* Triángulo personalizado a la derecha */
    details summary::after {
        content: '▶';
        margin-left: auto;
        transition: transform 0.3s ease;
        background-color: #051e1b;
        border-radius: 5px;
        right: 0;
        padding: 5px;
        font-size: 0.8em;
    }

    /* Rotación del triángulo cuando está abierto */
    details[open] summary::after {
        transform: rotate(90deg);
    }

    /* Preguntas */
    .questions {
        font-size: 28px;
    }

    /* Estilo de las repuestas */
    .article__section {
        padding: 32px;
    }

    /* Repuestas preguntas */
    .answer__question {
        color: #999999;
        margin-top: 20px;
        padding: 0 10px;
        line-height: 1.6;
        text-align: justify;
    }

    /* Titulo de la iniciativa */
    .title__iniciative {
        color: var(--primary-base);
        font-size: 40px;
        text-align: justify;
    }

    /* Parrafo */
    .paragraph {
        font-size: 16px;
        text-align: justify;
    }

    /* Link de la iniciativa */
    .link__iniciative {
        color: var(--primary-base);
        text-align: right;
        font-size: 18px;
    }

    /* Media querry para que sea flexible en dispositivos mobiles */
    @media (max-width: 800px) {
        .container__cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .container__cards {
            grid-template-columns: 1fr;
        }

        .card .name__contributors {
            font-size: 14px;
        }

        .messagge {
            font-size: 5vw;
        }
    }

    /*Media querry para el tamaño de la letra del mensaje que esta adentro de la imagen*/
    @media (max-width: 600px) {
        .messagge {
            font-size: 4vw;
        }
    }
</style>
<main class="main__container__content">
    <div class="breadcrumbs flex-row">
        <a href="../home/index.html">Home</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">Preguntas</a>
    </div>

    <!-- Elaborado por Abraham Farfan -->
    <h1 class="main__title">TreeVitae Juntos Cultivamos un Futuro Verde</h1>

    <div class="image__container">
        <picture>
            <img
                class="image__phrase"
                src="public/assets/images/image-phrase.png"
                alt="Frase de la iniciativa TreeVitae" />
        </picture>
        <div class="messagge__container">
            <cite class="messagge">
                "Creando conexiones sostenibles entre las personas y la naturaleza para un mañana más
                verde"<small class="author__phrase"><u style="margin: 10px">-TreeVitae</u></small>
            </cite>
        </div>
    </div>

    <article id="article__main">
        <section class="container__cards">
            <h2 class="title__contributors">Contribuidores</h2>
            <div class="card">
                <figure>
                    <img
                        class="image"
                        src="public/assets/images/colaborador1.png"
                        alt="Colaborador Pablo Pincay" />
                    <figcaption class="name__contributors">
                        <strong>Pablo Pincay</strong><br /><code style="font-family: monospace">Co-Founder and CEO</code>
                    </figcaption>
                </figure>
            </div>

            <div class="card">
                <figure>
                    <img
                        class="image"
                        src="public/assets/images/colaborador2.png"
                        alt="Colaborador Jose Agurto" />
                    <figcaption class="name__contributors">
                        <strong>Jose Agurto</strong><br /><code style="font-family: monospace">Co-Founder and CTO</code>
                    </figcaption>
                </figure>
            </div>

            <div class="card">
                <figure>
                    <img
                        class="image"
                        src="public/assets/images/colaborador3.png"
                        alt="Colaborador Abraham Farfan" />
                    <figcaption class="name__contributors">
                        <strong>Abraham Farfán</strong><br /><code style="font-family: monospace">Lead General Engineer</code>
                    </figcaption>
                </figure>
            </div>

            <div class="card">
                <figure>
                    <img
                        class="image"
                        src="public/assets/images/colaborador4.jpeg"
                        alt="Colaborador Gabriel Gabo" />
                    <figcaption class="name__contributors">
                        <strong>Gabriel Vera</strong><br /><code style="font-family: monospace">Lead TI Engineer</code>
                    </figcaption>
                </figure>
            </div>

            <div class="card">
                <figure>
                    <img
                        class="image"
                        src="public/assets/images/colaborador5.png"
                        alt="Colaborador Angel Vivanco" />
                    <figcaption class="name__contributors">
                        <strong>Angel Vivanco</strong><br /><code style="font-family: monospace">Marketing Design</code>
                    </figcaption>
                </figure>
            </div>

            <div class="card">
                <figure>
                    <img
                        class="image"
                        src="public/assets/images/colaborador6.png"
                        alt="Colaborador Camioncitos S.A." />
                    <figcaption class="name__contributors">
                        <strong>Camioncitos</strong><br /><code style="font-family: monospace">National Company</code>
                    </figcaption>
                </figure>
            </div>
        </section>
        <br /><br />
        <h2 class="title__questions">Preguntas Frecuentes sobre las Iniciativas</h2>

        <hr class="separetor__horizontal" />

        <section class="article__section">
            <details id="pregunta1">
                <summary>
                    <span class="questions">¿Qué tipo de iniciativas puedo encontrar en TreeVitae?</span>
                    <span class="custom-marker"></span>
                </summary>
                <p class="answer__question">
                    Ofrecemos una variedad de proyectos y soluciones diseñadas para promover la
                    sostenibilidad y la conexión con la naturaleza, desde pequeños cambios en el hogar
                    hasta grandes iniciativas empresariales.
                </p>
            </details>
        </section>

        <hr class="separetor__horizontal" />

        <section class="article__section">
            <details id="pregunta2">
                <summary>
                    <span class="questions">¿Cómo puedo unirme a una iniciativa o proyecto?</span>
                    <span class="custom-marker"></span>
                </summary>
                <p class="answer__question">
                    Unirte es muy sencillo. Explora las iniciativas activas en nuestra página y
                    selecciona aquella que resuene contigo. Solo necesitas registrarte y empezarás a
                    recibir información sobre cómo participar.
                </p>
            </details>
        </section>

        <hr class="separetor__horizontal" />

        <section class="article__section">
            <details id="pregunta3">
                <summary>
                    <span class="questions">¿Existen beneficios adicionales al participar en estos proyectos?</span>
                    <span class="custom-marker"></span>
                </summary>
                <p class="answer__question">
                    Sí, además de contribuir al bienestar del planeta, muchos de nuestros proyectos
                    ofrecen beneficios exclusivos, como descuentos en productos sostenibles y acceso a
                    eventos de la comunidad TreeVitae.
                </p>
            </details>
        </section>

        <hr class="separetor__horizontal" />

        <section class="article__section">
            <details id="pregunta4">
                <summary>
                    <span class="questions">¿Puedo proponer una iniciativa o colaborar con un proyecto existente?</span>
                    <span class="custom-marker"></span>
                </summary>
                <p class="answer__question">
                    ¡Por supuesto! Estamos siempre abiertos a nuevas ideas. Si tienes una propuesta o
                    deseas colaborar con un proyecto actual, contáctanos y exploraremos juntos cómo
                    llevarlo a cabo.
                </p>
            </details>
        </section>

        <hr class="separetor__horizontal" />

        <section class="article__section">
            <details id="pregunta5">
                <summary>
                    <span class="questions">¿Qué ocurre si decido salir de una iniciativa?</span>
                    <span class="custom-marker"></span>
                </summary>
                <p class="answer__question">
                    No hay ningún compromiso a largo plazo. Puedes decidir retirarte de una iniciativa
                    en cualquier momento. Te agradeceremos por tu participación y te mantendremos
                    informado de futuras oportunidades.
                </p>
            </details>
        </section>
    </article>
</main>

<hr class="separetor__horizontal" />

<footer class="footer">
    <div class="footer__container">
        <section class="footer__section">
            <h2 class="title__iniciative">
                Únete a nuestra comunidad, la que cultiva el cambio positivo.
            </h2>
        </section>
        <section class="footer__section">
            <h3>Acerca de nuestra iniciativa</h3>
            <p class="paragraph">
                Creemos que un impacto duradero se logra cuando las personas se unen en torno a
                valores compartidos. Por eso, invitamos no solo a los profesionales que buscan
                iniciativas sostenibles, sino también a quienes sienten pasión por la naturaleza y el
                bienestar de nuestro planeta.
            </p>
            <a class="link__iniciative" href="#"><em>Explora nuestras iniciativas -></em></a>
        </section>
    </div>
</footer>

<hr class="separetor__horizontal" />
<?php require_once FOOTER; ?>