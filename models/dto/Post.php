<?php
// Autor: Vivanco Garcia Angel Enrique
class Post {

    private $id, $iniciativa_id, $autor_id, $titulo, $subtitulo, $contenido, $permite_comentarios, $fecha_publicacion;

    function __construct() {}

    // Getters
    function getId() {
        return $this->id;
    }

    function getIniciativaId() {
        return $this->iniciativa_id;
    }

    function getAutorId() {
        return $this->autor_id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getSubtitulo() {
        return $this->subtitulo;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getPermiteComentarios() {
        return $this->permite_comentarios;
    }

    function getFechaPublicacion() {
        return $this->fecha_publicacion;
    }

    // Setters
    function setId($id) {
        $this->id = $id;
    }

    function setIniciativaId($iniciativa_id) {
        $this->iniciativa_id = $iniciativa_id;
    }

    function setAutorId($autor_id) {
        $this->autor_id = $autor_id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSubtitulo($subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setPermiteComentarios($permite_comentarios) {
        $this->permite_comentarios = $permite_comentarios;
    }

    function setFechaPublicacion($fecha_publicacion) {
        $this->fecha_publicacion = $fecha_publicacion;
    }
}
