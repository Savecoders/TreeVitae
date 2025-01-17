<?php require_once HEADER; ?>
<style>
    .main_container_content {
        padding: 0;
    }

    .separetor_horizontal_post {
        border: 1px solid var(--text-300);
    }

    /* Contenedor principal de los posts */
    .container_post_list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: 20px;
        width: 100%;
    }

    /* Estilo de cada post */
    .post {
        display: flex;
        justify-content: space-between;
        gap: 0.2rem;
        padding: 32px;
        border-radius: 19px;
        color: var(--text-700);
        align-items: center;
    }

    /* Contenedor del contenido del post */
    .post-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        max-width: 70%;
        gap: 1rem;
        padding: 2rem;
    }

    /* Imagen del post */
    .post__picture {
        min-width: 240px;
        max-width: 240px;
        border-radius: 8px;
        overflow: hidden;
    }

    .post__picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* tiempo del post*/
    .post_date {
        display: flex;
        align-items: center;
    }

    .profile_content {
        display: flex;
        height: 36px;
        border-right: 1px solid var(--text-200);
        padding-right: 16px;
        align-items: center;
    }

    .profile_Name {
        font-family: 'Raleway';
        font-size: 32px;
        color: var(--text-600);
    }

    .profile_content figure {
        padding-right: 12px;
    }

    .post_date span {
        padding-left: 12px;
        font-family: 'Raleway';
        color: var(--text-500);
        font-size: 32px;
    }

    .icon_Count_Container {
        display: flex;
        gap: 1rem;
    }

    .iconCount {
        display: flex;
        gap: 1.5rem;
        font-family: 'Inter';
        font-size: 20px;
    }

    .iconItem {
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    .iconItem img {
        width: 20px;
        height: 20px;
    }

    .title_post {
        font-size: 36px;
        color: var(--text-700);
        font-family: 'Raleway';
        text-decoration: none;
    }

    .title_post:hover {
        text-decoration: underline;
        color: var(--accent-500);
    }

    select::after {
        content: '▼';
        position: absolute;
        pointer-events: none;
        font-size: 12px;
    }

    .relevance select,
    .all-time select {
        background: var(--backgroud-base);
        color: var(--text-900);
        border: 1px solid var(--text-700);
        padding: 5px;
        font-size: 14px;
        border-radius: 20px;
    }

    .relevance select:focus,
    .all-time select:focus {
        outline: none;
    }

    .relevance select option,
    .all-time select option {
        background: var(--background-base);
        color: var(--text-900);
    }

    select:hover,
    select:focus {
        outline: none;
    }

    /* Estilos responsive para pantallas pequeñas */
    @media (max-width: 768px) {

        /* Navbar */
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav__links {
            display: none;
        }

        .nav__btns {
            display: none;
        }

        /* Breadcrumbs */
        .breadcrumb {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin: 0 auto;
            width: 100%;
            max-width: 300px;
        }

        .filters_options {
            flex-direction: column;
            align-items: flex-start;
            font-size: 24px;
        }

        /* Contenedor de posts */
        .container_post_list {
            gap: 1rem;
        }

        /* Estilo de cada post */
        .post {
            flex-direction: column;
            padding: 16px;
        }

        /* Imagen del post */
        .post__picture {
            min-width: 100%;
            max-width: 100%;
            margin-bottom: 16px;
        }

        .post-content {
            max-width: 100%;
            padding: 1rem;
        }

        /* Títulos y texto en general */
        .profile_Name,
        .title_post,
        .post_date span {
            font-size: 20px;
        }

        .iconCount {
            font-size: 16px;
        }

        select {
            font-size: 24px;
        }
    }

    /* Responsive para pantallas extra pequeñas (teléfonos) */
    @media (max-width: 480px) {
        .filters_options {
            font-size: 18px;
        }

        /* Texto de los posts */
        .profile_Name,
        .title_post,
        .post_date span {
            font-size: 18px;
        }

        /* Iconos de likes y comentarios */
        .iconCount {
            font-size: 14px;
        }

        /* Footer */
        footer {
            display: flex;
            justify-content: space-around;
            align-items: center;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }

        .footer__container {
            flex-direction: column;
            align-items: center;
        }

        .footer__section {
            margin-bottom: 20px;
            text-align: center;
        }

        .content__made-with {
            text-align: center;
            font-size: 14px;
        }
    }
</style>
<!-- Breadcrumbs - Start Here-->
<main class="main_container_content">
    <div class="breadcrumbs flex-row">
        <a href="../home/index.html">Home</a>
        <span class="breadcrumbs__arrow"> / </span>
        <a href="#">Posts</a>
    </div>

    <!-- Options -->
    <div
        class="filters_options"
        style="
            display: flex;
            gap: 1.5rem;
            justify-content: flex-start;
            align-items: center;
            padding: 10px;
            font-size: 32px;
            color: var(--text-900);
            font-family: 'Inter';
          ">
        <div class="relevance">
            <select
                id="relevance"
                style="
                background-color: transparent;
                font-size: 32px;
                border: none;
                margin-right: 20px;
                font-family: 'Inter';
                position: relative;
              ">
                <option value="likes">Relevance</option>

                <option value="likes">More likes</option>
                <option value="comments">More comments</option>
            </select>
        </div>
        <div class="all-time">
            <select
                id="all-time"
                style="
                background-color: transparent;
                font-size: 32px;
                border: none;
                margin-right: 20px;
                font-family: 'Inter';
                position: relative;
              ">
                <option value="allTime">All Time</option>
                <option value="lastMonth">Last Month</option>
                <option value="lastWeek">Last Week</option>
                <option value="lastyear">Last Year</option>
            </select>
        </div>
    </div>
    <!-- Posts -->
    <section class="container_post_list">
        <!-- Posts 1-->
        <div class="post">
            <div class="post-content">
                <div class="post_date">
                    <div class="profile_content">
                        <figure>
                            <img src="public/assets/icons/Icon_Profile_Initiative.svg" alt="icon_profile" />
                        </figure>
                        <p class="profile_Name">TreeVitae</p>
                    </div>
                    <span>27d</span>
                </div>
                <a class="title_post" href="./view.html">[BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                    fly!</a>
                <div class="icon_Count_Container">
                    <div class="iconCount">
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Likes.svg" alt="iconLikes" />
                            <span>44 Likes</span>
                        </div>
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Comments.svg" alt="iconComments" />
                            <span>440 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
            <picture class="post__picture">
                <img src="public/assets/images/iniciativa-default.png" alt="Iniciativa 1" />
            </picture>
        </div>
        <hr class="separetor_horizontal_post" />

        <!-- Posts 2-->
        <div class="post">
            <div class="post-content">
                <div class="post_date">
                    <div class="profile_content">
                        <figure>
                            <img src="public/assets/icons/Icon_Profile_Initiative.svg" alt="icon_profile" />
                        </figure>
                        <p class="profile_Name">TreeVitae</p>
                    </div>
                    <span>5d</span>
                </div>
                <a class="title_post" href="./view.html">[BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                    fly!</a>
                <div class="icon_Count_Container">
                    <div class="iconCount">
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Likes.svg" alt="iconLikes" />
                            <span>100 Likes</span>
                        </div>
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Comments.svg" alt="iconComments" />
                            <span>44 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
            <picture class="post__picture">
                <img src="public/assets/images/iniciativa-default.png" alt="Iniciativa 1" />
            </picture>
        </div>
        <hr class="separetor_horizontal_post" />

        <!-- Posts 3-->
        <div class="post">
            <div class="post-content">
                <div class="post_date">
                    <div class="profile_content">
                        <figure>
                            <img src="public/assets/icons/Icon_Profile_Initiative.svg" alt="icon_profile" />
                        </figure>
                        <p class="profile_Name">TreeVitae</p>
                    </div>
                    <span>3m</span>
                </div>
                <a class="title_post" href="./view.html">[BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                    fly!</a>
                <div class="icon_Count_Container">
                    <div class="iconCount">
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Likes.svg" alt="iconLikes" />
                            <span>700 Likes</span>
                        </div>
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Comments.svg" alt="iconComments" />
                            <span>300 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
            <picture class="post__picture">
                <img src="public/assets/images/iniciativa-default.png" alt="Iniciativa 1" />
            </picture>
        </div>
        <hr class="separetor_horizontal_post" />

        <!-- Posts 4-->
        <div class="post">
            <div class="post-content">
                <div class="post_date">
                    <div class="profile_content">
                        <figure>
                            <img src="public/assets/icons/Icon_Profile_Initiative.svg" alt="icon_profile" />
                        </figure>
                        <p class="profile_Name">TreeVitae</p>
                    </div>
                    <span>7m</span>
                </div>
                <a class="title_post" href="./view.html">[BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                    fly!</a>
                <div class="icon_Count_Container">
                    <div class="iconCount">
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Likes.svg" alt="iconLikes" />
                            <span>44 Likes</span>
                        </div>
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Comments.svg" alt="iconComments" />
                            <span>44 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
            <picture class="post__picture">
                <img src="public/assets/images/iniciativa-default.png" alt="Iniciativa 1" />
            </picture>
        </div>
        <hr class="separetor_horizontal_post" />

        <!-- Posts 5-->
        <div class="post">
            <div class="post-content">
                <div class="post_date">
                    <div class="profile_content">
                        <figure>
                            <img src="public/assets/icons/Icon_Profile_Initiative.svg" alt="icon_profile" />
                        </figure>
                        <p class="profile_Name">TreeVitae</p>
                    </div>
                    <span>1y</span>
                </div>
                <a class="title_post" href="./view.html">[BSPWM] The new Picom Animations are awesome! And an app to edit my rices on the
                    fly!</a>
                <div class="icon_Count_Container">
                    <div class="iconCount">
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Likes.svg" alt="iconLikes" />
                            <span>44 Likes</span>
                        </div>
                        <div class="iconItem">
                            <img src="public/assets/icons/IconUse_Comments.svg" alt="iconComments" />
                            <span>44 Comments</span>
                        </div>
                    </div>
                </div>
            </div>
            <picture class="post__picture">
                <img src="public/assets/images/iniciativa-default.png" alt="Iniciativa 1" />
            </picture>
        </div>
        <hr class="separetor_horizontal_post" />
        <!-- Posts Final-->
    </section>
</main>

<script type="module" src="public/js/post/viewall.js"></script>
<?php require_once FOOTER; ?>