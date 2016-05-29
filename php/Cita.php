<?php
include 'database.php';
/**
 * Description of Cita
 *
 * @author Otoniel
 */
class Cita {
    
    //NOMBRE DE LAS COLUMNAS DE LA TABLA CITA
    CONST COL_CODIGO_CITA = "codigo_cita";
    CONST COL_CODIGO_MEDICO = "codigo_medico";
    CONST COL_CODIGO_PACIENTE = "codigo_paciente";
    CONST COL_F_CITA = "f_cita";
    CONST COL_MOTIVO = "motivo";
    CONST COL_DIAGNOSTICO = "diagnostico";
    CONST COL_ACTIVO = "activo";
    CONST COL_VISIBLE = "visible";
    
    CONST ACTIVO = 1;
    CONST INACTIVO = 0;
    
    CONST VISIBLE = 1;
    CONST INVISIBLE = 0;
    
    //ATRIBUTOS DE UNA CITA
    public $codigo_cita;
    public $codigo_medico = -1;
    public $codigo_paciente = -1;
    public $f_cita = null;
    public $motivo = "";
    public $diagnostico = "";
    private $activo = self::COL_ACTIVO;
    private $visible = self::VISIBLE;
    
    /**
     * Para construir una cita, se necesita del código del médico, del código del paciente y del motivo de su cita
     * @param type $codigo_medico
     * @param type $codigo_paciente
     * @param type $motivo
     */
    function __construct($codigo_medico, $codigo_paciente, $motivo) {
        $this->codigo_medico = $codigo_medico;
        $this->codigo_paciente = $codigo_paciente;
        $this->motivo = $motivo;
    }
    
    function isActivo() {
        return $this->activo;
    }

    function isVisible() {
        return $this->visible;
    }

    
    /**
     * 
     * @param boolean $activo
     */
    public function setState($activo) {
        $database = new Database();
        
        //Si el usuario decide dejar el estado de la cita en Activa:
        if($activo) {
            //Se crea la sentencia para activar la cita
            $sentencia = "update " . Database::TABLA_CITA 
                    . " set " . self::COL_ACTIVO . "=" . self::ACTIVO 
                    . " where " . self::COL_CODIGO_CITA . "=" . $this->codigo_cita;
            
            //Ejecuta la sentencia
            return $database->execute($sentencia);
        }
    }
    
    /**
     * 
     * @param boolean $visible
     */
    public function setVisible($visible) {
        $database = new Database();
        
        //Creando la sentencia a ejecutar
        $sentencia = "";
        
        if($visible) {
            //Se crea la sentencia para activar la cita
            $sentencia = "update " . Database::TABLA_CITA 
                    . " set " . self::COL_VISIBLE . "=" . self::VISIBLE 
                    . " where " . self::COL_CODIGO_CITA . "=" . $this->codigo_cita;
        }
        else {
            //Se crea la sentencia para activar la cita
            $sentencia = "update " . Database::TABLA_CITA 
                    . " set " . self::COL_VISIBLE . "=" . self::INVISIBLE 
                    . " where " . self::COL_CODIGO_CITA . "=" . $this->codigo_cita;
        }
        
        return $database->execute($sentencia);
    }
    
    /**
     * Intenta guardar los datos de la instancia de esta clase en la BD como un nuevo registro
     * @return boolean
     */
    public function saveOnDB() {
        //Creando el objeto de control sobre la base de datos y accediendo a ella
        $database = new Database();
        
        //Creando una bandera que indique si la receta está lista para ser
        //almacenada en la BD
        $isReady = true;
        
        //Haciendo las validaciones
        if($this->codigo_medico <= 0) {
            $isReady = false;
        }
        
        if($this->codigo_paciente <= 0) {
            $isReady = false;
        }
        
        if($this->f_cita == null) {
            $isReady = false;
        }
        
        if(strlen($this->motivo) <= 0) {
            $isReady = false;
        }
        
        
        //Creando la sentencia para guardar la receta
        $sentencia = "insert into " . Database::TABLA_CITA
                . " values (null, "
                . $this->codigo_medico . ", "
                . $this->codigo_paciente . ", "
                . $this->f_cita . ", "
                . $this->motivo . ", '"
                . $this->diagnostico . "', "
                . $this->activo . ", "
                . $this->visible. ")";
        
        //Si pasa las comprobaciones
        if($isReady) {
            return $database->execute($sentencia);
        }
        else {
            return false;
        }
    }
}
