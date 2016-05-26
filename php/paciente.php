<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database.php';

class Paciente {
    
    //Atributos pertenecientes al paciente
    public $codigo_paciente;
    public $nombre_paciente;
    public $sexo_paciente;
    public $f_nacimiento;
    public $telefono_paciente;
    
    //Nombres de las columnas del paciente en la base de datos
    CONST COL_CODIGO_PACIENTE = "codigo_paciente";
    CONST COL_NOMBRE_PACIENTE = "nombre_paciente";
    CONST COL_SEXO_PACIENTE = "sexo_paciente";
    CONST COL_F_NACIMIENTO= "f_nacimiento";
    CONST COL_TELEFONO_PACIENTE = "telefono_paciente";
    
    
    public function init($codigo_paciente) {
        $database = new Database();
        
        $database->initialize();
        
        $sentencia = "select * from " . Database::TABLA_PACIENTE . "where ". self::COL_CODIGO_PACIENTE ."=" . $codigo_paciente;
        
        $res = $database->run($sentencia);
        
        if($res) {
            $row = mysqli_fetch_assoc($res);
            
            $this->codigo_paciente = $row[self::COL_CODIGO_PACIENTE];
            $this->nombre_paciente = $res[self::COL_NOMBRE_PACIENTE];
            $this->sexo_paciente = $res[self::COL_SEXO_PACIENTE];
            $this->f_nacimiento = $res[self::COL_F_NACIMIENTO];
            $this->telefono_paciente = $res[self::COL_TELEFONO_PACIENTE];
        }
    }
}
