<?php
if (!isset($_SESSION)) {
    session_start();
}
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
            header("index.php?c=user&f=login_view");
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
    public function profile_view()
    {
        require_once VUSER . 'profile.php';
    }

    public function profile() {}

    public function register_view()
    {
        require_once VUSER . 'register.php';
    }

    public function agregar()
    {

        echo "hola mundo";
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            redirectWithMessage(
                false,
                'Método inválido',
                'No se puede procesar la solicitud.',
                'index.php?c=user&f=register_view'
            );
            return;
        }

        // Limpiar datos de entrada
        $nombre_usuario = limpiar($_POST['nombre_usuario'] ?? '');
        $email = limpiar($_POST['email'] ?? '');
        $password = limpiar($_POST['password'] ?? '');
        $confirm_password = limpiar($_POST['confirm-password'] ?? '');
        $fecha_nacimiento = limpiar($_POST['fecha_nacimiento'] ?? '');
        $genero = limpiar($_POST['genero'] ?? '');
        $foto_perfil = $_FILES['foto_perfil'] ?? null;

        // Validaciones de campos
        if (empty($nombre_usuario) || empty($email) || empty($password) || empty($confirm_password) || empty($fecha_nacimiento) || empty($genero) || empty($foto_perfil['tmp_name'])) {
            redirectWithMessage(
                false,
                'Faltan datos',
                'Todos los campos son obligatorios.',
                'index.php?c=user&f=register_view'
            );
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirectWithMessage(
                false,
                'Email inválido',
                'Por favor ingresa un correo electrónico válido.',
                'index.php?c=user&f=register_view'
            );
            return;
        }

        if ($password !== $confirm_password) {
            redirectWithMessage(
                false,
                'Contraseñas no coinciden',
                'Por favor verifica las contraseñas ingresadas.',
                'index.php?c=user&f=register_view'
            );
            return;
        }

        if (!in_array($genero, ['M', 'F', 'O'])) {
            redirectWithMessage(
                false,
                'Género inválido',
                'Por favor selecciona un género válido.',
                'index.php?c=user&f=register_view'
            );
            return;
        }


        // Crear objeto Usuario (DTO)
        $usuario = new Usuario();
        $usuario->setNombre($nombre_usuario);
        $usuario->setPassword($password);
        $usuario->setEmail($email);
        $usuario->setFechaNacimiento($fecha_nacimiento);
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $usuario->setFotoPerfil(file_get_contents($_FILES['foto_perfil']['tmp_name']));
        } else {
            $usuario->setFotoPerfil(null);
        }
        $usuario->setGenero($genero);

        // Guardar en la base de datos
        if ($this->model->add($usuario)) {
            redirectWithMessage(
                true,
                'Registro exitoso',
                'El usuario ha sido registrado correctamente.',
                'index.php?c=user&f=login_view'
            );
        } else {
            redirectWithMessage(
                false,
                'Error en el registro',
                'No se pudo registrar el usuario. Inténtalo nuevamente.',
                'index.php?c=user&f=register_view'
            );
        }
    }
}
