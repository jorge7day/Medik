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
    
    CONST ACTIVO = 1;
    CONST INACTIVO = 0;
    
    CONST VISIBLE = 1;
    CONST INVISIBLE = 0;
    
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
    private $activo = self::COL_ACTIVO;
    private $visible = self::VISIBLE;
    
    //
    private $intervalo_cita;
    private $entrada_mañana;
    private $salida_mañana;
    private $entrada_tarde;
    private $salida_tarde;
    
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
        
        $this->activo = self::ACTIVO;
        $this->visible = self::VISIBLE;
        
        $this->intervalo_cita = new \DateInterval("30 min");
        $this->entrada_mañana = date_create("09:00:00");
        $this->salida_mañana = date_create("12:00:00");
        $this->entrada_tarde = date_create("13:00:00");
        $this->salida_tarde = date_create("20:00:00");
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
     * 
     */
    private function getNextTurno() {
        //include 'cita.php';
        $database = new Database();
        $fecha = null; //Variable que almacenará la fecha y hora de la cita
        $f_base = null;
        
        do {
            //Bandera que refleja si la hora y fecha están en el rango de trabajo del médico
            $isReady = true;
            
            //Obteniendo el objeto fecha del siguiente día
            $f_base = date_create();
            $f_base->add(\DateInterval::createFromDateString("1 day"));
            
            //GUardando el String de la fecha
            $temp = date_format($f_base, "Y-m-d");
            
            //Construyendo sentencia para obtener el último turno del siguiente día
            $sentencia = "select max(" . self::COL_F_CITA . ") from " . Database::TABLA_CITA 
                    . " where " . self::COL_F_CITA 
                    . " between '" . $temp . " " . self::entrada_mañana
                    . "' and '" . $temp . " " . self::salida_tarde . "'";

            //Se ejecuta la sentencia que extrae el último turno
            $res = $database->request($sentencia);
            
            //Ahora que se han obtenido todas las citas para ese día, hay que ver cuál es el turno más tardío
            if($res == null) {
                return null;
            }
            
            $row = mysqli_fetch_assoc($res);

            //$last_date = date_create_from_format("Y-m-d H:i:s", $row["max(" . self::COL_F_CITA . ")"]);

            //Buscando la posible hora y fecha de la nueva cita
            if($fecha == null) {
                $fecha = date_create_from_format("Y-m-d H:i:s", $row["max(" . self::COL_F_CITA . ")"]);
            }
            
            //Se le suman 30 minutos a la hora, para mover la cita
            //media hora más tarde
            $fecha->add(\DateInterval::createFromDateString("30 minute"));

            //Creando horarios de corte del servicio
            //$entrada_mañana = date_create($temp . " " . self::entrada_mañana);
            $salida_mañana = date_create($temp . " " . self::salida_mañana);
            $entrada_tarde = date_create($temp . " " . self::entrada_tarde);
            $salida_tarde = date_create($temp . " " . self::salida_tarde);

            //Haciendo las pruebas pertinentes:
            //Si la posible cita es más tarde que las 12:00 y más temprano 
            //que la 1:00, entonces queda en el almuerzo y no puede ser
            while($fecha >= $salida_mañana && $fecha < $entrada_tarde) {
                //QUEDA EN EL ALMUERZO
                //$isReady = false;
                $fecha->add(\DateInterval::createFromDateString("30 minute"));
            }

            //Probando si QUEDA PARA MAÑANA
            if($fecha >= $salida_tarde) {
                //Ya no es hora de atender
                $isReady = false;

                //Avanza un día en la fecha
                $f_base = date_create(date_format($f_base, ""), $object)
                $f_base->add(\DateInterval::createFromDateString("1 day"));
            }
            
        } while($isReady == false);
        
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
        $res = $this->getNextTurno();
        
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
                . $this->codigo_paciente . ", '"
                . $this->f_cita . "', '"
                . $this->motivo . "', '"
                . $this->diagnostico . "', "
                . $this->activo . ", "
                . $this->visible. ")";
        
        //echo "PASA";
        //echo $sentencia;

        //Si pasa las comprobaciones
        if(false) {
            return $database->execute($sentencia);
        }
        else {
            return false;
        }
    }
}
