<!DOCTYPE html>
<?php
    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    include 'seq.php';
?>
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
                <p>Gestor de citas</p>
            </div>
            
            <table id="citastable" border="1" style="width:100%">
                <tr id="tr_tags">
                    <th id="first-child">Nombre Paciente</th>
                    <th>Fecha</th>
                    <th id="last-child">Hora</th>
                    <th>Diagnostico</th>
                    <th>Eliminar</th>
                </tr>
                <tr>
                    <td>Eve asdf asdf</td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>Jackson asdf asd asd</td>
                    <td><button onclick="eliminarCita(id)" class="btn_con_img"><img id="img_btn" src="../files/borrar_icon.png"></button></td>
                </tr>
                
                
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td><button onclick="agregarDiagnostico('idCita')" class="btn_con_img"><img id="img_btn" src="../files/add_icon.png"></button></td>
                    <td><button onclick="eliminarCita(id)" class="btn_con_img"><img id="img_btn" src="../files/borrar_icon.png"></button></td>
                </tr>
                
            </table>
            
        </section>
        
        
        
        <footer style="display:none">
            Derechos Reservados &copy; 2016-2020
        </footer>
    </body>
</html>
