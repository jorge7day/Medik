<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Notificar solamente errores de ejecución
error_reporting(E_ERROR | E_PARSE);

/**
 * Description of database
 *
 * @author Otoniel
 */
class Database {
    //put your code here
    
    
    //CREANDO VARIABLES DE CONEXIÓN
    private $servidor = "127.0.0.1";
    private $db_user = "medik_user";
    private $db_contraseña = "medik";
    private $db_name = "medik";
    
    public $conexion = null;
    
    //CREANDO VARIABLES DE LA BASE DE DATOS
    const TABLA_PACIENTE = "Paciente";
    const TABLA_CREDENCIALES = "Credenciales";
    const TABLA_MEDICO = "Medico";
    const TABLA_CITA = "Cita";
    const TABLA_RECETA = "Receta";
    
    /**
     * Inicializa la conexión a la base de datos
     * @return boolean
     */
    public function initialize() {
        //comprobamos que no se haya inicializado anteriormente
        if($this->conexion == null) {
            //Haremos la conexión hacia la base de datos creando el objeto de conexion
            $this->conexion = mysqli_connect($this->servidor, $this->db_user, $this->db_contraseña, $this->db_name);
            
            //Seleccionando base de datos de credenciales
            if (!$this->conexion) {
                die("Error de conexión: " . mysqli_error($this->conexion));
                return false;
            }
            
        }

        return true;
    }
    
    /**
     * Ejecuta una sentencia SQL en la base de datos
     * @param type $sentencia
     * @return type
     */
    public function run($sentencia) {
        //Se ejecuta la sentencia sql enviada y se guardan los resultados
        $result = mysqli_query($this->conexion, $sentencia);

        //Si se ejecutó correctamente y hay por lo menos una fila de resultados
        if($result->num_rows > 0) {
            //Se coloca el cursor de los resultados en el primer resultado
            mysqli_data_seek($result, 0);

            //Se develven los resultados
            return $result;
        }
        else {
            return null;
        }
    }
    
    public function getPacientes() {
        
    }
    
    public function getMedicos() {
        
    }
}
