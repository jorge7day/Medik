<?php
namespace views;

error_reporting(E_ERROR | E_PARSE);

set_include_path("C:\\xampp\\htdocs\\medik\\php");
include 'seq.php';
?>
<!DOCTYPE html>
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
            //use clases\Credenciales;
            set_include_path("C:\\xampp\\htdocs\\medik\\php");

            include 'credenciales.php';
            
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
<!--            <table id="citastable" border="1" style="width:100%">
                <tr id="tr_tags">
                    <th id="first-child">Nombre Paciente</th>
                    <th>Sexo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Programar Cita</th>
                </tr>
                INFORMACION DE LOS PACIENTES
                <tr>
                    <td><a class="trcita" href="#">Eve asdf asdf</a></td>
                    <td>Femenino</td>
                    <td>10/10/1983</td>
                    <td>2215-4038</td>
                    <td><button onclick="crearCita('idpaciente')" class="btn_con_img"><img id="img_btn" src="../files/add_icon.png"></button></td>
                </tr>
                
            </table>-->
            
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
