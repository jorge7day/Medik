<?php
namespace templates;

set_include_path("C:\\xampp\\htdocs\\medik\\php");
use clases\Cita;
use clases\Paciente;

require 'Paciente.php';

$database = new \clases\Database();

$res = $database->getCitasDeMedico($_SESSION["codigo"]);

echo "<table id=\"citastable\" border=\"1\" style=\"width:100%\">" . PHP_EOL;
    echo "<tr id=\"tr_tags\">" . PHP_EOL;
        echo "<th id=\"first-child\">Nombre Paciente</th>" . PHP_EOL;
        echo "<th>Fecha</th>" . PHP_EOL;
        echo "<th id=\"last-child\">Hora</th>" . PHP_EOL;
        echo "<th>Motivo</th>" . PHP_EOL;
        echo "<th>Diagnostico</th>" . PHP_EOL;
        echo "<th>Eliminar</th>" . PHP_EOL;
    echo "</tr>" . PHP_EOL;

    while ($row = mysqli_fetch_assoc($res)) {
        $paciente = Paciente::findById($row[Cita::COL_CODIGO_PACIENTE]);
        $fecha = date_create_from_format("Y-m-d H:i:s", $row[Cita::COL_F_CITA]);

        echo "<tr>" . PHP_EOL;
            echo "<td>" . $paciente->nombre_paciente . "</td>" . PHP_EOL;
            echo "<td>" . date_format($fecha, "d/m/Y") . "</td>" . PHP_EOL;
            echo "<td>" . date_format($fecha, "H:i:s") . "</td>" . PHP_EOL;
            echo "<td>" . $row[Cita::COL_MOTIVO] . "</td>" . PHP_EOL;

            if($row[Cita::COL_DIAGNOSTICO] != "") {
                echo "<td>" . $row[Cita::COL_DIAGNOSTICO] . "</td>" . PHP_EOL;
            }
            else {
                echo "<td><button class=\"btn_con_img\"><a href='gestor_citas.php?codigo_cita=" . $row[Cita::COL_CODIGO_CITA] . "&op=+'><img id=\"img_btn\" src=\"../files/add_icon.png\"></a></button></td>" . PHP_EOL;
            }

            echo "<td><button class=\"btn_con_img\"><a href='gestor_citas.php?codigo_cita=" . $row[Cita::COL_CODIGO_CITA] . "&op=x'><img id=\"img_btn\" src=\"../files/borrar_icon.png\"></a></button></td>" . PHP_EOL;
        echo "</tr>" . PHP_EOL;
    }
echo "</table>" . PHP_EOL;
