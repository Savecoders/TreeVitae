<footer class="footer">
    <div class="logo__container">
        <img src="public/assets/icons/logo.svg" alt="TreeVitae logo" />
        <a class="logo__name" href="#">TreeVitae</a>
    </div>

    <div class="footer__container">
        <section class="footer__section">
            <h2>Acerca de nosotros</h2>
            <a class="link" href="index.php?c=index&f=index&p=preguntas">Quienes somos</a>
            <?php if (!isset($_SESSION['user'])) { ?>
                <a href="index.php?c=user&f=login_view" class="btn primary__with-icon">
                    <img src="public/assets/icons/user.svg" alt="User icon" />
                    Login
                </a>
            <?php } ?>
        </section>

        <section class="footer__section">
            <h2>Contactanos</h2>
            <a class="link" href="#">Contacto</a>
            <a class="link" href="#">Soporte</a>
        </section>

        <section class="footer__section">
            <h2>Social Media</h2>
            <a href="#" class="link" target="_blank">Github
                <img src="public/assets/icons/external-link.svg" alt="External link icon" />
            </a>
            <a href="#" class="link" target="_blank">Youtube
                <img src="public/assets/icons/external-link.svg" alt="External link icon" />
            </a>
            <a href="#" class="link" target="_blank">Discord
                <img src="public/assets/icons/external-link.svg" alt="External link icon" />
            </a>
        </section>
    </div>

    <hr class="separetor__horizontal" />

    <div class="content__made-with">
        <p class="made__text">
            Made with ❤ by
            <a target="_blank" class="link" href="https://github.com/Savecoders">@Savecoders</a> |
            <a target="_blank" class="link" href="https://github.com/Angelvigar">@Angelvigar</a> |
            <a target="_blank" class="link" href="https://github.com/AbrahamzzZ">@AbrahamzzZ</a> |
            <a target="_blank" class="link" href="https://github.com/JoseAndresAgurtoPincay">@JoseAndresAgurtoPincay</a>
            |
            <a target="_blank" class="link" href="https://github.com/Gabo-UG">@Gabo-UG</a>
        </p>
    </div>

    <p class="copyright">Copyright © 2022 TreeVitae. All rights reserved.</p>
</footer>
</div>

<?php if (isset($_SESSION['mensaje'])) { ?>
    <div class="notify-messages">
        <?php if ($_SESSION['type'] == 'success') { ?>
            <div class="message success" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <i class="fa-solid fa-circle-check"></i>
            </div>
        <?php } else { ?>
            <div class="message danger" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>
        <?php } ?>
    </div>

<?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['type']);
} ?>

<script type="module" src="public/js/components/navbar.js"></script>
<script type="module" src="public/js/components/message.js"></script>

</body>

</html>