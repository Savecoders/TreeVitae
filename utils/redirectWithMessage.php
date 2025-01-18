<?php
function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
{
    if (!isset($_SESSION)) session_start();
    $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
    $_SESSION['type'] = ($exito) ? 'success' : 'error';

    // echo ($exito)?$exitoMsg:$errMsg;
    header("Location: $redirectUrl");
}
