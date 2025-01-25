<?php
//FrontController
require_once 'core/Config.php';

try {
    // leer parametros
    $controlador = (!empty($_REQUEST['c'])) ? htmlentities($_REQUEST['c']) : CONTROLADOR_PRINCIPAL;
    $controlador = ucwords(strtolower($controlador)) . "Controller";
    $funcion = (!empty($_REQUEST['f'])) ? htmlentities($_REQUEST['f']) : FUNCION_PRINCIPAL;

    $controllerFile = 'controllers/' . $controlador . '.php';

    if (!file_exists($controllerFile)) {
        throw new Exception('Controller not found');
    }

    require_once $controllerFile;

    if (!class_exists($controlador)) {
        throw new Exception('Controller class not found');
    }

    $cont = new $controlador();

    if (!method_exists($cont, $funcion)) {
        throw new Exception('Method not found');
    }

    $cont->$funcion();
} catch (Exception $e) {
    require_once 'controllers/ErrorController.php';
    $error = new ErrorController();
    $error->notFound();
}
