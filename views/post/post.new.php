<?php require_once HEADER; ?>
<!-- Autor: Vivanco Garcia Angel Enrique -->
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
    }

    .label__name {
        font-size: 1.8ch;
        font-weight: 600;
        color: var(--text-900);
        font-family: 'Raleway', sans-serif;
    }

    .input__text, .textarea__comment, select {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid var(--accent-400);
        background-color: var(--background-50);
        color: var(--text-base);
        border-radius: 4px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .input__text:focus, .textarea__comment:focus, select:focus {
        border-color: var(--primary-400);
    }

    .textarea__comment {
        resize: none;
        height: 100px;
    }

    .btn-add {
        width: 100%;
        padding: 10px;
        background-color: black;
        color: white;
        border: 2px solid green;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 500;
    }
</style>

<body>
    <main class="main__container__content">
        <div class="breadcrumbs flex-row">
            <a href="../home/index.html">Home</a>
            <span class="breadcrumbs__arrow"> / </span>
            <a href="#">Crear Post</a>
        </div>

        <h1 class="title__principal">Crear un nuevo Post</h1>
        <article class="container__principal">
            <form class="container__form" id="formulario" method="POST" action="index.php?c=post&f=new&id=<?php 
            echo $parametro; ?>">
                <section id="container__second">
                    <legend id="label__form">Datos del Post</legend>

                    <div class="container__component">
                        <label class="label__name" for="titulo">Título: </label>
                        <input type="text" id="titulo" name="titulo" required />
                    </div>

                    <div class="container__component">
                        <label class="label__name" for="subtitulo">Subtítulo: </label>
                        <input type="text" id="subtitulo" name="subtitulo" />
                    </div>

                    <div class="container__component">
                        <label class="label__name" for="contenido">Contenido: </label>
                        <textarea class="textarea__comment" id="contenido" name="contenido" required></textarea>
                    </div>

                    <div class="container__component">
                        <label class="label__name" for="permite_comentarios">¿Permitir comentarios? </label>
                        <select id="permite_comentarios" name="permite_comentarios" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="container__component">
                        <label class="label__name" for="fecha_publicacion">Fecha de Publicación: </label>
                        <input type="datetime-local" id="fecha_publicacion" name="fecha_publicacion" />
                    </div>

                    <div class="container__component">
                        <button type="submit" class="btn-add">Registrar</button>
                    </div>
                </section>
            </form>
        </article>
    </main>
</body>
<?php require_once FOOTER; ?>