<?php
//Autor:Agurto Pincay Jose
if (!isset($_SESSION)) {
    session_start();
}
require_once 'models/repository/Actividad.repository.php';
require_once 'models/dto/Actividad.php';
require_once 'utils/redirectWithMessage.php';
require_once 'utils/cleanser.php';

class ActividadController
{
    private $model;

    public function __construct()
    {
        $this->model = new ActividadRepository();
    }

    public function viewall()
    {
        try{
            if (!isset($_SESSION['user'])) {
                header('Location: index.php?c=user&f=login_view');
                return;
            }
            $parametro = limpiar($_GET['id']??"");
            $actividades = $this->model->selectActivitiesByIniciativa($parametro);
            $title = 'Actividades de Iniciativa '. $parametro;
            $session_id = $_SESSION['user']['ID'] ?? 0;
            $isUserAdmin = $this->model->isUserAdmin($parametro, $session_id);
            require_once  VACTIVIDAD . 'viewall.php';

        }catch(Exception $e){
            error_log('Error en ActividadController@viewall: ' . $e->getMessage());
            redirectWithMessage(false, '', 'No podemos mostrar las actividades en estos momentos', 'index.php?c=iniciativa&f=viewall&id=' . $actividades);
        }
    }

    public function new() {
        $parametro = limpiar($_GET['ini'] ?? "");
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectWithMessage(false, '', 'Funcion no permitida', 'index.php?c=actividad&f=viewall&id=' . $parametro);
            return;
        }
        $validacion = $this->validarDatos($_POST);
        $errores = $validacion['errores'];
        $form_data = $validacion['form_data'];
    
        if (!empty($errores)) {
            $_SESSION['errores'] = $errores;
            $_SESSION['form_data'] = $form_data;
            header("Location: index.php?c=actividad&f=new_view&ini=$parametro");
            return;
        }
    
        $actividad = $this->populate($parametro, $form_data);
        $id = $this->model->add($actividad);
    
