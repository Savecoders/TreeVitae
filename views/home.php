<?php require_once HEADER; ?>

<main class="main__container__content">
    <div class="hero">
        <h1 id="hero__title__company">Conectando vida y naturaleza para un futuro sostenible</h1>
        <section class="hero__figures" aria-label="hero figures section">
            <div class="hero__figure">
                <img src="public/assets/images/image1.png" alt="Hero 1" />
            </div>
            <div class="hero__figure">
                <img src="public/assets/images/image2.png" alt="Hero 2" />
            </div>
            <div class="hero__figure">
                <a class="link-initiatives" href="index.php?c=iniciativa&f=viewall"> See Initiatives </a>
            </div>
            <div class="hero__figure">
                <img src="public/assets/images/image3.png" alt="Hero 3" />
            </div>
            <div class="hero__figure">
                <img src="public/assets/images/image4.png" alt="Hero 3" />
            </div>
        </section>

        <aside class="hero__info__container">
            <div class="hero__info">
                <p class="hero__info__description">
                    En cada Iniciativa encontrarás inspiración para transformar espacios y crear un
                    impacto positivo.
                </p>
            </div>
            <div class="hero__info">
                <p class="hero__info__description">
                    Únete y Participa en la creación de iniciativas que apoyen la conservación de la
                    biodiversidad y la preservación de la naturaleza.
                </p>
            </div>

            <div class="hero__info">
                <a href="../post/viewall.html" class="link-initiatives">Explore news Posts</a>
            </div>
        </aside>

        <footer id="hero-scroll__footer">
            <svg
                width="23"
                height="33"
                viewBox="0 0 23 33"
                fill="none"
                style="height: 70%"
                data-astro-cid-j7pv25f6="">
                <rect
                    x="0.767442"
                    y="0.767442"
                    width="20.7209"
                    height="31.4651"
                    rx="10.3605"
                    stroke="var(--text-800)"
                    stroke-width="1.53488"></rect>
                <rect x="9" y="8" width="4" height="8" rx="2" fill="var(--text-800)"></rect>
            </svg>
            <small style="font-family: Inter, sans-serif; margin-left: 1em">Haga scroll para ver más</small>
        </footer>
    </div>

    <aside id="paragraph__banner">
        <p>
            Nosotros estamos comprometidos con la
            <span class="highlight">naturaleza y nuestros usuarios</span> por eso damos lugar a que
            puedan <span class="highlight">crear iniciativas</span> que apoyen la conservación de la
            biodiversidad y la preservación de la naturaleza.
        </p>
    </aside>

    <hr class="separetor__horizontal" />

    <div class="promo__banner">
        <img
            src="public/assets/images/planting-young-tree-stockcake.webp"
            alt="Girl planting trees"
            class="promo__image" />
        <section class="promo__content" aria-label="promo content section">
            <h2>Se parte de nuestra comunidad y apoya vuestras iniciativas</h2>
            <p>
                ¡Únete a una iniciativa y contribuye a la conservación de la biodiversidad y la
                preservación de la naturaleza!
            </p>
            <a href="#" class="btn outerline"> Registrate y unete!</a>
        </section>
    </div>
</main>

<hr class="separetor__horizontal" />

<section class="info__box" aria-label="info box section">
    <div class="info__box__left">
        <h3>Como funciona TreeVitae?</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    </div>
    <div class="info__box__right">
        <p>Inicia sesión o registrate para poder participar en las iniciativas.</p>
        <p>Para ser parte de las iniciativas debes darle al boton de unirte.</p>
        <p>
            Ahora vas a poder recibir los post de las iniciativas que te uniste y poder participar.
        </p>
        <p>
            Si no quieres participar, puedes darle a seguir, asi apoyas a que la iniciativa sea mas
            viral.
        </p>
    </div>
</section>
<?php require_once FOOTER; ?>
