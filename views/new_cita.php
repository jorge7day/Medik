<?php
namespace views;
//use clases\Credenciales;
use clases\Paciente;

include '../php/credenciales.php';


session_start();

    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    require 'seq.php';


    //Verificando si el usuario ha intentado crear la cita ya
    if(isset($_POST["motivo"])) {
        require 'Cita.php';
        
        $id;
        
        if(isset($_SESSION["id"]) && $_SESSION["tipo"] == \clases\Credenciales::TIPO_MEDICO) {
            $id = $_SESSION["id"];
        }
        else {
            $id = $_SESSION["codigo"];
        }

        $cita = new \clases\Cita($id, $_POST["motivo"]);

        $cita->saveOnDB();
        
        if($_SESSION["tipo"] == \clases\Credenciales::TIPO_PACIENTE) {
            header("location: mis_citas.php");
        }
        else {
            header("location: pacientes.php");

        }
        
        unset($_SESSION["id"]);
    }
    //Si no se pasaron parámetros por POST, se prueba si fueron pasados por GET
    elseif(isset($_GET["id"])) {
        $_SESSION["id"] = intval($_GET["id"]);
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Crear Cita - Medik</title>
        
        <link rel="stylesheet" href="../css/paciente_style.css">
        <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="../js/crearCita_controller.js"></script>
    </head>
    
    <body>
        <section id="inicio">
            <?php
            require 'templates/header.php';
            ?>
            
            <?php
            session_start();
            set_include_path("C:\\xampp\\htdocs\\medik\\php");
            use clases\Credenciales;

            
            if($_SESSION["tipo"] == Credenciales::TIPO_MEDICO) {
                include 'templates/menu_medico.php';
            }
            else {
                include 'templates/menu_paciente.php';
            }
            ?>
        </section>
        
        
        <section id="citassection">
            <div id="parrafo">
                <p>Crear Cita</p>
            </div>
            
            <form action="new_cita.php" id="formularioc" method="post">
<!--				<input type="text" name="Nombre" placeholder="Nombre" required>-->
<!--				<input type="number" name="edad" min="0" max="120" placeholder="Edad" required>-->
                <input type="textarea" name="motivo" placeholder="Motivo" required>
                
                <div style="">
                    <input type="submit" id="enviar_btn">
                    <input type="button" id="cancelar_btn" onclick="javascript:window.history.go(-1)" value="Cancelar">
                </div>
            </form>
            
        </section>        
        <footer style="display:none">
            Derechos Reservados &copy; 2016-2020
        </footer>
    </body>
</html>
