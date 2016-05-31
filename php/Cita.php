<?php
namespace clases;

use clases\Database;
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
    
    //INFORMACIÓN DE CITAS
//    const tiempo_max = "01:00:00";
//    const entrada_mañana = "09:00:00";
//    const salida_mañana = "12:00:00";
//    const entrada_tarde = "13:00:00";
//    const salida_tarde = "20:00:00";

    //ATRIBUTOS DE UNA CITA
    public $codigo_cita;
    public $codigo_medico = -1;
    public $codigo_paciente = -1;
    public $f_cita = null;
    public $motivo = "";
    public $diagnostico = "";
    private $activo = True;
    private $visible = true;

    /**
     * Para construir una cita, se necesita del código del médico, del código del paciente y del motivo de su cita
     * @param type $codigo_medico
     * @param type $codigo_paciente
     * @param type $motivo
     */
    function __construct($codigo_paciente, $motivo) {
        $this->codigo_paciente = $codigo_paciente;
        $this->motivo = $motivo;
        
        $this->codigo_medico = 1;
        
        $this->activo = TRUE;
        $this->visible = TRUE;
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
    public function setActive($activo) {
        $database = new Database();
        
        $sentencia = "update " . Database::TABLA_CITA .
                " set " . self::COL_ACTIVO . "=" . ($activo?"1":"0") . 
                " where " . self::COL_CODIGO_CITA . "=" . $this->codigo_cita;
        
        return $database->execute($sentencia);
    }
    
    /**
     * 
     * @param boolean $visible
     */
    public function setVisible($visible) {
        $database = new Database();
        
        //Se crea la sentencia para activar la cita
        $sentencia = "update " . Database::TABLA_CITA .
                " set " . self::COL_VISIBLE . "=" . ($visible?"1":"0") . 
                " where " . self::COL_CODIGO_CITA . "=" . $this->codigo_cita;
        
        return $database->execute($sentencia);
    }
    
    /**
     * 
     */
    private function getNextTurno() {
        //include 'cita.php';
        $database = new Database();
        //$fecha = null; //Variable que almacenará la fecha y hora de la cita
        //$f_base = null;

        //Construyendo sentencia para obtener el último turno del siguiente día
        $sentencia = "select max(" . self::COL_F_CITA . ") from " . Database::TABLA_CITA;

        //Se ejecuta la sentencia que extrae el último turno
        $res = $database->request($sentencia);

        //Ahora que se han obtenido todas las citas para ese día, hay que ver cuál es el turno más tardío
        if($res == null) {
            return null;
        }

        $row = mysqli_fetch_assoc($res);

        $fecha = date_create_from_format("Y-m-d H:i:s", $row["max(" . self::COL_F_CITA . ")"]);
        //////////////////////////////////////////

        date_modify($fecha, "+30 min");

        ////////////////////////
        $almuerzo = date_create(date_format($fecha, "Y-m-d H:i:s"));
        $entrada_tarde = date_create(date_format($fecha, "Y-m-d H:i:s"));

        date_modify($almuerzo, "noon");
        date_modify($entrada_tarde, "noon + 1 hour");
        /////////////////////////
        $diff1 = date_diff($almuerzo, $fecha);
        $diff2 = date_diff($entrada_tarde, $fecha);
        //$diff2 = date_diff($fecha, $entrada_tarde);

        $dr1 = doubleval($diff1->format("%r%h.%i"));
        $dr2 = doubleval($diff2->format("%r%h.%i"));

        while($dr1 >= 0 && $dr2 < 0) {
            date_modify($fecha, "+30 min");

//            $diff1 = date_diff($fecha, $almuerzo);
//            $diff2 = date_diff($fecha, $entrada_tarde);
            $diff1 = date_diff($almuerzo, $fecha);
            $diff2 = date_diff($entrada_tarde, $fecha);

            $dr1 = doubleval($diff1->format("%r%h.%i"));
            $dr2 = doubleval($diff2->format("%r%h.%i"));
        }

        ///////////////////////////////////////////////
        $salida = date_create(date_format($fecha, "Y-m-d H:i:s"));
        date_modify($salida, "noon + 6 hours");

        $diff3 = date_diff($fecha, $salida);

        if(doubleval($diff3->format("%r%h.%i")) < 0.3) {
            date_modify($fecha, "+1 day");
            
            date_time_set($fecha, 9, 0, 0);
        }
        
        return $fecha;
    }
    
    /**
     * Intenta guardar los datos de la instancia de esta clase en la BD como un nuevo registro
     * @return boolean
     */
    public function saveOnDB() {
        include 'Database.php';

        //Creando el objeto de control sobre la base de datos y accediendo a ella
        $database = new Database();
        
        //Obteniendo siguiente turno libre
        $this->f_cita = $this->getNextTurno();
        
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
        $sentencia = "insert into " . Database::TABLA_CITA . " values (null, "
                . $this->codigo_medico . ", "
                . $this->codigo_paciente . ", '"
                . date_format($this->f_cita, "Y-m-d H:i:s") . "', '"
                . $this->motivo . "', '"
                . $this->diagnostico . "', "
                . $this->activo . ", "
                . $this->visible. ")";
        
        //echo "PASA";
        //echo $sentencia;

        //Si pasa las comprobaciones
        if($isReady) {
            return $database->execute($sentencia);
        }
        else {
            return false;
        }
    }

    /**
     * Hace una búsqueda de la cita proporcionada en la base de datos
     * @param int $codigo_cita
     * @return \Cita Devuelve el resultado de la BD, si lo encuentra, sino, NULL
     */
    public static function find($codigo_cita) {
        $database = new Database();

        //Creando sentencia de búsqueda
        $sentencia = "select * from " . Database::TABLA_CITA
                . " where " . self::COL_CODIGO_CITA . "=" . $codigo_cita;
        
        $result = $database->request($sentencia);
        
        if($result != null) {
            $row = mysqli_fetch_assoc($result);
            
            $cita = new Cita($row[self::COL_CODIGO_PACIENTE], $row[self::COL_MOTIVO]);
            
            $cita->codigo_cita = $row[self::COL_CODIGO_CITA];
            $cita->f_cita = $row[self::COL_F_CITA];
            $cita->codigo_medico = $row[self::COL_CODIGO_MEDICO];
            $cita->diagnostico = $row[self::COL_DIAGNOSTICO];
            $cita->activo = $row[self::COL_ACTIVO];
            $cita->visible = $row[self::COL_VISIBLE];
            
            return $cita;
        }
    }
    
    public function setDiagnostico($diagnostico) {
        //Creando la conexión hacia la BD
        $database = new Database();
        
        //Creando la sentencia para insertar el diagnóstico
        //a la cita correcta
        $sentencia = "update " . Database::TABLA_CITA
                . " set " . Cita::COL_DIAGNOSTICO . "='" . $diagnostico . "'"
                . " where " . Cita::COL_CODIGO_CITA . "=" . $this->codigo_cita;
        
        if($database->execute($sentencia)) {
            $this->diagnostico = $diagnostico;
        }
        
        //Cuando el diagnóstico es ejecutado, no tiene sentido que la cita 
        //siga apareciendo en los listados, por lo que se procede a ocultarla
        $this->setVisible(false);
        $this->setActive(false);
    }
}
