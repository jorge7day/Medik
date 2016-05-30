<!DOCTYPE html>
<?php
    error_reporting(E_ERROR | E_PARSE);

    include "./php/seq.php";
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Medik</title>
        
        <link rel="stylesheet" href="css/paciente_style.css">
        <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="js/crearCita_controller.js"></script>
    </head>
    
    <body>
        <section id="inicio">
            <?php
            include 'views/templates/header.php';
            ?>

            <?php
                error_reporting(E_ERROR | E_PARSE);

                session_start();
                set_include_path("C:\\xampp\\htdocs\\medik\\php");

                include 'Credenciales.php';

                if($_SESSION["tipo"] == \clases\Credenciales::TIPO_MEDICO) {
                    include 'views/templates/menu_medico.php';
                }
                else {
                    include 'views/templates/menu_paciente.php';
                }
            ?>
            
            <div id="parrafo">
                <p>Bienvenido</p>
            </div>
            
            <?php 
            error_reporting(E_ERROR | E_PARSE);

                session_start();

                include '/medik/php/Credenciales.php';

                if($_SESSION["tipo"] == \clases\Credenciales::TIPO_PACIENTE) {
                    include 'views/templates/index_contenido_paciente.php';
                }
                else {
                    //
                }
            ?>
        </section>
        
        <section id="form" style="display:none">
            <form action="" id="formulario">
                
                <p id="n2"> Crea tu cita</p>
                <input type="text" name="Nombre" placeholder="Nombre" required>
                <input type="number" name="edad" min="0" max="120" placeholder="Edad" required>
                <input type="text" name="ID" placeholder="Id de seguro" required>
                
                <div style="">
                    <input type="submit" id="enviar_btn">
                    <input type="button" id="cancelar_btn" onclick="mostrarFormulario()" value="Cancelar">
                </div>
            </form>
            
        </section>
        
        <footer style="display:none">
            Derechos Reservados &copy; 2016-2020
        </footer>
    </body>
</html>
