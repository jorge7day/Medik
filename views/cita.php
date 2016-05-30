<!DOCTYPE html>
<?php
    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    include 'seq.php';
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ver Cita - Medik</title>
        
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
                <p>Detalles de la Cita</p>
            </div>
            
            
            <p><b class="label">Nombre del paciente:</b> Jose ksdljf sdf<p>
            <p><b class="label">Fecha:</b> J1-2-1234<p>
            <p><b class="label">Hora:</b> 12:00 AM<p>
            <p><b class="label">Diagnostico:</b> Jose ksdljf sdfa jksdhflskjdfh alksjdhf alksdjhf aljksdhf aljksdfh aljksd hfakljsd hflk ajsdhfk jashfkjahfgakjshdgkjlahsd ljkjahsd kljahdf kjasdhf ljakhdf akjsdhfaljkdfh alksdfh asldjfh ajsdf hajlkdh fasdf<p>
            <p><b class="label">Medicamento:</b>
                Acetaminofén</p>
            <p><b class="label">Dosis:</b> 1 dosis cada 12 horas</p>
            
        </section>
        
        
        
        <!--
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
        -->
        
        <footer style="display:none">
            Derechos Reservados &copy; 2016-2020
        </footer>
    </body>
</html>
