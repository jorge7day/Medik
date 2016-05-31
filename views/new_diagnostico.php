<?php
namespace views;
    error_reporting(E_ERROR | E_PARSE);
    
    set_include_path("C:\\xampp\\htdocs\\medik\\php");
    include 'seq.php';
    require 'cita.php';
    require 'database.php';
    require 'receta.php';
    
    use clases\Cita;
    
    //Incluyendo la funcionalidad de añadir diagnóstico
    if(isset($_POST["diagnostico"]) && $_POST["diagnostico"] != "") {
        //Extrayendo valores
        $diagnostico = $_POST["diagnostico"];
        $medicamento = $_POST["medicamento"];
        $dosis = $_POST["dosis"];
        
        //Creando la variable que almacenará la cita
        $codigo_cita;

        //Si se accedió por la vía "legal", entonces debería haber una
        //variable "codigo_cita" almacenada en la sesión, 
        //Por lo que si está, continuará la ejecución, sino, no lo hará.
        if(!isset($_SESSION["codigo_cita"])) {
            return;
        }
        else {
            $codigo_cita = $_SESSION["codigo_cita"];
        }
        
        //Buscando la cita en la BD
        $cita = \clases\Cita::find($codigo_cita);
        
        //Guardando el diagnóstico
        //$cita->diagnostico = $diagnostico;
        $cita->setDiagnostico($diagnostico);
        
        //Después de configuar la cita, se procede a crear la receta
        $receta = new \clases\Receta($codigo_cita);
        
        $receta->medicamento = $medicamento;
        $receta->dosis = $dosis;
        
        //Se procede a guardar el diagnóstico
        $receta->saveOnDB();
        
        header("Location: gestor_citas.php");
    }
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Agregar Diagnostico - Medik</title>
        
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
                <p>Agregar Diagnostico</p>
            </div>
            
            <form action="new_diagnostico.php" id="formularioc" method="post">
                <?php
                    include 'templates/new_diagnostico_contenido.php';
                ?>
                
                <textarea name="diagnostico" placeholder="Agregar Diagnostico" required></textarea>
                <textarea name="medicamento" placeholder="Medicamento"></textarea>
                <input type="text" name="dosis" placeholder="Dosis" size="75">
                
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
