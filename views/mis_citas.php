
<!DOCTYPE html>
<?php
    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    include 'seq.php';
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Mis Citas - Medik</title>
        
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
                <p>Mis citas</p>
            </div>
            <section id="opciones">
                <a id="btn_cnc" class="btn_azul" href="new_cita.php">Nueva Cita</a>
            </section>
            
            
            <table id="citastable" border="1" style="width:100%">
                <tr id="tr_tags">
                    <th id="first-child">Nombre Paciente</th>
                    <th>Fecha</th>
                    <th id="last-child">Hora</th>
                    <th>Diagnostico</th>
                </tr>
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>Jackson asdf asd asd</td>
                </tr>
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>Jackson asdf asd asd</td>
                </tr>
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>Jackson asdf asd asd</td>
                </tr>
                <tr>
                    <td><a class="trcita" href="cita.php?idcita=234">Eve asdf asdf</a></td>
                    <td>94-45-1234</td>
                    <td>12:30 AM</td>
                    <td>-</td>
                </tr>
                
            </table>
            
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
