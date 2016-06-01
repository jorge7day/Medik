<?php
namespace clases;
//use clases\Cita as Cita;
//set_include_path("C:\\xampp\\htdocs\\medik\\php");
//include 'cita.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Notificar solamente errores de ejecución
error_reporting(E_ERROR | E_PARSE);

/**
 * Description of Database
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
    function __construct() {
        //comprobamos que no se haya inicializado anteriormente
        if($this->conexion == null) {
            //Haremos la conexión hacia la base de datos creando el objeto de conexion
            $this->conexion = mysqli_connect($this->servidor, $this->db_user, $this->db_contraseña, $this->db_name);
            
            //Se configura el conjunto de caracteres que se utilizarán
            mysqli_set_charset($this->conexion, "utf8");

            //Comprobamos que la conexión se haya realizado correctamente
            if (!$this->conexion) {
                die("Error de conexión: " . mysqli_error($this->conexion));
                echo "Error de conexión: " . mysqli_error($this->conexion);
                return false;
            }
            
        }

        return true;
    }
    
    /**
     * Ejecuta una consulta SQL en la base de datos
     * @param type $sentencia
     * @return mixed DEVUELVE los resultados del QUERY (por lo que hay que usar mysqli_fetch_assoc) o NULL
     */
    public function request($sentencia) {
        //Se ejecuta la sentencia sql enviada y se guardan los resultados
        $result = mysqli_query($this->conexion, $sentencia);

        //Si se ejecutó correctamente y hay por lo menos una fila de resultados
        if($result != false) {
            if($result->num_rows > 0) {
                //Se coloca el cursor de los resultados en el primer resultado
                mysqli_data_seek($result, 0);

                //Se develven los resultados
                return $result;
            }
        }
        return null;
    }

    /**
     * Ejecuta una sentencia DML (insert, update, delete)
     * @param string $sentencia
     * @return boolean TRUE si se ejecutó correctamete, de lo contrario FALSE
     */
    public function execute($sentencia) {
        //Se ejecuta la sentencia SQL
        return mysqli_query($this->conexion, $sentencia);
    }

    /**
     * Extrae los pacientes almacenados en la base de datos.
     * Para recorrerlo, puede extraerse uno por uno usando ejecutando
     * fetch_assoc() sobre el objeto
     * @return mysqli_result
     */
    public function getPacientes() {
        //Se prepara la sentencia SQL para extraer los pacientes
        $sentencia = "select * from " . self::TABLA_PACIENTE . " order by " . Paciente::COL_NOMBRE_PACIENTE;

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
            return false;
        }
    }
    
    /**
     * Extrae los médicos almacenados en la base de datos.
     * Para recorrerlo, puede extraerse uno por uno usando ejecutando
     * fetch_assoc() sobre el objeto
     * @return mysqli_result
     */
    public function getMedicos() {
        //Se prepara la sentencia SQL para extraer los pacientes
        $sentencia = "select * from " . self::TABLA_MEDICO;
        
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
            return false;
        }
    }
    
    /**
     * Extrae las citas almacenadas de un paciente en la base de datos.
     * Para recorrerlo, puede extraerse uno por uno usando ejecutando
     * fetch_assoc() sobre el objeto
     * @return mysqli_result
     */
    public function getCitas($codigo_paciente) {
        //set_include_path("C:\\xampp\\htdocs\\medik\\php");
        include 'Cita.php';

        //Se prepara la sentencia SQL para extraer los pacientes
        $sentencia = "select * from " . self::TABLA_CITA
                . " where " . Cita::COL_CODIGO_PACIENTE . "=" . $codigo_paciente;

        //Se ejecuta la sentencia sql enviada y se guardan los resultados
        $result = mysqli_query($this->conexion, $sentencia);

        //Si se ejecutó correctamente y hay por lo menos una fila de resultados
        if($result != false) {
            if($result->num_rows > 0) {
                //Se coloca el cursor de los resultados en el primer resultado
                mysqli_data_seek($result, 0);

                //Se develven los resultados
                return $result;
            }
        }

        return false;
    }

    /**
     * Extrae todas las citas de un medico.
     * Para recorrerlo, puede extraerse uno por uno usando ejecutando
     * fetch_assoc() sobre el objeto
     * @return mysqli_result
     */
    public function getCitasDeMedico($codigo_medico) {
        //require 'Cita.php';

        //Se prepara la sentencia SQL para extraer los pacientes
        $sentencia = "select * from " . self::TABLA_CITA .
                " where " . \clases\Cita::COL_CODIGO_MEDICO . "=" . $codigo_medico .
                " and " . \clases\Cita::COL_VISIBLE . "=" . \TRUE;

        //Se ejecuta la sentencia sql enviada y se guardan los resultados
        $result = mysqli_query($this->conexion, $sentencia);

        //Si se ejecutó correctamente y hay por lo menos una fila de resultados
        if($result != false) {
            if($result->num_rows > 0) {
                //Se coloca el cursor de los resultados en el primer resultado
                mysqli_data_seek($result, 0);

                //Se develven los resultados
                return $result;
            }
        }
        
        return null;
    }

    /**
     * Extrae las receta de una cita.
     * Para recorrerlo, puede extraerse uno por uno usando ejecutando
     * fetch_assoc() sobre el objeto
     * @return mysqli_result
     */
    public function getRecetas($codigo_cita) {
        //Se prepara la sentencia SQL para extraer los pacientes
        $sentencia = "select * from " . self::TABLA_RECETA
                . " where " . Receta::COL_CODIGO_CITA . "=" . $codigo_cita;

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


}
