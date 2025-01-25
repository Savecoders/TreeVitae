<?php
//autor:Alex Vera Lopez
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
                    'Bienvenido es bueno verte!!',
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
        // Cerrar la sesión
        $_SESSION = [];
        session_destroy();
        redirectWithMessage(
            true,
            'Se cerro la session Correctamente',
            'No hay usuario logueado',
            'index.php'
        );
    }

    public function update_profile()
    {
        if (!isset($_SESSION['user']['ID'])) {
            redirectWithMessage(
                false,
                'Acceso denegado',
                'Debes iniciar sesión para editar tu perfil',
                'index.php?c=user&f=login_view'
            );
            return;
        }

        $userId = $_SESSION['user']['ID'];
        $usuarioRepository = new UsuarioRepository();
        $userData = $usuarioRepository->getById($userId);

        require_once VUSER . 'update.php';
    }
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            redirectWithMessage(
                false,
                'Método inválido',
                'No se puede procesar la solicitud',
                'index.php'
            );
            return;
        }

        if (!isset($_SESSION['user']['ID'])) {
            redirectWithMessage(
                false,
                'Acceso denegado',
                'Debes iniciar sesión',
                'index.php?c=user&f=login_view'
            );
            return;
        }

        $id = $_SESSION['user']['ID'];
        $nombre_usuario = limpiar($_POST['nombre_usuario'] ?? '');
        $email = limpiar($_POST['email'] ?? '');
        $genero = limpiar($_POST['genero'] ?? '');
        $password = $_POST['password'] ?? '';
        $fecha_nacimiento = limpiar($_POST['fecha_nacimiento'] ?? '');
        $foto_perfil = $_FILES['foto_perfil'] ?? null;

        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNombre($nombre_usuario);
        $usuario->setEmail($email);
        $usuario->setGenero($genero);
        $usuario->setFechaNacimiento($fecha_nacimiento);

        $usuarioRepository = new UsuarioRepository();
        $usuarioActual = $usuarioRepository->getById($id);

        if (isset($foto_perfil) && $foto_perfil['error'] === UPLOAD_ERR_OK) {
            $usuario->setFotoPerfil(file_get_contents($foto_perfil['tmp_name']));
        } else {
            $usuario->setFotoPerfil($usuarioActual['foto_perfil'] ?? null);
        }

        if (!empty($password)) {
            $usuario->setPassword($password);
        } else {
            $usuario->setPassword($usuarioActual['password'] ?? null);
        }

        if ($usuarioRepository->update($usuario)) {
            $_SESSION['user']['nombre_usuario'] = $nombre_usuario;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['genero'] = $genero;
            $_SESSION['user']['fecha_nacimiento'] = $fecha_nacimiento;

            redirectWithMessage(
                true,
                'Perfil actualizado',
                'Tus datos se actualizaron correctamente',
                'index.php?c=user&f=profile_view&id=' . $id
            );
        } else {
            redirectWithMessage(
                false,
                'Error',
                'No se pudo actualizar el perfil',
                'index.php?c=user&f=profile_view&id=' . $id
            );
        }
        if (isset($foto_perfil) && $foto_perfil['error'] === UPLOAD_ERR_OK) {
            $_SESSION['user']['foto_perfil'] = file_get_contents($foto_perfil['tmp_name']);
        }
    }


    public function profile()
    {
        require_once VUSER . 'profile.php';
    }

    public function profile_view()
    {
        // Si no hay ID, usar el ID del usuario logueado
        if (!isset($_GET['id'])) {
            if (!isset($_SESSION['user']['ID'])) {
                redirectWithMessage(
                    false,
                    'Acceso denegado',
                    'Debes iniciar sesión para ver tu perfil',
                    'index.php?c=user&f=login_view'
                );
                return;
            }
            // Redirigir con el ID del usuario
            header("Location: index.php?c=user&f=profile_view&id=" . $_SESSION['user']['ID']);
            exit();
        }

        $userId = intval($_GET['id']);

        // Buscar usuario por ID
        $usuarioRepository = new UsuarioRepository();
        $userData = $usuarioRepository->getById($userId);

        if (!$userData) {
            redirectWithMessage(
                false,
                'Usuario no encontrado',
                'El perfil solicitado no existe',
                'index.php'
            );
            return;
        }

        require_once VUSER . 'profile.php';
    }
    public function register_view()
    {
        require_once VUSER . 'register.php';
    }


    public function agregar()
    {

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
    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            redirectWithMessage(
                false,
                'Método inválido',
                'No se puede procesar la solicitud',
                'index.php'
            );
            return;
        }

        $id = intval($_POST['id'] ?? 0);

        // Validar que el usuario esté autenticado y que el ID pertenezca al usuario logueado
        if (!isset($_SESSION['user']['ID']) || $_SESSION['user']['ID'] != $id) {
            redirectWithMessage(
                false,
                'Acceso denegado',
                'No tienes permiso para eliminar esta cuenta',
                'index.php'
            );
            return;
        }

        $usuarioRepository = new UsuarioRepository();

        // Verificar si el usuario es administrador de una iniciativa
        if ($usuarioRepository->isAdminOfInitiative($id)) {
            redirectWithMessage(
                false,
                'Error',
                'No puedes eliminar tu cuenta porque eres administrador de una iniciativa',
                'index.php?c=user&f=profile_view&id=' . $id
            );
            return;
        }

        // Verificar si el usuario está unido a una "join"
        if ($usuarioRepository->isJoinedToSomething($id)) {
            redirectWithMessage(
                false,
                'Error',
                'No puedes eliminar tu cuenta porque estás unido a una "join"',
                'index.php?c=user&f=profile_view&id=' . $id
            );
            return;
        }

        // Cambiar el estado del usuario a 0
        if ($usuarioRepository->deactivate($id)) {
            $_SESSION = []; // Limpiar la sesión antes de destruirla
            session_destroy();
            redirectWithMessage(
                true,
                'Cuenta eliminada',
                'Tu cuenta ha sido eliminada correctamente',
                'index.php'
            );
        } else {
            redirectWithMessage(
                false,
                'Error',
                'No se pudo eliminar la cuenta',
                'index.php?c=user&f=profile_view&id=' . $id
            );
        }
    }
    public function search_view()
    {
        $searchTerm = limpiar($_GET['name'] ?? '');
        $users = $this->model->searchUsersWithInitiatives($searchTerm);

        if (empty($users)) {
            $_SESSION['mensaje'] = 'No se encontraron usuarios con iniciativas.';
            $_SESSION['type'] = 'error';
        }

        require_once VUSER . 'search.php';
    }



    public function search()
    {
        $searchTerm = limpiar($_GET['name'] ?? '');
        $usuarioRepository = new UsuarioRepository();

        // Buscar usuarios con iniciativas
        $users = $usuarioRepository->searchUsersWithInitiatives($searchTerm);

        require_once VUSER . 'search.php';
    }
}
