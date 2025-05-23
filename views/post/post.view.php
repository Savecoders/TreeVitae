<?php require_once HEADER; ?>
<style>
    .content-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        max-width: 1200px;
        margin: 2rem auto;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-base);
        font-size: 0.9rem;
    }

    .profile-logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .tags {
        display: flex;
        gap: 0.5rem;
        margin: 1rem 0;
    }

    .tags span {
        background-color: var(--background-100);
        padding: 0.3rem 0.7rem;
        border-radius: 8px;
        color: var(--primary-base);
        font-size: 0.85rem;
    }

    .post-content {
        line-height: 1.6;
        color: var(--text-base);
        margin-bottom: 1.5rem;
    }

    .post-images {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .hero {
        width: 48%;
        height: auto;
        max-width: 300px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        position: relative;
    }

    /* Estilos para el modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        max-width: 80%;
        max-height: 80%;
    }

    .modal img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .post-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .action-btn {
        background-color: var(--background-100);
        color: var(--text-base);
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .action-btn img {
        vertical-align: middle;
        transition: filter 0.3s ease;
    }

    .comments-section textarea {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid var(--background-100);
        border-radius: 12px;
        color: var(--text-base);
        background-color: transparent;
        font-family: 'Inter', sans-serif;
    }

    .post-content p:first-of-type::first-letter {
        font-size: 2rem;
        font-weight: bold;
        color: var(--primary-base);
        margin-right: 4px;
    }

    /* Sección de Información de la Comunidad */
    .community-info {
        background-color: var(--primary-100);
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        width: 290px;
    }

    .community-info .title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        font-size: 1rem;
        color: var(--primary-400);
    }

    .community-info .title span {
        font-size: 2rem;
    }

    .community-info p {
        color: var(--text-base);
        margin-top: 1rem;
    }

    .community-info .stats {
        display: flex;
        align-items: center;
        font-weight: bold;
        color: var(--text-base);
        margin-top: 1rem;
        font-size: 0.85rem;
    }

    .community-info .stats .stat-item img {
        width: 1.2rem;
        vertical-align: middle;
        margin-left: 0.5rem;
    }

    .community-info h2 {
        font-size: 1.5rem;
        font-weight: 600;
        --text-800: var(--text-800);
        margin-bottom: 0.5rem;
    }

    #join-btn {
        background-color: var(--primary-base);
        border-radius: 20px;
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border: none;
        cursor: pointer;
    }

    #join-btn:hover {
        background-color: var(--primary-400);
    }

    img[alt*='Iniciativa'] {
        border: 2px solid var(--primary-base);
        border-radius: 8px;
    }

    .ocultar-titulo {
        position: absolute;
        width: 0;
        height: 0;
        margin: 0;
        padding: 0;
        border: none;
        clip: rect(0, 0, 0, 0);
    }

    /* Estilos para la sección de Posts Similares */
    .similar-posts {
        background-color: var(--background-900);
        padding: 1rem;
        border-radius: 12px;
        width: 290px;
    }

    .similar-posts-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--text-50);
        margin-bottom: 1rem;
        text-align: center;
    }

    .similar-posts-divider {
        border: 0;
        border-top: 1px solid var(--primary-200);
        margin: 0.5rem 0;
    }

    .post-item {
        margin-bottom: 1rem;
        background-color: var(--background-900);
        padding: 0.5rem;
        border-radius: 8px;
    }

    .post-item-title {
        font-size: 0.95rem;
        color: var(--primary-400);
        cursor: pointer;
        margin: 0;
    }

    .post-item-date {
        color: var(--text-500);
        font-size: 0.75rem;
    }

    /* Media query */
    @media (max-width: 768px) {
        .content-container {
            display: block;
            padding: 1rem;
        }

        .left-section,
        .right-section {
            width: 100%;
            margin-bottom: 2rem;
        }

        .post-images {
            flex-direction: column;
        }

        .hero {
            max-width: 100%;
        }

        .post-actions {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-btn {
            width: 40%;
            text-align: left;
        }

        .community-info {
            width: 100%;
            margin-bottom: 1rem;
        }

        .similar-posts {
            width: 100%;
        }
    }
</style>
<main class="main__container__content">
    <div class="breadcrumbs flex-row">
        <a href="../home/index.html">Home</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">NombreIniciativa</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">TitlePost</a>
    </div>

    <!-- Angel Enrique Vivanco Garcia -->

    <div class="content-container">
        <!-- Sección Izquierda -->
        <section class="left-section">
            <h1>
                [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the fly!
            </h1>

            <!-- Información del perfil -->
            <section class="profile-info">
                <h2 class="ocultar-titulo">Profile Information</h2>
                <img src="public/assets/icons/logo.svg" alt="logo" class="profile-logo" />
                <span>UserCreate | 12 octubre 2024 | 27d</span>
            </section>

            <!-- Etiquetas -->
            <section class="tags">
                <h2 class="ocultar-titulo">Tags</h2>
                <strong>Tags:</strong>
                <span class="tags__info">Playa</span>
                <span class="tags__info">Limpieza</span>
                <span class="tags__info">Recoleccion</span>
            </section>

            <!-- Contenido del post -->
            <section class="post-content">
                <h2 class="ocultar-titulo">Post Content</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus pretium
                    libero eu cursus. Vestibulum eu mollis risus. Ut porta ligula id auctor ultrices.
                    Sed id ex sed erat finibus molestie. Suspendisse quis justo porta, eleifend purus
                    nec, laoreet lacus. Phasellus vel urna turpis. In hac habitasse platea dictumst.
                    Praesent ac orci ultricies, porttitor nunc quis, luctus erat. Fusce et sollicitudin
                    dui. Etiam eu dictum est. Morbi turpis tellus, vestibulum in cursus ultrices,
                    bibendum in dolor. Proin dignissim tellus non eros consectetur, quis gravida mi
                    malesuada. Sed neque neque, sodales sit amet mi eu, bibendum sagittis elit. Etiam
                    malesuada quam vitae magna dignissim, sit amet ornare quam mattis.
                </p>
                <p>
                    Cras tempor in justo sit amet ornare. Morbi non turpis ac lectus cursus semper quis
                    nec massa. Nullam tempor consectetur leo, eget commodo leo placerat nec. Sed
                    consequat luctus diam, a venenatis lorem. Pellentesque finibus leo sit amet nunc
                    luctus porttitor. Fusce lacus neque, vulputate nec ornare et, luctus vitae mi. Duis
                    aliquam dui libero, at hendrerit metus pretium ac.
                </p>
            </section>

            <!-- Imágenes del post -->
            <section class="post-images">
                <h2 class="ocultar-titulo">Images</h2>
                <img
                    src="public/assets/images/iniciativa-default.png"
                    alt="Iniciativa 1"
                    class="hero"
                    id="image1"
                    data-src="public/assets/images/iniciativa-default.png" />
                <img
                    src="public/assets/images/iniciativa-default.png"
                    alt="Iniciativa 2"
                    class="hero"
                    id="image2"
                    data-src="public/assets/images/iniciativa-default.png" />
            </section>

            <!-- Modal -->
            <div id="modal" class="modal">
                <span
                    id="close-modal"
                    style="position: fixed; top: 10px; right: 20px; cursor: pointer">&times;</span>
                <div class="modal-content">
                    <img id="modal-image" src="" alt="Imagen del post" />
                </div>
            </div>

            <!-- Acciones del post -->
            <section class="post-actions">
                <h2 class="ocultar-titulo">Post Actions</h2>
                <button class="action-btn like-btn">
                    <img
                        class="increment-icon"
                        src="public/assets/icons/caret-down-top.svg"
                        alt="caret-down-top" />
                    <span class="like-count">232</span>
                    <img
                        class="no-action-icon"
                        src="public/assets/icons/caret-down.svg"
                        alt="caret-down" />
                </button>
                <button class="action-btn comment-btn">
                    <img src="public/assets/icons/command.svg" alt="command" />
                    232
                </button>
                <button class="action-btn">
                    <img
                        src="public/assets/icons/share-2.svg"
                        alt="Compartir"
                        style="margin-right: 8px"
                        width="20"
                        height="24" />
                    Compartir
                </button>
            </section>

            <!-- Sección de comentarios -->
            <section class="comments-section">
                <h2 class="ocultar-titulo">Comments</h2>
                <textarea placeholder="Escribir un comentario"></textarea>
            </section>
        </section>

        <!-- Sección Derecha -->
        <aside class="right-section">
            <!-- Cuadrado con información de la comunidad -->
            <section class="community-info">
                <h2 class="ocultar-titulo">Community Information</h2>
                <div class="title">
                    <span>TreeVitae</span>
                    <button id="join-btn" class="join-btn">Unirse</button>
                </div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus pretium
                    libero eu cursus. Vestibulum eu mollis risus.
                </p>
                <div class="stats">
                    <div class="stat-item">
                        <img src="public/assets/icons/users.svg" alt="user-icon" />
                        <span>1233 Miembros</span>
                    </div>
                    <div class="stat-item">
                        <img src="public/assets/icons/heart-pulse.svg" alt="heart-icon" />
                        <span>44 Followers</span>
                    </div>
                </div>
            </section>

            <!-- Posts Similares -->
            <section class="similar-posts">
                <h3 class="similar-posts-title">Post Similares</h3>
                <hr class="similar-posts-divider" />

                <div class="post-item">
                    <h4 class="post-item-title">
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h4>
                    <span class="post-item-date">12 octubre 2024</span>
                </div>
                <hr class="similar-posts-divider" />
                <div class="post-item">
                    <h4 class="post-item-title">
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h4>
                    <span class="post-item-date">12 octubre 2024</span>
                </div>
                <hr class="similar-posts-divider" />
                <div class="post-item">
                    <h4 class="post-item-title">
                        [BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                        fly!
                    </h4>
                    <span class="post-item-date">12 octubre 2024</span>
                </div>
            </section>
        </aside>
    </div>
</main>
<script type="module" src="public/js/post/view.js"></script>
<?php require_once FOOTER; ?>