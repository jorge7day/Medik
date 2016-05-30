<?php
namespace procesos;
set_include_path("C:\\xampp\\htdocs\\medik\\php");

// Notificar solamente errores de ejecución
error_reporting(E_ERROR | E_PARSE);

//Se comprueba si se han pasado parámetros
if(isset($_POST["nombre_usuario"]) && isset($_POST["contraseña"])) {
    //Extraeremos la información de los parámetros usados por el usuario
    $usuario = $_POST["nombre_usuario"];
    $contraseña = hash("sha256", $_POST["contraseña"]);

    //Hacemos la inclusión de los algoritmos alojados en "credenciales.php"
    include 'credenciales.php';

    //Creamos una instancia de la tabla credenciales
    $credenciales = new \clases\Credenciales($usuario, $contraseña);

    //Hacemos la autenticación pertinente, y si no se pudo identificar, redirecciona al login
    if($credenciales->autentiq($usuario, $contraseña) == false) {
        //echo "Error en las credenciales";
    }
    else {
        //Iniciando la sesión
        initSession($credenciales->usuario, $credenciales->tipo, $credenciales->codigo_usuario);        
        header("Location: ../index.php");

    }

    //header("location: ../index.php");
    //header("location: medik/views/home.php");
}
    
function initSession($usuario, $tipo, $codigo_usuario) {
    //incluyendo las instrucciones de las credenciales:
    //include 'credenciales.php';
        
    //Iniciando la sesión en el servidor
    session_start();
        
    if($_SESSION["logged"] == null || $_SESSION["logged"] == false) {
        //Seteando las variables que permitirán saber si ha sido logueado el usuario
        $_SESSION["logged"] = true;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipo"] = $tipo;
        $_SESSION["codigo"] = $codigo_usuario;
            
        echo '<br> Sesión iniciada<br>';
            
    }
    else {
        echo '<br> Sesión existente<br>';
    }
}
require './login-view.php';
?>
