<?php
namespace clases;
use clases\Database;

//include 'database.php';
/**
 * Description of Receta
 *
 * @author Otoniel
 */
class Receta {
    
    //ATRIBUTOS DE UNA RECETA
    public $codigo_receta;
    public $codigo_cita;
    public $medicamento;
    public $dosis;
    
    //ATRIBUTOS DE LA TABLA
    CONST COL_CODIGO_RECETA = "codigo_receta";
    CONST COL_CODIGO_CITA = "codigo_cita";
    CONST COL_MEDICAMENTO = "medicamento";
    CONST COL_DOSIS = "dosis";
    
    function __construct($codigo_cita) {
        $this->codigo_cita = $codigo_cita;
    }

    /**
     * Hace una búsqueda de la receta conociendo su código
     * @param type $codigo_cita
     * @return mysqli_return Los resultados de la búsqueda o NULL si no encuentra nada
     */
    public static function find($codigo_cita) {
        //Creando el objeto de control sobre la base de datos y accediendo a ella
        $database = new Database();
        
        //Creando la sentencia de búsqueda
        $sentencia = "select * from " . Database::TABLA_RECETA 
                . " where " . self::COL_CODIGO_CITA . "=" . $codigo_cita;
        
        //Ejecutando la instrucción
        return $database->request($sentencia);
    }
    
    /**
     * Guarda la Receta actual en la BD
     * @return boolean
     */
    public function saveOnDB() {
        //Creando el objeto de control sobre la base de datos y accediendo a ella
        $database = new Database();
        
        //Creando una bandera que indique si la receta está lista para ser
        //almacenada en la BD
        $isReady = true;
        
        //Se comprueba que si se ha recetado un medicamento pero no su dosis
        if(strlen($this->medicamento) > 0) {
            if(strlen($this->dosis) <= 0) {
                //Se evita guardar la receta
                $isReady = false;
            }
        }
        
        //Creando la sentencia para guardar la receta
        $sentencia = "insert into " . Database::TABLA_RECETA
                . " values (null, "
                . $this->codigo_cita . ", '"
                . $this->medicamento . "', '"
                . $this->dosis . "')";
        
        //Si pasa las comprobaciones
        if($isReady) {
            return $database->execute($sentencia);
        }
        else {
            return false;
        }
    }
}
