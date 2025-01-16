<?php
class IndexController
{
    public function index()
    {
        if (!empty($_GET['p'])) {
            $page =  $_GET['p']; // limpiar datos
            // flujo de ventanas
            require_once 'views/static/' . $page . '.php';
        } else {
            // flujo de ventanas
            require_once 'views/home.php'; //mostrando la vista de home de la aplicacion

        }
    }
}
