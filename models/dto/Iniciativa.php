<?php
// DTO: Data Transfer Object
class Iniciativa
{
    private $id, $nombre, $descripcion, $logo, $cover, $fecha_creacion, $creador, $galeria, $usuarios_iniciativas_list, $tags;

    public

    function __construct() {}

    // getters
    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getLogo()
    {
        return $this->logo;
    }

    function getCover()
    {
        return $this->cover;
    }

    function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    function getCreador()
    {
        return $this->creador;
    }

    function getGaleria()
    {
        return $this->galeria;
    }

    function getTags()
    {
        return $this->tags;
    }

    function getUsuariosIniciativas()
    {
        return $this->usuarios_iniciativas_list;
    }


    // setters
    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setLogo($logo)
    {
        $this->logo = $logo;
    }

    function setCover($cover)
    {
        $this->cover = $cover;
    }

    function setFechaCreacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    function setCreador($creador)
    {
        $this->creador = $creador;
    }

    function setGaleria($galeria)
    {
        $this->galeria = $galeria;
    }

    function setTags($tags)
    {
        $this->tags = $tags;
    }
}
