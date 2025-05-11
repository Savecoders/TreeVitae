<?php
//Autor: Pincay Alvarez Pablo Salvador
require_once HEADER;
if (!empty($SESSION['user'])) {
    header('Location: index.php?c=user&f=login');
}
?>

<!-- //Autor: Pincay Alvarez Pablo Salvador -->
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
    <h1>Editar Tu Iniciativa</h1>

    <?php if (isset($iniciativa)) { ?>
        <form class="form__container" id="initiative-form" action="index.php?c=iniciativa&f=update&id=<?php echo $iniciativa[0]->getId(); ?>" method="POST" enctype="multipart/form-data">
            <div class="form__group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Nombre de la iniciativa" value="<?php echo $iniciativa[0]->getNombre(); ?>" />
                <span class=" error"></span>
            </div>

            <div class="form__group">
                <label for="description">Descripcion</label>
                <textarea id="description" name="description"><?php echo $iniciativa[0]->getDescripcion(); ?>
                </textarea>
                <span class="error"></span>
            </div>
            <!-- icon iniciativa -->
            <div class="form__group">
                <section class="cover__container">
                    <aside class="labels__cover">
                        <label for="logo">Logo de la Iniciativa</label>
                        <input type="file" id="logo" name="logo" accept="image/*" " />
                        <label class=" file-input-label" for="logo"> Seleccionar archivo </label>
                    </aside>
                    <img id="logo-preview" src="data:image;base64,<?php echo base64_encode($iniciativa[0]->getLogo()); ?>" alt="<?php echo $iniciativa[0]->getNombre(); ?>">
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
                    <img id="preview" src="data:image;base64,<?php echo base64_encode($iniciativa[0]->getCover()); ?>" alt="<?php echo $iniciativa[0]->getNombre(); ?>" style="display: block;">
                </section>
                <span class="error" id="cover-error"></span>
            </div>
            <!-- select your tags -->
            <div class="form__group">
                <p id="tags__label" for="tags__label">Tags</p>
                <span class="error"></span>
                <input type="hidden" name="selected_tags" id="selected_tags" value="">
                <section class="tags" role="group" aria-label="tags">

                    <?php
                    $tags_include = [];

                    foreach ($iniciativa[0]->getTags() as $tagIniciativa) {
                        array_push($tags_include, $tagIniciativa->getId());
                    }
                    ?>

                    <?php foreach ($tags as $tag) { ?>
                        <?php if (
                            in_array($tag['ID'], $tags_include)
                        ) { ?>
                            <div class="tag tag--clicked" id="tag-<?php echo $tag['nombre']; ?>" role="listitem" data-id="<?php echo $tag['ID']; ?>" value="<?php echo $tag['ID']; ?>">
                                <?php echo $tag['nombre']; ?>
                            </div>
                        <?php } else { ?>
                            <div class="tag" id="tag-<?php echo $tag['nombre']; ?>" role="listitem" data-id="<?php echo $tag['ID']; ?>" value="<?php echo $tag['ID']; ?>">
                                <?php echo $tag['nombre']; ?>
                            </div>
                        <?php }  ?>

                    <?php } ?>
                </section>
            </div>

            <button class="btn primary__with-icon" style="padding: 1rem" type="submit">
                Actualizar Iniciativa
            </button>
        </form>

    <?php } else { ?>
        <h2>No se encontro la iniciativa</h2>
    <?php } ?>
</main>
<script type="module" src="public/js/initiatives/edit.js"></script>
<?php require_once FOOTER; ?>