<?php

class Actividad {

    private $id, $iniciativaID, $nombre, $descripcion, $fechaInicio, $fechaFin, 
    $direccion, $otorgaCertificado, $fechaCreacionAct, $estado;

    function __construct() {}

    function getId() {
        return $this->id;
    }

    function getIdIniciativa() {
        return $this->iniciativaID;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getOtorgaCertificado() {
        return $this->otorgaCertificado;
    }

    function getFechaCreacionAct() {
        return $this->fechaCreacionAct;
    }

    function getEstado(){
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdIniciativa($idIniciativa) {
        $this->iniciativaID = $idIniciativa;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setOtorgaCertificado($otorgaCertificado) {
        $this->otorgaCertificado = $otorgaCertificado;
    }
    
    // Metodo set parametrizado
    public function __set($nombre, $valor) {
        // Verifica que la propiedad exista
        if (property_exists('Actividad', $nombre)) {
            $this->$nombre = $valor;
        } else {
            echo $nombre . " no existe.";
        }
    }

    // Metodo get parametrizado
    public function __get($nombre) {
        // Verifica que exista la propiedad
        if (property_exists('Actividad', $nombre)) {
            return $this->$nombre;
        }
        // Retorna null si no existe
        return NULL;
    }

}