<?php
//DTO de usuario
class Usuario
{
    private $id, $nombre, $password, $email, $fecha_registro, $fecha_nacimiento, $foto_perfil, $genero;

    function __construct() {}

    function getId()
    {
        return $this->id;
    }
    function setId($id)
    {
        $this->id = $id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

    function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $foto_perfil;
    }

    function getGenero()
    {
        return $this->genero;
    }

    function setGenero($genero)
    {
        $this->genero = $genero;
    }
    function getEstado()
    {
        return $this->genero;
    }

    function setEstado($genero)
    {
        $this->genero = $genero;
    }

    // Methods get y set parametrizados
    public function __set($nombre, $valor)
    {
        // Verifica que la propiedad exista
        if (property_exists('Usuario', $nombre)) {
            $this->$nombre = $valor;
        } else {
            echo $nombre . " No existe.";
        }
    }

    public function __get($nombre)
    {
        // Verifica que la propiedad exista
        if (property_exists('Usuario', $nombre)) {
            return $this->$nombre;
        }

        return null;
    }
}
