<?php
namespace templates;
use clases\Database;

set_include_path("C:\\xampp\\htdocs\\medik\\php");

require 'Paciente.php';
require 'Database.php';
    
//Instanciando la base de datos
$database = new Database();
    
$result = $database->getPacientes();

    //Escribiendo tabla y encabezados
    echo '<table id="citastable" border="1" style="width:100%">' . PHP_EOL;
    echo '<tr id="tr_tags">' . PHP_EOL;
    echo '<th id="first-child">Nombre Paciente</th>' . PHP_EOL;
    echo '<th>Sexo</th>' . PHP_EOL;
    echo '<th>Fecha de Nacimiento</th>' . PHP_EOL;
    echo '<th>Teléfono</th>' . PHP_EOL;
    echo '<th>Programar Cita</th>' . PHP_EOL;
    echo '</tr>' . PHP_EOL;
        
//Si devuelve por lo menos 1 resultado
if($result) {
    //Escribiendo el contenido de cada paciente
    while($paciente = mysqli_fetch_assoc($result)) {
        //Extrayendo la fecha de nacimiento del paciente para ser formateada
        $date = date_create($paciente[\clases\Paciente::COL_F_NACIMIENTO]);
        
        echo '<tr>' . PHP_EOL;
        echo '<td><a class="trcita" href="#">' . $paciente[\clases\Paciente::COL_NOMBRE_PACIENTE] . '</a></td>' . PHP_EOL;
        echo '<td>' . ($paciente[\clases\Paciente::COL_SEXO_PACIENTE]==0?"Femenino":"Masculino") . '</td>' . PHP_EOL;
        echo '<td>' . date_format($date, "d/m/Y") . '</td>' . PHP_EOL; //Convertir la fecha en la BD en un Date de PHP
        echo '<td>' . ($paciente[\clases\Paciente::COL_TELEFONO_PACIENTE]!=null?$paciente[\clases\Paciente::COL_TELEFONO_PACIENTE]:"--") . '</td>' . PHP_EOL;
        echo '<td><button class="btn_con_img"><a href="new_cita.php?id=' . $paciente[\clases\Paciente::COL_CODIGO_PACIENTE] . '"><img id="img_btn" src="../files/add_icon.png"></a></button></td>' . PHP_EOL;
        //echo '<td><button onclick="crearCita(\'idpaciente\')" class="btn_con_img"><img id="img_btn" src="../files/add_icon.png"></button></td>' . PHP_EOL;
    }
        
    echo '</tr>';
    echo '</table>';
}
