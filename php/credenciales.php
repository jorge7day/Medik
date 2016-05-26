<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include 'database.php';
//include 'paciente.php';
//include 'medico.php';

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
    }
    
    public function autentiq() {
        //Busca las credenciales del usuario introducido
        $row = $this->getCredenciales($this->usuario);
        
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
    
    private function getCredenciales($usuario) {
        include 'database.php';

       //Creando objeto de la base de datos
        $this->database = new Database();
        
        //Inicializando las conexiones a la base de datos
        $this->database->initialize();
        
        //Creando la sentencia de búsqueda de credenciales
        $sentencia = "select * from " . Database::TABLA_CREDENCIALES . " where " . self::COL_USUARIO . "=\"" . $usuario . "\"";
        
        //Ejecuta la sentencia SQL en la BD
        $res = $this->database->run($sentencia);
        
        //Comprueba que haya encontrado algo
        if($res != null) {
            $row = mysqli_fetch_assoc($res);
            //Retorna el primer resultado
            return $row;
        }
        else {
            return false;
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
}