<?php
if (!isset($_SESSION))
    session_start();

// if (empty($_SESSION['user'])) { //simulacion manejo de variables de sesion
//     // redireccionar al login

// }
?>
<!-- parte inicial del documento-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Savecoders" />
    <link href="public/css/styles.css" rel="stylesheet">
    <link rel="icon" href="public/assets/icons/logo.svg" type="image/svg+xml" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v6.7.0/css/all.css"
        crossorigin="anonymous">

    <title>TreeVitae</title>

    <style>
        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: 3.2em 0;
            gap: 4em;
        }

        #hero__title__company {
            font-family: 'Inter', sans-serif;
            font-size: 10ch;
            font-weight: 700;
            text-align: center;
            color: transparent;
            background: linear-gradient(135deg,
                    var(--primary-base) 0%,
                    var(--primary-500) 25%,
                    #05fa77 50%,
                    var(--accent-500) 75%,
                    var(--accent-base) 100%);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            background-size: 400% 400%;
            line-height: 1.2;
            animation: gradient 10s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0 0;
            }

            25% {
                background-position: 100% 0;
            }

            50% {
                background-position: 100% 100%;
            }

            75% {
                background-position: 0 100%;
            }

            100% {
                background-position: 0 0;
            }
        }

        .hero__figures {
            display: grid;
            width: 100%;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2em;
            place-content: center;
        }

        .hero__figure {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            aspect-ratio: 1/1;
            box-shadow: 0 0 10px 10px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease-in-out;
            overflow: hidden;
            object-fit: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /* .hero__figure 1, 3, 5 */
        .hero__figure:nth-child(1),
        .hero__figure:nth-child(3),
        .hero__figure:nth-child(5) {
            border-radius: 50%;
            height: 100%;
        }

        .hero__figure:nth-child(2),
        .hero__figure:nth-child(4) {
            border-radius: 36px;
        }

        .hero__figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
        }

        .hero__figure:hover {
            filter: brightness(1);
        }

        .hero__figure:has(a) {
            background: linear-gradient(135deg,
                    rgba(48, 234, 178, 0.14) 0%,
                    rgba(48, 234, 178, 0.262) 25%,
                    rgba(48, 234, 178, 0.55) 50%,
                    rgba(48, 234, 178, 0.615) 75%,
                    rgba(48, 234, 178, 0.486) 100%);
            background-size: 400% 400%;
            line-height: 1.2;
            backdrop-filter: blur(20px) saturate(200%);
            background-size: 400% 400%;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.125);
            animation: gradient 10s ease infinite;
        }

        .link-initiatives {
            text-decoration: none;
            font-size: 2ch;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            color: var(--text-900);
            transition: all 0.1s ease-in-out;
        }

        .link-initiatives:hover {
            text-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
        }

        .hero__info__container {
            display: grid;
            gap: 3em;
            width: 100%;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .hero__info {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            padding: 4em;
            backdrop-filter: blur(20px) saturate(200%);
            -webkit-backdrop-filter: blur(20px) saturate(200%);
            background-color: rgba(52, 182, 143, 0.14);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

        .hero__info__description {
            font-size: 2.2ch;
            font-family: 'Raleway', sans-serif;
            line-height: 1.2;
            font-weight: 400;
            color: var(--secondary-950);
        }

        #hero-scroll__footer {
            display: inline-block;
            /*Prefiero usar un flex, pero debo cumplir con minimo 4 estilos de maquetación*/
            align-items: center;
            margin: auto;
        }

        #hero-scroll__footer svg {
            margin-bottom: -0.5em;
            animation: scroll-arrow 1s ease infinite;
        }

        @keyframes scroll-arrow {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-0.5em);
            }

            100% {
                transform: translateY(0);
            }
        }

        #paragraph__banner {
            display: flex;
            width: 100%;
            margin-top: 4em;
            margin-bottom: 4em;
        }

        #paragraph__banner p {
            font-size: 3.6ch;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            color: var(--text-800);
            text-align: center;
            line-height: 1.4;
        }

        .promo__banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2em;
            min-height: 480px;
            margin: 3em 0;
        }

        .promo__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            aspect-ratio: 16/9;
            box-sizing: border-box;
            max-width: 480px;
            border-radius: 24px;
        }

        .promo__content {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            text-align: right;
            gap: 2em;
            width: 100%;
        }

        .promo__content h2 {
            font-size: 5ch;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            color: var(--text-900);
        }

        .promo__content p {
            font-size: 3ch;
            color: var(--text-800);
            line-height: 1.4;
        }

        #paragraph__banner .highlight {
            font-weight: 700;
            color: var(--accent-base);
        }

        .info__box {
            display: flex;
            justify-content: space-between;
            gap: 2em;
            padding: 6em 3em;
            border-radius: 24px;
            background-color: var(--background-100);
        }

        .info__box__left {
            display: flex;
            flex-direction: column;
            gap: 1.4em;
            width: 32%;
        }

        .info__box__left h3 {
            font-size: 3.2ch;
            font-weight: 600;
            color: var(--text-900);
        }

        .info__box__right {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            font-family: 'Raleway', sans-serif;
            gap: 3em;
            width: 60%;
        }

        .info__box__right p {
            font-size: 2ch;
            line-height: 1.6;
            font-weight: 400;
            color: var(--secondary-900);
        }

        .info__box__right p:nth-child(1)::before {
            content: '1';
        }

        .info__box__right p:nth-child(2)::before {
            content: '2';
        }

        .info__box__right p:nth-child(3)::before {
            content: '3';
        }

        .info__box__right p:nth-child(4)::before {
            content: '4';
        }

        .info__box__right p::before {
            content: '•';
            font-size: 3ch;
            font-weight: 700;
            position: absolute;
            transform: translateX(-1em);
            color: var(--accent-base);
            line-height: 1.2;
        }

        @media (max-width: 1000px) {
            #hero__title__company {
                font-size: 3em;
            }

            .hero__info:last-child {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 820px) {
            .promo__banner {
                flex-direction: column;
            }

            .promo__image {
                max-width: 100%;
                height: auto;
                aspect-ratio: unset;
                border-radius: 24px;
                margin-bottom: 2em;
            }

            .info__box {
                flex-direction: column;
                padding: 4em 3em;
                justify-content: center;
                align-items: center;
                gap: 5em;
            }

            .info__box__left,
            .info__box__right {
                width: 100%;
                gap: 2em;
            }

            .info__box__right>p {
                margin-bottom: 2rem;
            }

            .info__box__right p:before {
                transform: translateY(-1em);
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <nav class="navbar">
            <div class="logo__container">
                <img src="public/assets/icons/logo.svg" alt="TreeVitae logo" />
                <a class="logo__name" href="index.php">TreeVitae</a>
            </div>


            <div class="nav__hamburguer">
                <div class="nav__hamburguer__line"></div>
                <div class="nav__hamburguer__line"></div>
                <div class="nav__hamburguer__line"></div>
            </div>

            <div class="nav__overlay">
                <ul class="nav__links">
                    <li class="nav__item">
                        <span class="nav__parent can__open">
                            Iniciativas
                            <i class="fa-solid fa-angle-down arrow__down"></i>
                        </span>
                        <ul class="nav__inner">
                            <li class="nav__dropdown">
                                <a href="index.php?c=iniciativa&f=viewall" class="nav__link"><i class="ti ti-settings"></i>Ver Iniciativas</a>
                            </li>
                            <li class="nav__dropdown">
                                <a href="index.php?c=iniciativa&f=viewall" class="nav__link"><i class="ti ti-settings"></i>Crea tu Iniciativa</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?c=post&f=viewall">Posts</a>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?c=index&f=index&p=preguntas">Preguntas</a>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?c=index&f=index&p=contact">About</a>
                    </li>

                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav__item">
                            <span class="nav__parent can__open">
                                <img src="{{g.user.image_perfil}}" class="nav__image-perfil" alt="Perfil" />
                                {{ g.user.nombre }}
                                <div class="arrow__down"></div>
                            </span>

                            <ul class="nav__inner">
                                <li class="nav__dropdown">
                                    <a href="{{ url_for('user.profile') }}" class="nav__link"><i class="ti ti-user"></i> Perfil</a>
                                </li>

                                <li class="nav__dropdown">
                                    <a href="{{ url_for('user.update') }}" class="nav__link"><i class="ti ti-settings"></i> Editar Perfil</a>
                                </li>

                                <li class="nav__dropdown">
                                    <a href="{{ url_for('user.logout') }}" class="nav__link"><i class="ti ti-logout"></i> Cerrar Sesion</a>
                                </li>
                            </ul>
                        </li>

                    <?php } else { ?>

                        <ul class="nav__btns">
                            <li lass="nav__item">
                                <a href="index.php?c=user&f=register_view" class="link__outerline">Register</a>
                            </li>
                            <li lass="nav__item">
                                <a href="index.php?c=user&f=login_view" class="btn primary__with-icon">
                                    <img src="public/assets/icons/user.svg" alt="User icon" />
                                    Login
                                </a>
                            </li>
                        </ul>

                    <?php } ?>
                </ul>
            </div>
        </nav>