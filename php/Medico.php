<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database.php';
/**
 * Description of medico
 *
 * @author Otoniel
 */
class Medico {
    //put your code here
    
    //Atributos propios del médico
    public $codigo_medico;
    public $nombre_medico = "";
    public $sexo_medico = null;
    public $telefono_medico = null;
    public $especialidad;
    
    //Nombres de las columnas del paciente en la base de datos
    CONST COL_CODIGO_MEDICO = "codigo_ medico";
    CONST COL_NOMBRE_MEDICO = "nombre_medico";
    CONST COL_SEXO_MEDICO = "sexo_medico";
    CONST COL_TELEFONO_MEDICO = "telefono_medico";
    CONST COL_ESPECIALIDAD = "especialidad";
    
    /**
     * Busca a un médico en la BD según su codigo
     * @param type $codigo_medico
     * @return \Medico
     */
    public function find($codigo_medico) {
        $database = new Database();
        
        $sentencia = "select * from " . Database::TABLA_MEDICO 
                . "where ". self::COL_CODIGO_MEDICO ."=" . $codigo_medico;
        
        $res = $database->request($sentencia);
        
        if($res) {
            $row = mysqli_fetch_assoc($res);
            
            $medico = new Medico();
            
            $medico->codigo_medico = $row[self::COL_CODIGO_PACIENTE];
            $medico->nombre_medico = $res[self::COL_NOMBRE_MEDICO];
            $medico->sexo_medico = $res[self::COL_SEXO_MEDICO];
            $medico->telefono_medico = $res[self::COL_TELEFONO_MEDICO];
            $medico->especialidad = $row[self::COL_ESPECIALIDAD];
            
            return $medico;
        }
        else {
            return null;
        }
    }
    
    /**
     * 
     * @return boolean
     */
    public function saveOnDB() {
        //Creando el objeto de control sobre la base de datos y accediendo a ella
        $database = new Database();
        
        //Creando una bandera que indique si la receta está lista para ser
        //almacenada en la BD
        $isReady = true;
        
        //Se comprueba que si se ha recetado un medicamento pero no su dosis
        if(strlen($this->nombre_medico) <= 0) {
            $isReady = false;
        }
        
        if($this->sexo_medico == null) {
            $isReady = false;
        }
        
        if($this->telefono_medico == null) {
            $isReady = false;
        }
        
        //Creando la sentencia para guardar la receta
        $sentencia = "insert into " . Database::TABLA_MEDICO
                . " values (null, '"
                . $this->nombre_medico . "', "
                . $this->sexo_medico . ", '"
                . $this->telefono_medico . "', '"
                . $this->especialidad . "')";
        
        //Si pasa las comprobaciones
        if($isReady) {
            return $database->execute($sentencia);
        }
        else {
            return false;
        }
    }
}
