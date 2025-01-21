<?php
function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
{
    $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
    $_SESSION['type'] = ($exito) ? 'success' : 'danger';

    header("Location: $redirectUrl");
}
