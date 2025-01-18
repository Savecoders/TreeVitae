<?php
require_once 'models/repository/Usuario.repository.php';
require_once 'models/dto/Usuario.php';
require_once 'utils/redirectWithMessage.php';
require_once 'utils/cleanser.php';
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
            if ($user != []) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['user'] = array(
                    'ID' => $user['ID'],
                    'email' => $user['email'],
                    'nombre_usuario' => $user['nombre_usuario'],
                    'password' => $user['password'],
                    'foto_perfil' => $user['foto_perfil'],
                    'genero' => $user['genero'],
                    'fecha_nacimiento' => $user['fecha_nacimiento'],
                    'fecha_registro' => $user['fecha_registro'],
                );
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

    public function logout()
    {
        session_start();
        session_destroy();
        redirectWithMessage(
            true,
            'Se cerro la session Correctamente',
            'No hay usuario logueado',
            'index.php'
        );
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
