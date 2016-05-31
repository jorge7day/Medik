<?php
namespace views;

error_reporting(E_ERROR | E_PARSE);

set_include_path("C:\\xampp\\htdocs\\medik\\php");
include 'seq.php';
require 'Cita.php';
require 'Database.php';
//use clases\Database;

//Implementando operaciones de eliminación
if(isset($_GET["op"])) {
    $codigo_cita = $_GET["codigo_cita"];
    
    //Buscando la cita en la base de datos
    $cita = \clases\Cita::find($codigo_cita);

    //Si se econtró la cita
    if($cita != null) {
        
    }
    
    switch ($_GET["op"]) {
        case "+":
            
            break;
        
        case "x":
            //Si se encontró la cita
            if($cita != null) {
                //Se procede a eliminar
                $cita->setVisible(false);
            }
            break;
        
        default:
            echo "OPERACIÓN NO DEFINIDA";
    }
    
    header("Location: gestor_citas.php");
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestionar Cita - Medik</title>
        
        <link rel="stylesheet" href="../css/paciente_style.css">
        <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="../js/crearCita_controller.js"></script>
    </head>
    
    <body>
        <section id="inicio">
            <?php
            include 'templates/header.php';
            ?>
            
            <?php
            session_start();
            set_include_path("C:\\xampp\\htdocs\\medik\\php");

            include 'Credenciales.php';
            
            if($_SESSION["tipo"] == \clases\Credenciales::TIPO_MEDICO) {
                include 'templates/menu_medico.php';
            }
            else {
                include 'templates/menu_paciente.php';
            }
            ?>
        </section>
        
        
        <section id="citassection">
            <div id="parrafo">
                <p>Gestor de citas</p>
            </div>
            
            <?php
                //include '../php/Database.php';
                include 'templates/gestor_citas_contenido.php';
            ?>
            
        </section>
        
        
        
        <footer style="display:none">
            Derechos Reservados &copy; 2016-2020
        </footer>
    </body>
</html>
