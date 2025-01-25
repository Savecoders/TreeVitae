<?php

require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';
require_once 'models/dto/Actividad.php';

class ActividadRepository {
    private $con, $sql;

    public function __construct() {
        $this->con = DB::getInstance();
    }

    public function selectActivitiesByName($parametro, $iniciativa){ 
        try {
            $this->sql = "select * from actividades where nombre LIKE :nombre and iniciativa_id = :id and estado = 1";
            $stmt = $this->con->prepare($this->sql);
            $stmt->bindParam(":nombre", $parametro, PDO::PARAM_STR);
            $stmt->bindParam(":id", $iniciativa, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch(PDOException $e) {
            error_log("Error en selectActivitiesByName: " . $e->getMessage());
            return [];
        }
    }

    public function selectActivitiesByIniciativa($iniciativaID) {
        try {
            $this->sql = "SELECT * FROM actividades WHERE iniciativa_id = :iniciativaID AND estado = 1";
            $stmt = $this->con->prepare($this->sql);
            $stmt->bindParam(":iniciativaID", $iniciativaID, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch(PDOException $e) {
            error_log("Error en selectActivitiesByIniciativa: " . $e->getMessage());
            return [];
        }
    }

    public function selectOneActivity($id){
        try{
            $this->sql="select * from actividades where id=:id";
            $stmt = $this->con->prepare($this->sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();
            $res= $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }catch(PDOEXception $er){
            error_log("Error en selectOneActivity de ActividadesDAO ". $er->getMessage());
            return null;
        }
    }

    public function add($actividad){
        try{
            $this->sql="insert into actividades (iniciativa_id, nombre, descripcion, fecha_inicio,
            fecha_fin, direccion, otorga_certificado) values (:idInic, :nombre, :descp, :fechaIni, :fechaFin, :direc, :certfAct)";
            $stmt = $this->con->prepare($this->sql);
            $stmt->bindParam(":idInic",$actividad->getIdIniciativa(), PDO::PARAM_INT);
            $stmt->bindParam(":nombre",$actividad->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(":descp",$actividad->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindParam(":fechaIni",$actividad->getFechaInicio(), PDO::PARAM_STR);
            $stmt->bindParam(":fechaFin",$actividad->getFechaFin(), PDO::PARAM_STR);
            $stmt->bindParam(":direc",$actividad->getDireccion(), PDO::PARAM_STR);
            $stmt->bindParam(":certfAct",$actividad->getOtorgaCertificado(), PDO::PARAM_BOOL);

            $res= $stmt->execute(); 
            return $res;
        }catch(PDOEXception $e){
            error_log("Error en insert de Actividad Repository ". $e->getMessage());
            return false;
        }
    }

    public function update($actividad)
    {
        $this->sql= "UPDATE actividades 
                SET nombre = :nombre, 
                    descripcion = :descripcion, 
                    fecha_inicio = :fecha_inicio, 
                    fecha_fin = :fecha_fin, 
                    direccion = :direccion, 
                    otorga_certificado = :certificado 
                WHERE id = :id";

        $stmt = $this->con->prepare($this->sql);
        $stmt->bindValue(':nombre', $actividad->getNombre(), PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $actividad->getDescripcion(), PDO::PARAM_STR);
        $stmt->bindValue(':fecha_inicio', $actividad->getFechaInicio(), PDO::PARAM_STR);
        $stmt->bindValue(':fecha_fin', $actividad->getFechaFin(), PDO::PARAM_STR);
        $stmt->bindValue(':direccion', $actividad->getDireccion(), PDO::PARAM_STR);
        $stmt->bindValue(':certificado', $actividad->getOtorgaCertificado(), PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $actividad->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function logicalDelete($id){
        try{
            $sql="update actividades set estado=0 where id=:id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);

            $res= $stmt->execute();
            return $res;
        }catch(PDOEXception $e){
            error_log("Error en logicalDelete de ActividadesDAO ". $e->getMessage());
            return false;
        }
    }

    public function isUserAdmin($iniciativa_id, $usuario_id)
    {
        try {
            $sql = "SELECT * FROM usuarios_iniciativas_roles WHERE iniciativa_id = :iniciativa_id AND usuario_id = :usuario_id AND rol_id = 1";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->bindParam(':usuario_id', $usuario_id);

            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return count($res) > 0;
        } catch (PDOEXception $er) {
            error_log("Error en isUserAdmin de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }
}
?>