<?php
namespace views;
use clases\Credenciales;

session_start();

    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    include 'seq.php';


    //Verificando si el usuario ha intentado crear la cita ya
    if(isset($_POST["motivo"])) {
        include 'cita.php';

        $cita = new \clases\Cita($_SESSION["codigo"], $_POST["motivo"]);

        $cita->saveOnDB();

        header("location: mis_citas.php");
    }
    else {
        //echo "El motivo ESTÁ vacío";
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
            include 'templates/header.php';
            ?>
            
            <?php
            session_start();
            
            include '../php/credenciales.php';
            
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
