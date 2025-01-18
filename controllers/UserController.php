<?php
require_once 'models/repository/Usuario.repository.php';
require_once 'models/dto/Usuario.php';
require_once 'utils/redirectWithMessage.php';
require_once 'utils/cleaned.php';
class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UsuarioRepository();
    }

    public function viewall()
    {
        require_once VUSER . 'profile.php';
    }

    public function login_view()
    {
        require_once VUSER . 'login.php';
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $_SESSION["mensaje"] = "Funcion no encontrada";
            $_SESSION["color"] = "danger";
            header("index.php?c=user&a=login_view");
        }

        if (
            limpiar($_POST['email']) == '' || limpiar($_POST['password']) == ''
            || !isset($_POST['email']) || !isset($_POST['password'])
        ) {
            redirectWithMessage(
                false,
                'Usuario Encontrado',
                'Usuario o contraseña incorrectos',
                'index.php?c=user&f=login_view'
            );
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        try {


            $user = $this->model->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                redirectWithMessage(
                    true,
                    'Usuario Encontrado',
                    'Usuario o contraseña incorrectos',
                    'index.php'
                );
            } else {
                redirectWithMessage(
                    false,
                    'Usuario Encontrado',
                    'Usuario o contraseña incorrectos',
                    'index.php?c=user&f=login_view'
                );
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            redirectWithMessage(
                false,
                'Usuario Encontrado',
                'Usuario o contraseña incorrectos',
                'index.php?c=user&f=login_view'
            );
        }
    }

    public function register_view()
    {
        require_once VUSER . 'register.php';
    }

    public function register()
    {
        require_once VUSER . 'register.php';
    }
}
