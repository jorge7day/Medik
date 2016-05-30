<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Database.php';
//include 'paciente.php';
//include 'medico.php';

//use Database;

/**
 * Description of Credenciales
 *
 * @author Otoniel
 */
class Credenciales {
    
    //VARIABLES DE LAS CREDENCIALES
    public $usuario;
    private $contraseña;
    public $codigo_usuario;
    
    public $tipo;
    
    //Variable de conexion
    private $database;
    
    //NOMBRE DE LAS COLUMNAS EN LA BD
    CONST COL_USUARIO = "usuario";
    CONST COL_CODIGO_MEDICO = "codigo_medico";
    CONST COL_CODIGO_PACIENTE = "codigo_paciente";
    CONST COL_CONTRASEÑA = "contrasena";
    
    CONST TIPO_MEDICO = 1;
    CONST TIPO_PACIENTE = 2;
    
    function __construct($usuario, $contraseña) {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
        
        $this->database = new Database();
    }
    
    public function autentiq() {
        //Busca las credenciales del usuario introducido
        $row = $this->find($this->usuario);
        
        //Si se encontró el usuario
        if($row != false) {
            if($this->contraseña == $row[self::COL_CONTRASEÑA]) {
                //Como ya se sabe quién es en realidad, se identifica qué tipo de usuario está ingresando
                $this->setTipo($row);
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    /**
     * Busca en la BD al Usuario especificado
     * @param type $usuario
     * @return \Credenciales 
     */
    public static function find($usuario) {
        //include 'Database.php';
        
       //Creando objeto de la base de datos
        $database = new Database();
        
        //Creando la sentencia de búsqueda de credenciales por usuario
        $sentencia = "select * from " . Database::TABLA_CREDENCIALES 
                . " where " . (self::COL_USUARIO) . "=\"" . $usuario . "\"";
        
        //Ejecuta la sentencia SQL en la BD
        $res = $database->request($sentencia);
        
        //Comprueba que haya encontrado algo
        if($res != null) {
            echo "RES != NULL";
            $row = mysqli_fetch_assoc($res);
            //Retorna el primer resultado
            return $row;
        }
        else {
            echo 'RES ES NULL<br>';
            return null;
        }
    }
    
     /**
     * Busca en la BD al Usuario especificado
     * @param type $usuario
     * @return \Credenciales 
     */
    public static function exists($usuario) {
        //include 'Database.php';
        
       //Creando objeto de la base de datos
        $database = new Database();
        
        //Creando la sentencia de búsqueda de credenciales por usuario
        $sentencia = "select * from " . Database::TABLA_CREDENCIALES 
                . " where " . (self::COL_USUARIO) . "=\"" . $usuario . "\"";
        
        //Ejecuta la sentencia SQL en la BD
        $res = $database->request($sentencia);
        
        //Comprueba que haya encontrado algo
        if($res != null) {
            return $res;
        }
        else {
            return null;
        }
    }
    
    private function setTipo($row) {
        //Buscando el tipo de usuario
        if($row[self::COL_CODIGO_MEDICO] != NULL) {
            //Al saber que es de tipo MÉDICO, se guarda su tipo de usuario y su código
            $this->tipo = self::TIPO_MEDICO;
            $this->codigo_usuario = $row[self::COL_CODIGO_MEDICO];

//            echo "<br>Bienvenido Doctor \"" . $this->usuario . "\"<br>";
        }
        else {
            //Al saber que es de tipo PACIENTE, se guarda su tipo de usuario y su código
            $this->tipo = self::TIPO_PACIENTE;
            $this->codigo_usuario = $row[self::COL_CODIGO_PACIENTE];
            
//            echo "<br>Bienvenido Paciente \"" . $this->usuario . "\"<br>";
        }
    }
    
    /**
     * Para guardarse, debe haberse guardado ya al usuario
     * @return boolean Retorna TRUE si la operación finalizó con éxito, de lo contrario, devuelve FALSE
     */
    public function saveOnDB() {
        //include 'database.php';
        
        //Comprobando que no exista en la BD
        if(!self::exists($this->usuario)) {
            //Construyendo la sentencia
            $sentencia = "insert into " . Database::TABLA_CREDENCIALES . " values('"
                    . $this->usuario . "', "
                    . "null, " //Estas dos líneas se pueden modificar, añadiendo una comprobacion para guardar a los médicos
                    . $this->codigo_usuario . ", '" //Incluyendo esta línea
                    . $this->contraseña . "')";
            
            $database = new Database();
            
            return $database->execute($sentencia);
        }
        else {
            return false;
        }
    }
}