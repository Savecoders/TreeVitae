<? require_once HEADER; ?>
<style>
    .card__picture {
        width: 100%;
        height: 640px;
        object-fit: cover;
        display: flex;
        border-radius: 32px;
        overflow: hidden;
    }

    .hero {
        width: 100%;
        height: auto;
        object-fit: cover;
        box-sizing: border-box;
        background-repeat: no-repeat;
        background-position: center;
        image-rendering: optimizeQuality;
        mix-blend-mode: normal;
    }

    .card-compact-post {
        width: 480px;
        height: 612px;
    }

    .profile-container {
        width: 320px;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .media__row {
        display: flex;
        flex-direction: row;
        gap: 12px;
        padding-top: 24px;
        padding-bottom: 24px;
        background-color: var(--background-50);
        justify-content: center;
        border-radius: 16px;
    }

    .profile-container p {
        font-size: 32px;
        color: var(--text-900);
    }

    .profile-container small {
        font-family: 'Raleway', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: var(--text-900);
    }

    .about-initiative {
        display: flex;
        gap: 32px;
        width: 100%;
        flex-direction: column;
    }

    .main-sidebar {
        display: flex;
        flex-direction: row;
        gap: 64px;
        width: 100%;
    }

    .paragraph {
        font-family: 'Raleway', sans-serif;
        font-size: 24px;
        font-weight: 400;
    }

    .tag {
        text-align: center;
    }

    .tags p {
        font-weight: 400;
        font-size: 30px;
        color: var(--text-600);
    }

    .heading-initiative {
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .heading-initiative h2 {
        font-family: 'Raleway', sans-serif;
        font-size: 64px;
        font-weight: 500;
        color: var(--accent-600);
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(480px, 1fr));
    }

    .card-compact-post {
        display: flex;
        gap: 24px;
        flex-direction: column;
        padding: 32px;
    }

    .card-compact-post header h3 {
        font-family: 'Raleway', sans-serif;
        font-size: 32px;
        font-weight: 500;
        color: var(--text-600);
    }

    .card-compact-post header {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .card-compact-post p {
        font-family: 'Raleway', sans-serif;
        font-size: 32px;
        font-weight: 200;
        color: var(--text-500);
    }

    .card-compact-post h2 {
        font-family: 'Raleway', sans-serif;
        font-size: 32px;
        font-weight: 500;
        color: var(--text-700);
    }

    .figure {
        display: flex;
        gap: 24px;
    }

    .figure .media__item small {
        font-size: 20px;
        font-weight: lighter;
        color: var(--text-900);
    }

    .media__item {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    @media (max-width: 700px) {
        .main-sidebar {
            flex-direction: column-reverse;
        }

        .profile-container {
            width: 100%;
        }
    }
</style>
<main class="main__container__content">
    <div class="breadcrumbs flex-row">
        <a href="../home/index.html">Home</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">NombreIniciativa</a>
    </div>

    <!-- Mi comienzo AGURTO -->
    <picture class="card__picture">
        <img class="hero" src="public/assets/images/iniciativa-default.png" alt="Iniciativa 1" />
    </picture>

    <div class="main-sidebar">
        <aside class="profile-container">
            <img src="public/assets/images/Icon_Profile_Initiative.png" alt="Logo Profile" />
            <hr class="separetor__horizontal" />
            <p>Interacciones</p>
            <div class="media__row">
                <figure class="media__item">
                    <img src="public/assets/icons/users.svg" alt="user-icon" />
                    <small>10</small>
                </figure>
                <figure class="media__item">
                    <img src="public/assets/icons/link-2.svg" alt="link-icon" />
                    <small>10</small>
                </figure>
                <figure class="media__item">
                    <img src="public/assets/icons/heart-pulse.svg" alt="heart-icon" />
                    <small>10</small>
                </figure>
                <figure class="media__item">
                    <img src="public/assets/icons/image.svg" alt="image-icon" />
                    <small>10</small>
                </figure>
            </div>
            <hr class="separetor__horizontal" />
            <p>Se Parte</p>
            <a href="#" class="btn primary__with-icon btn btn-animation">
                <img src="public/assets/icons/pointer--outer.svg" alt="Pointer Outer" />Únete a la
                Iniciativa
            </a>
        </aside>

        <article class="about-initiative">
            <header class="heading-initiative">
                <h2>TreeVitae</h2>
                <button class="btn outerline btn-animation">
                    <img src="public/assets/icons/heart-pulse.svg" alt="Heart Pulse" />
                    Seguir
                </button>
            </header>
            <p>CreateDate: | 12 octubre 2024</p>

            <!-- Etiquetas -->
            <section class="tags" aria-label="Tags">
                <p>Tags:</p>
                <div class="tag">Playa</div>
                <div class="tag">Limpieza</div>
                <div class="tag">Recolección</div>
            </section>
            <hr class="separetor__horizontal" />
            <p class="paragraph">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus pretium
                libero eu cursus. Vestibulum eu mollis risus. Ut porta ligula id auctor ultrices. Sed
                id ex sed erat finibus molestie. Suspendisse quis justo porta, eleifend purus nec,
                laoreet lacus. Phasellus vel urna turpis. In hac habitasse platea dictumst. Praesent
                ac orci ultricies, porttitor nunc quis, luctus erat. Fusce et sollicitudin dui. Etiam
                eu dictum est. Morbi turpis tellus, vestibulum in cursus ultrices, bibendum in dolor.
                Proin dignissim tellus non eros consectetur, quis gravida mi malesuada. Sed neque
                neque, sodales sit amet mi eu, bibendum sagittis elit. Etiam malesuada quam vitae
                magna dignissim, sit amet ornare quam mattis. Cras tempor in justo sit amet ornare.
                Morbi non turpis ac lectus cursus semper quis nec massa. Nullam tempor consectetur
                leo, eget commodo leo placerat nec. Sed consequat luctus diam, a venenatis lorem.
                Pellentesque finibus leo sit amet nunc luctus porttitor. Fusce lacus neque, vulputate
                nec ornare et,.
            </p>

            <section class="cards">
                <div class="card-compact-post">
                    <header>
                        <h3>TreeVitae</h3>
                        <p>| 27d</p>
                    </header>
                    <h2>
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h2>
                    <footer class="figure">
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 likes</small>
                        </figure>
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 comentarios</small>
                        </figure>
                    </footer>
                    <img
                        style="border-radius: 8px; filter: drop-shadow(0 0 3px #000000)"
                        src="public/assets/images/iniciativa-default.png"
                        alt="Iniciativa" />
                </div>

                <div class="card-compact-post">
                    <header>
                        <h3>TreeVitae</h3>
                        <p>| 27d</p>
                    </header>
                    <h2>
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h2>
                    <footer class="figure">
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 likes</small>
                        </figure>
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 comentarios</small>
                        </figure>
                    </footer>
                    <img
                        style="border-radius: 8px; filter: drop-shadow(0 0 3px #000000)"
                        src="public/assets/images/iniciativa-default.png"
                        alt="Iniciativa" />
                </div>

                <div class="card-compact-post">
                    <header>
                        <h3>TreeVitae</h3>
                        <p>| 27d</p>
                    </header>
                    <h2>
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h2>
                    <footer class="figure">
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 likes</small>
                        </figure>
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 comentarios</small>
                        </figure>
                    </footer>
                    <img
                        style="border-radius: 8px; filter: drop-shadow(0 0 3px #000000)"
                        src="public/assets/images/iniciativa-default.png"
                        alt="Iniciativa defecto" />
                </div>

                <div class="card-compact-post">
                    <header>
                        <h3>TreeVitae</h3>
                        <p>| 27d</p>
                    </header>
                    <h2>
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h2>
                    <footer class="figure">
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 likes</small>
                        </figure>
                        <figure class="media__item">
                            <img src="public/assets/icons/users.svg" alt="user-icon" />
                            <small>44 comentarios</small>
                        </figure>
                    </footer>
                    <img
                        style="border-radius: 8px; filter: drop-shadow(0 0 3px #000000)"
                        src="public/assets/images/iniciativa-default.png"
                        alt="" />
                </div>
            </section>

            <div style="justify-content: center; display: flex">
                <a href="#" id="btnMorePost" class="btn primary__with-icon btn-animation">
                    <img src="public/assets/icons/external-link.svg" alt="External link" />Ver Más Post
                </a>
            </div>
        </article>
    </div>
</main>
<script type="module" src="public/js/initiatives/view.js"></script>
<? require_once FOOTER; ?>