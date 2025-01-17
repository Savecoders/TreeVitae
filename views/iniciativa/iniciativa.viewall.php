<?php require_once HEADER; ?>
<style>
    .container__cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 480px));
        gap: 32px;
    }

    .card {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        grid-template-areas: 'content image';
        gap: 16px;
        padding: 24px;
        border-radius: 32px;
        place-items: center;
        background-color: var(--background-100);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .media__row {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        grid-area: media;
    }

    .card__content {
        display: flex;
        flex-direction: column;
        gap: 8px;
        grid-area: content;
    }

    .card__tags__content {
        display: flex;
        height: 100%;
        width: 100%;
        gap: 8px;
        margin-top: auto;
        justify-content: left;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .tag__content {
        height: fit-content;
        padding: 6px;
        border-radius: 8px;
        background-color: var(--background-200);
        cursor: pointer;
        font-size: 1.2ch;
        font-weight: 500;
        color: var(--text-900);
        transition: all 0.1s ease-in-out;
    }

    .tag__content:hover {
        background-color: var(--background-400);
    }

    .card__title {
        font-family: 'Raleway', sans-serif;
        font-size: 28px;
        font-weight: 600;
        color: var(--accent-base);
        margin: 0;
        text-decoration: none;
    }

    .card__title:hover {
        text-decoration: underline;
        color: var(--accent-500);
    }

    .card__description {
        font-size: 16px;
        color: var(--text-900);
    }

    .card__picture {
        grid-area: image;
        display: flex;
        height: 100%;
        border-radius: 8px;
        overflow: hidden;
    }

    .card__picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        aspect-ratio: 4/3;
        filter: brightness(0.8);
    }

    .card--clicked {
        transform: scale(2);
        z-index: 100;
    }

    .media__item small {
        font-size: 20px;
        font-family: 'Raleway', sans-serif;
        color: var(--text-900);
        font-weight: 500;
    }

    .tag--clicked {
        background-color: var(--background-100);
    }

    /* Media Queries */
    @media (max-width: 700px) {
        .card {
            grid-template-columns: 1fr 1fr;
            grid-template-areas:
                'content content content'
                'image image media'
                'image image media';
            gap: 24px;
            padding: 2rem;
        }

        .media__row {
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
        }
    }
</style>
<main class="main__container__content">
    <div class="breadcrumbs flex-row">
        <a href="../home/index.html">Home</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">Iniciativas</a>
    </div>

    <h1>Iniciativas</h1>

    <form class="form__search" method="dialog">
        <div class="search__container">
            <input id="searchInput" type="text" placeholder="Buscar" required />
            <button id="btnSearch" class="btn outerline">
                <img src="public/assets/icons/search.svg" alt="search icon" />
                Search
            </button>
        </div>

        <!-- Etiquetas -->
        <section class="tags" role="group" aria-label="tags">
            <div class="tag" id="tag-limpieza" role="listitem">Limpieza</div>
            <div class="tag" id="tag-reciclaje" role="listitem">Reciclaje</div>
            <div class="tag" id="tag-recoleccion" role="listitem">Recolección</div>
            <div class="tag" id="tag-mantenimiento" role="listitem">Mantenimiento</div>
            <div class="tag" id="tag-organizacion" role="listitem">Organización</div>
        </section>
    </form>

    <hr class="separetor__horizontal" />

    <!-- Container cards Iniciativas -->
    <section class="container__cards" aria-label="Iniciativas">
        <?php foreach ($iniciativas as $iniciativa) { ?>
            <aside class="card">
                <article class="card__content"><a class="card__title" href="./view.html"><?php $iniciativa['nombre'] ?></a>
                    <!-- <div class="card__tags__content">
                        <div class="tag__content">recolección</div>
                        <div class="tag__content">reciclaje</div>
                        <div class="tag__content">limpieza</div>
                        <div class="tag__content">mantenimiento</div>
                    </div> -->
                    <p class="card__description"><?php $iniciativa['descripcion'] ?></p>
                </article>
                <picture class="card__picture"><img <?php 'src="data:image;base64,' . $iniciativa['cover'] . '"' ?> alt="CamioncitosSa"></picture>
            </aside>
        <?php } ?>
    </section>

    <div class="btn__container">
        <button class="btn outerline" id="loadMore">
            <img src="public/assets/icons/IconUse.svg" alt="plus icon" />
            Load more initiatives
        </button>
    </div>
</main>

<script type="module" src="public/js/initiatives/viewall.js"></script>
<?php require_once FOOTER; ?>