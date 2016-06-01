<!DOCTYPE html>
<?php
    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    include 'seq.php';
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ver Pacientes - Medik</title>
        
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
                <p>Pacientes</p>
            </div>
            
            <?php
                //set_include_path("C:\\xampp\\htdocs\\medik\\views\\templates");
                include 'templates/index_contenido_medico.php';
                
            ?>
            
        </section>
        
        <footer style="display:none">
            Derechos Reservados &copy; 2016-2020
        </footer>
    </body>
</html>
