<?php

class Contacto{

    private $id, $idIniciativa, $idUsuario, $nombres, $apellidos, $email, $telefono, $prioridad, $asunto, $mensaje, $imagen;

    function __construct() {}

    //getters

    function getId(){
        return $this->id;
    }

    function getIdIniciativa(){
        return $this->idIniciativa;
    }

    function getIdUsuario(){
        return $this->idUsuario;
    }

    function getNombres(){
        return $this->nombres;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function getEmail(){
        return $this->email;
    }

    function getTelefono(){
        return $this->telefono;
    }

    function getPrioridad(){
        return $this->prioridad;
    }

    function getAsunto(){
        return $this->asunto;
    }

    function getMensaje(){
        return $this->mensaje;
    }

    function getImagen(){
        return $this->imagen;
    }

    //setters
    function setId($id){
        $this->id=$id;
    }

    function setIdIniciativa($idIniciativa){
        $this->idIniciativa=$idIniciativa;
    }

    function setIdUsuario($idUsuario){
        $this->idUsuario=$idUsurio;
    }

    function setNombres($nombres){
        $this->nombres=$nombres;
    }

    function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    function setEmail($email){
        $this->email=$email;
    }

    function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    function setPrioridad($prioridad){
        $this->prioridad=$prioridad;
    }

    function setAsunto($asunto){
        $this->asunto=$asunto;
    }

    function setMensaje($mensaje){
        $this->mensaje=$mensaje;
    }
    
    function setImagen($imagen){
        $this->imagen=$imagen;
    }
}