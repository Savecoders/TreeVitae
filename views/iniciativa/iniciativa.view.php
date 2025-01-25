<?php
require_once HEADER;
require_once 'utils/dateFormatter.php';
?>

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
        margin: 0;
    }

    .card-compact-post {
        width: 480px;
        height: 612px;
    }

    .profile-container {
        width: 100%;
        max-width: 240px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .media__row {
        display: flex;
        width: 100%;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 24px;
        padding-bottom: 24px;
        background-color: var(--background-50);
        justify-content: center;
        border-radius: 16px;
    }

    p {
        font-size: 24px;
        color: var(--text-800);
    }

    .profile-container small {
        font-family: 'Raleway', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: var(--text-900);
    }

    .profile-container>img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-radius: 16px;
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

    .following {
        background-color: var(--accent-600);
        color: white;
    }

    .member {
        background-color: var(--accent-600);
        color: white;
    }

    @media (max-width: 1100px) {

        .heading-initiative {
            flex-direction: column;
            gap: 32px;
        }

    }

    @media (max-width: 768px) {
        .main-sidebar {
            gap: 16px;
            flex-direction: column;
        }
    }

    .breadcrumbs {
        width: fit-content;
    }

    .btn-danger {
        background-color: var(--danger-base);
        color: white;
        border-radius: 8px;
    }

    .btn-danger:hover {
        background-color: var(--danger-400);
    }
</style>
<main class="main__container__content">

    <?php if (isset($iniciativa)) { ?>

        <div class="breadcrumbs flex-row">
            <a href="index.php">Home</a>
            <span class="breadcrumbs__arrow"> / </span>
            <a href="index.php?c=iniciativa&f=viewall">Iniciativas</a>
            <span class="breadcrumbs__arrow"> / </span>
            <a href="index.php?c=iniciativa&f=view&id=<?php echo $iniciativa[0]->getId(); ?>"><?php echo $iniciativa[0]->getNombre(); ?></a>
        </div>

        <picture class="card__picture">
            <img class="hero" src="data:image;base64,<?php echo base64_encode($iniciativa[0]->getCover()); ?>" alt="<?php echo $iniciativa[0]->getNombre(); ?>">
        </picture>

        <?php if (isset($isUserAdmin) && $isUserAdmin) { ?>
            <a href="index.php?c=iniciativa&f=update_view&id=<?php echo $iniciativa[0]->getId(); ?>" class="btn primary__with-icon btn-animation">
                Editar Iniciativa
            </a>
            <a href="index.php?c=iniciativa&f=delete&id=<?php echo $iniciativa[0]->getId(); ?>" class="btn btn-danger btn-animation">
                Cerrar Iniciativa
            </a>
        <?php } ?>

        <div class="main-sidebar">
            <aside class="profile-container">
                <img src="data:image;base64,<?php echo base64_encode($iniciativa[0]->getLogo()); ?>" alt="Logo Profile" />
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
                <button
                    id="joinButton"
                    data-iniciativa-id="<?php echo $iniciativa[0]->getId(); ?>"
                    class="btn primary__with-icon btn btn-animation <?php echo $isUserMenber ? 'member' : ''; ?>">
                    <?php echo $isUserMenber ? 'Abandonar Iniciativa' : 'Únete a la Iniciativa'; ?>
                </button>


                <hr class="separetor__horizontal" />
                <p>Actividades</p>
                <a href="#" class="btn primary__with-icon btn btn-animation">
                    Revisar Actividades
                </a>

                <?php if ((isset($isUserAdmin) && $isUserAdmin) || $isUserFollowers) { ?>
                    <hr class="separetor__horizontal" />
                    <a href="index.php?c=contact&f=viewall&id=<?php echo $iniciativa[0]->getId(); ?>" class="btn outerline btn-animation">
                        Contactarte con la iniciativa?
                    </a>
                <?php } ?>
            </aside>

            <article class="about-initiative">
                <header class="heading-initiative">
                    <h2><?php echo $iniciativa[0]->getNombre(); ?></h2>
                    <button
                        id="followButton"
                        data-iniciativa-id="<?php echo $iniciativa[0]->getId(); ?>"
                        style="height: fit-content;"
                        class="btn outerline btn-animation <?php echo $isUserFollowers ? 'following' : ''; ?>">
                        <i class="fa-<?php echo $isUserFollowers ? 'solid' : 'regular'; ?> fa-heart"></i>
                        <?php echo $isUserFollowers ? 'Dejar de seguir' : 'Seguir'; ?>
                    </button>
                </header>
                <p>Fecha de Creacion: <?php echo formatDate($iniciativa[0]->getFechaCreacion()); ?></p>

                <!-- Etiquetas -->
                <section class="tags" aria-label="Tags">
                    <p>Tags:</p>
                    <?php foreach ($iniciativa[0]->getTags() as $tag) { ?>
                        <div class="tag" id="tag-<?php echo $tag->getNombre(); ?>" role="listitem">
                            <?php echo $tag->getNombre(); ?>
                        </div>
                    <?php } ?>
                </section>
                <hr class="separetor__horizontal" />
                <p class="paragraph">
                    <?php echo $iniciativa[0]->getDescripcion(); ?>
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
                            alt="Iniciativa defecto" />
                    </div>


                </section>

                <div style="justify-content: center; display: flex">
                    <a href="#" id="btnMorePost" class="btn primary__with-icon btn-animation">
                        <img src="public/assets/icons/external-link.svg" alt="External link" />Revisa todos los Post :)
                    </a>
                </div>
            </article>
        </div>

    <?php } ?>
</main>
<!-- <script type="module" src="public/js/initiatives/view.js"></script> -->
<script type="module" src="public/js/initiatives/rol.js"></script>

<?php require_once FOOTER; ?>