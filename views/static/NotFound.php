<?php require_once HEADER; ?>
<!-- //Autor: Pincay Alvarez Pablo Salvador -->
<style>
    .container__404 {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
    }

    .title__principal {
        text-align: center;
        margin-top: 20px;
        color: var(--text-base);
    }
</style>

<main class="main__container__content">

    <div class="container__404">
        <image src="public/assets/images/404.svg" alt="Error 404" />
    </div>
    <h1 class="title__principal">Hey!!! Algo paso :(</h1>

    <!-- volver a la pagina anterior -->
    <a href="javascript:history.back()" class="btn primary__with-icon">Regresa a la pagina Anterior!</a>
</main>

<?php require_once FOOTER; ?>