<?php require_once HEADER; ?>
<style>
    .center {
        margin: 0 auto;
    }

    .gallery__container {
        gap: 1rem;
    }

    .drop__zone {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        height: 200px;
        border: 2px dashed var(--primary-base);
        border-radius: 1rem;
        padding: 2rem;
        justify-content: center;
        align-items: center;
        width: 100%;
        cursor: pointer;
    }

    .drop__zone p {
        text-align: center;
        font-weight: 400;
        color: var(--secondary-400);
    }

    input[type='file'] {
        display: none;
    }

    .file-input-label {
        gap: 0.5rem;
        cursor: pointer;
        border: 1px solid var(--text-base);
        border-radius: 8px;
        padding: 1rem 1.5rem;
    }

    .gallery__images {
        margin-top: 2rem;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 16px;
        gap: 16px;
    }

    .gallery__images img {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        object-fit: cover;
    }

    .tag--clicked {
        background-color: var(--background-100);
    }

    .cover__container {
        display: flex;
        flex-direction: row;
        gap: 1.5rem;
        width: 100%;
        padding: 1rem 0;
    }

    .labels__cover {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
        min-width: 240px;
        align-self: flex-end;
    }

    .cover-preview,
    .logo-preview {
        display: none;
    }

    #preview,
    #logo-preview {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--text-base);
    }

    .gallery__images img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    @media (max-width: 768px) {
        .cover__container {
            flex-direction: column;
        }
    }

    .form__container {
        max-width: 664px;
    }
</style>
<main class="main__container__content center">
    <h1>Crea Tu Iniciativa</h1>

    <form class="form__container" id="initiative-form" action="index.php?c=iniciativa&f=new" method="POST" enctype="multipart/form-data">
        <div class="form__group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" placeholder="Nombre de la iniciativa" />
            <span class="error"></span>
        </div>

        <div class="form__group">
            <label for="description">Descripcion</label>
            <textarea id="description" name="description" placeholder="Descripcion de la iniciativa, se transparente indica lo que quieres lograr :)"></textarea>
            <span class="error"></span>
        </div>
        <!-- icon iniciativa -->
        <div class="form__group">
            <section class="cover__container">
                <aside class="labels__cover">
                    <label for="logo">Logo de la Iniciativa</label>
                    <input type="file" id="logo" name="logo" accept="image/*" />
                    <label class="file-input-label" for="logo"> Seleccionar archivo </label>
                </aside>
                <img
                    id="logo-preview"
                    class="logo-preview"
                    alt="Vista previa" />
            </section>
            <span class="error" id="logo-error"></span>
        </div>

        <div class="form__group">
            <section class="cover__container">
                <aside class="labels__cover">
                    <label for="cover">Imagen Cover</label>
                    <input type="file" id="cover" name="cover" accept="image/*" />
                    <label class="file-input-label" for="cover">Seleccionar archivo</label>
                </aside>
                <img id="preview" class="cover-preview" alt="Vista previa" />
            </section>
            <span class="error" id="cover-error"></span>
        </div>

        <!-- select your tags -->
        <div class="form__group">
            <p id="tags__label" for="tags__label">Tags</p>
            <span class="error"></span>
            <input type="hidden" name="selected_tags" id="selected_tags" value="">
            <section class="tags" role="group" aria-label="tags">
                <?php foreach ($tags as $tag) { ?>
                    <div class="tag" id="tag-<?php echo $tag['nombre']; ?>" role="listitem" data-id="<?php echo $tag['ID']; ?>" value="<?php echo $tag['ID']; ?>">
                        <?php echo $tag['nombre']; ?>
                    </div>
                <?php } ?>
            </section>
        </div>

        <!-- drag and drop gallery images -->
        <div class="form__group">
            <label for="gallery">Galeria de Imagenes</label>
            <section class="gallery__container" aria-label="drag and drop gallery images">
                <div
                    class="drop__zone"
                    ondragover="event.preventDefault()"
                    ondragenter="event.preventDefault()"
                    onclick="document.getElementById('gallery').click()">
                    <p>Selecciona o <span>Arrastra y suelta</span> tus imagenes aqui</p>
                    <input type="file" accept="image/*" id="gallery" name="gallery[]" multiple />
                </div>
                <div class="gallery__images"></div>
            </section>
            <span class="error" id="gallery-error"></span>
        </div>

        <button class="btn primary__with-icon" style="padding: 1rem" type="submit">
            Crear Iniciativa
        </button>
    </form>
</main>
<script type="module" src="public/js/initiatives/create.js"></script>
<?php require_once FOOTER; ?>