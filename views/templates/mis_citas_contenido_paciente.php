<?php
namespace templates;

set_include_path("C:\\xampp\\htdocs\\medik\\php");
use clases\Cita;
use clases\Receta;

include 'paciente.php';
include 'receta.php';

session_start();

echo "<table id=\"citastable\" border=\"1\" style=\"width:100%\">" . PHP_EOL;
    echo "<tr id=\"tr_tags\">" . PHP_EOL;
        echo "<th >Nombre Paciente</th>" . PHP_EOL;
        echo "<th>Fecha</th>" . PHP_EOL;
        echo "<th >Hora</th>" . PHP_EOL;
        echo "<th>Motivo</th>" . PHP_EOL;
        echo "<th>Diagnostico</th>" . PHP_EOL;
        echo "<th>Medicamento</th>" . PHP_EOL;
        echo "<th>Dosis</th>" . PHP_EOL;
    echo "</tr>" . PHP_EOL;
    
    include 'database.php';
    
    //Inicializando la base de datos
    $database = new \clases\Database();

    //Buscando todas las citas de este paciente
    $res = $database->getCitas($_SESSION["codigo"]);

    //Buscando al paciente
    $paciente = \clases\Paciente::findById($_SESSION["codigo"]);

    if($res != null) {

        while($row = mysqli_fetch_assoc($res)) {

            //Buscando si hay receta de esta cita
            $res_recetas = \clases\Receta::find($row[Cita::COL_CODIGO_CITA]);

            //Construyendo la fecha de la cita
            $fecha = date_create($row[Cita::COL_F_CITA]);

            echo "<tr>" . PHP_EOL;
                echo "<td><a class=\"trcita\" href=\"cita.php?idcita=234\">" . $paciente->nombre_paciente . "</a></td>" . PHP_EOL;
                echo "<td>" . date_format($fecha, "d-m-Y") . "</td>" . PHP_EOL;
                echo "<td>" . date_format($fecha, "H:i:s") . "</td>" . PHP_EOL;
                echo "<td>" . $row[Cita::COL_MOTIVO] . "</td>" . PHP_EOL;
                echo "<td>" . $row[Cita::COL_DIAGNOSTICO] . "</td>" . PHP_EOL;

                if($res_recetas != null) {
                    //Conviertiendo la receta en resultados
                    $receta = mysqli_fetch_assoc($res_recetas);
                }
                    //echo "<td>" . ($receta[Receta::COL_MEDICAMENTO]!=null?$receta[Receta::COL_MEDICAMENTO]:"---") . "</td>" . PHP_EOL;
                    echo "<td>" . $receta[Receta::COL_MEDICAMENTO] . "</td>" . PHP_EOL;
                    echo "<td>" . $receta[Receta::COL_DOSIS] . "</td>" . PHP_EOL;
            echo "</tr>" . PHP_EOL;
        }
        echo "";
    }


echo "</table>" . PHP_EOL;
