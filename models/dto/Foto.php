<?php
//Autor: Pincay Alvarez Pablo Salvador
class Foto
{
    private $id, $imagen;
    function __construct() {}

    // getters
    function getId()
    {
        return $this->id;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    // setters
    function setId($id)
    {
        $this->id = $id;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}
