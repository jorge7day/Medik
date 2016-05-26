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
class medico {
    //put your code here
    
    //Atributos propios del médico
    public $codigo_medico;
    public $nombre_medico;
    public $sexo_medico;
    public $telefono_medico;
    public $especialidad;
    
    //Nombres de las columnas del paciente en la base de datos
    CONST COL_CODIGO_MEDICO = "codigo_ medico";
    CONST COL_NOMBRE_MEDICO = "nombre_medico";
    CONST COL_SEXO_MEDICO = "sexo_medico";
    CONST COL_TELEFONO_MEDICO = "telefono_medico";
    CONST COL_ESPECIALIDAD = "especialidad";
    
    public function init($codigo_medico) {
        $database = new Database();
        
        $database->initialize();
        
        $sentencia = "select * from " . Database::TABLA_MEDICO . "where ". self::COL_CODIGO_MEDICO ."=" . $codigo_medico;
        
        $res = $database->run($sentencia);
        
        if($res) {
            $row = mysqli_fetch_assoc($res);
            
            $this->codigo_medico = $row[self::COL_CODIGO_PACIENTE];
            $this->nombre_medico = $res[self::COL_NOMBRE_MEDICO];
            $this->sexo_medico = $res[self::COL_SEXO_MEDICO];
            $this->telefono_medico = $res[self::COL_TELEFONO_MEDICO];
            $this->especialidad = $row[self::COL_ESPECIALIDAD];
        }
    }
}