        if (!$id) {
            redirectWithMessage(false, '', 'Error al crear la actividad', "index.php?c=actividad&f=viewall&id=$parametro");
            return;
        }
        redirectWithMessage(true, 'Actividad creada con éxito', '', "index.php?c=actividad&f=viewall&id=$parametro");
    }
    
    private function validarDatos($datos) {
        $errores = [];
        $form_data = [];
    
        if (empty($datos['nombre']) || strlen($datos['nombre']) < 3 || !preg_match("/^[a-zA-ZÀ-ÿñÑáéíóúÁÉÍÓÚ ]+$/u", $datos['nombre'])) {
            $errores['nombre'] = "El nombre es requerido y debe tener al menos 3 caracteres válidos";
        }
        $form_data['nombre'] = limpiar($datos['nombre']) ?? "";
    
        if (empty($datos['descripcion']) || strlen($datos['descripcion']) < 10) {
            $errores['descripcion'] = "La descripción es requerida y debe tener al menos 10 caracteres.";
        }
        $form_data['descripcion'] = limpiar($datos['descripcion']) ?? "";
    
        $fecha_hoy = date('Y-m-d');

        if (empty($datos['fecha_inicio'])) {
            $errores['fecha_inicio'] = "La fecha de inicio es requerida.";
        } elseif ($datos['fecha_inicio'] < $fecha_hoy) {
            $errores['fecha_inicio'] = "La fecha de inicio no puede ser anterior a hoy.";
        }
        $form_data['fecha_inicio'] = limpiar($datos['fecha_inicio']) ?? "";

        if (empty($datos['fecha_cierre'])) {
            $errores['fecha_cierre'] = "La fecha de cierre es requerida.";
        } elseif (!empty($datos['fecha_inicio']) && $datos['fecha_cierre'] < $datos['fecha_inicio']) {
            $errores['fecha_cierre'] = "La fecha de cierre no puede ser anterior a la fecha de inicio.";
        }
        $form_data['fecha_cierre'] = limpiar($datos['fecha_cierre']) ?? "";

        if (empty($datos['direccion']) || strlen($datos['direccion']) < 10) {
            $errores['direccion'] = "La dirección es requerida y debe tener al menos 10 caracteres.";
        }
        $form_data['direccion'] = limpiar($datos['direccion']) ?? "";
    
        // $form_data['certificado'] = isset($datos['certificado']) ? true : false;
        $form_data['certificado'] = isset($datos['certificado']) && $datos['certificado'] == '1' ? true : false;
    
        return ['errores' => $errores, 'form_data' => $form_data];
    }
    
    public function new_view() {
        $parametro = limpiar($_GET['ini'] ?? "");
        $title = 'Registrar Actividad';
    
        $errores = $_SESSION['errores'] ?? [];
        $form_data = $_SESSION['form_data'] ?? [];
    
        unset($_SESSION['errores']);
        unset($_SESSION['form_data']);
    
        require_once VACTIVIDAD . 'new.php';
    }


    public function populate($parametro, $datos) {
        $actividad = new Actividad();
        $actividad->setIdIniciativa($parametro);
        $actividad->setNombre($datos['nombre']);
        $actividad->setDescripcion($datos['descripcion']);
        $actividad->setFechaInicio($datos['fecha_inicio']);
        $actividad->setFechaFin($datos['fecha_cierre']);
        $actividad->setDireccion($datos['direccion']);
        $actividad->setOtorgaCertificado($datos['certificado']);
    
        return $actividad;
    }

    public function update_view(){
        try{
            $parametro = limpiar($_GET['i'] ?? "");
            $idIni= limpiar($_GET['id'] ?? "");
            $title = 'Actualizar Actividad';
            $actividad = $this->model->selectOneActivity($parametro);
            require_once  VACTIVIDAD . 'update.php';
        }catch(Exception $e){
            redirectWithMessage(false, '', 'No podemos mostrar la actividad en estos momentos', 'index.php?c=iniciativa&f=viewall&id=' . $idIni);
        }
    }

    public function update() {
        try{
            $iniciativa_id = limpiar($_GET['id'] ?? "");

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                redirectWithMessage(false, '', 'Función no permitida', 'index.php?c=actividad&f=viewall&id=' . $iniciativa_id);
                exit;
            }
            $actividad_id = limpiar($_GET['i'] ?? "");
        
            $validacion = $this->validarDatos($_POST); 
            $errores = $validacion['errores'];
            $form_data = $validacion['form_data'];
        
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $_SESSION['form_data'] = $form_data;
                header("Location: index.php?c=actividad&f=update_view&i=$actividad_id&id=$iniciativa_id");
                exit;
            }
        
            $actividad = $this->populate($iniciativa_id, $form_data);
            $actividad->setId($actividad_id);
        
            $result = $this->model->update($actividad);
        
            if (!$result) {
                redirectWithMessage(
                    false, 
                    '', 
                    'Error al actualizar la actividad', 
                    "index.php?c=actividad&f=viewall&id=$iniciativa_id"
                );
            }
        
            redirectWithMessage(true, 'Actividad actualizada con exito', '', 'index.php?c=actividad&f=viewall&id=' . $iniciativa_id);
        }catch(Exception $e){
            redirectWithMessage(false, '', 'No podemos actualizar la actividad en estos momentos', 'index.php?c=actividad&f=viewall&id=' . $iniciativa_id);
        }

    }

    public function delete(){
        try{
            $parametro = limpiar($_GET['i'] ?? "");
            $id = limpiar($_GET['id'] ?? "");
            $eliminar = $this->model->logicalDelete($parametro);
            redirectWithMessage(true, 'Actividad eliminada con exito', '', 'index.php?c=actividad&f=viewall&id=' . $id);
        }catch(Exception $e){
            redirectWithMessage(false, '', 'No podemos eliminar la actividad en estos momentos', 'index.php?c=actividad&f=viewall&id=' . $id);
        }   
    }

    public function searchAjax() {
        try {
            $buscar = limpiar($_GET['b'] ?? ""); 
            $param = limpiar($_GET['id'] ?? ""); 
            $actividades = $this->model->selectActivitiesByName('%' . $buscar . '%', $param);
            echo json_encode($actividades); 
        } catch (Exception $e) {
            echo json_encode([]);
        }
    }
    
}
?>