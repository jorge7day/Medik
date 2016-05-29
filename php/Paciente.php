<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//use Database;
//include 'Database.php';
    
class Paciente {
    
    
    //Nombres de las columnas del paciente en la base de datos
    CONST COL_CODIGO_PACIENTE = "codigo_paciente";
    CONST COL_NOMBRE_PACIENTE = "nombre_paciente";
    CONST COL_SEXO_PACIENTE = "sexo_paciente";
    CONST COL_F_NACIMIENTO= "f_nacimiento";
    CONST COL_TELEFONO_PACIENTE = "telefono_paciente";
    
    CONST SEXO_M = 1;
    CONST SEXO_F = 0;
    
    //Atributos pertenecientes al paciente
    public $codigo_paciente;
    public $nombre_paciente = "";
    public $sexo_paciente = self::SEXO_M;
    public $f_nacimiento = null;
    public $telefono_paciente = null;
    
    /**
     * Busca en la BD al paciente con el código siguiente
     * @param int $codigo_paciente
     * @return \Paciente
     */
    public static function findById($codigo_paciente) {
        //Se hace una instancia de la base de datos
        $database = new Database();
            
        //Crear una sentencia para buscar al usuario y extraer su información de la BD
        $sentencia = "select * from " . Database::TABLA_PACIENTE
                . " where ". self::COL_CODIGO_PACIENTE ."=" . $codigo_paciente;
            
        //Ejecuta la consulta
        $res = $database->request($sentencia);
            
        //Si se devuelven resultados distintos de cero
        if($res != null) {
            //Se convierten los resultados en un array simbólico
            $row = mysqli_fetch_assoc($res);
            
            $paciente = new Paciente();
            
            $paciente->codigo_paciente = $row[self::COL_CODIGO_PACIENTE];
            $paciente->nombre_paciente = $res[self::COL_NOMBRE_PACIENTE];
            $paciente->sexo_paciente = $res[self::COL_SEXO_PACIENTE];
            $paciente->f_nacimiento = $res[self::COL_F_NACIMIENTO];
            $paciente->telefono_paciente = $res[self::COL_TELEFONO_PACIENTE];
            
            return $paciente;
        }
        else {
            return null;
        }
    }
    
    /**
     * Busca en la BD al paciente con el código siguiente
     * @param int $nombre_paciente
     * @return \Paciente Devuelve el objeto PACIENTE o NULL
     */
    public static function findByName($nombre_paciente) {
        //Se hace una instancia de la base de datos
        $database = new Database();
            
        //Crear una sentencia para buscar al usuario y extraer su información de la BD
        $sentencia = "select * from " . Database::TABLA_PACIENTE
                . " where " . self::COL_NOMBRE_PACIENTE . "='" . $nombre_paciente . "'";
        
        //Ejecuta la consulta
        $res = $database->request($sentencia);
            
        //Si se devuelven resultados distintos de cero
        if($res != null) {
            //Se convierten los resultados en un array simbólico
            $row = mysqli_fetch_assoc($res);
            
            $paciente = new Paciente();
            
            $paciente->codigo_paciente = $row[self::COL_CODIGO_PACIENTE];
            $paciente->nombre_paciente = $row[self::COL_NOMBRE_PACIENTE];
            $paciente->sexo_paciente = $row[self::COL_SEXO_PACIENTE];
            $paciente->f_nacimiento = $row[self::COL_F_NACIMIENTO];
            $paciente->telefono_paciente = $row[self::COL_TELEFONO_PACIENTE];
            
            return $paciente;
        }
        else {
            return null;
        }
    }
    
    public function saveOnDB() {
        //Se hace una instancia de la base de datos
        $database = new Database();
        
        //Creando una bandera que controle si los datos están validados
        $isReady = true;
        
        //HACIENDO LAS VALIDACIONES DE LOS DATOS
        if(strlen($this->nombre_paciente) <= 0) {
            $isReady = false;
        }
        
        if($this->f_nacimiento == NULL) {
            $isReady = false;
        }
        
        //Creando la sentencia para guardar el paciente
        $sentencia = "insert into " . Database::TABLA_PACIENTE . " values(null, '"
                . $this->nombre_paciente . "', "
                . $this->sexo_paciente . ", '"
                . date_format($this->f_nacimiento, 'Y-m-d H:i:s') . "', '"
                . $this->telefono_paciente . "')";
        
        if($isReady) {
            //Ejecutando la sentencia
            return $database->execute($sentencia);
        }
    }
        
    /**
     * Comprueba que exista un paciente basado en su código
     * @param type $codigo_paciente
     * @return Boolean 
     */
    public function exists($codigo_paciente) {
        //Se hace una instancia de la base de datos
        $database = new Database();    
        
        //Preparando sentencia de búsqueda
        $sentencia = "select * from " . Database::TABLA_PACIENTE
                . " where " . self::COL_CODIGO_PACIENTE . "=" . $codigo_paciente;
        
        //Ejecuta la consulta a la BD y devuelve los resultados
        return $database->request($sentencia);
    }
}