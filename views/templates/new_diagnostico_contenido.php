<?php
namespace templates;
$codigo_cita;

if(!isset($_GET["cita"])) {
    return;
}
else {
    $codigo_cita = $_GET["cita"];
}

set_include_path("C:\\xampp\\htdocs\\medik\\php");
//require 'cita.php';
//require 'database.php';
require 'paciente.php';
############################################
#Buscando los detalles de la cita
############################################
#Creando el acceso a la BD
$database = new \clases\Database();

#Creando la sentencia
$sentencia = "select * from " . \clases\Database::TABLA_CITA . "," . \clases\Database::TABLA_PACIENTE 
        . " where " . \clases\Database::TABLA_CITA . "." . \clases\Cita::COL_CODIGO_PACIENTE
        . "=" . \clases\Database::TABLA_PACIENTE . "." . \clases\Paciente::COL_CODIGO_PACIENTE
        . " and " . \clases\Database::TABLA_CITA . "." . \clases\Cita::COL_CODIGO_CITA
        . "=" . $codigo_cita
        . " order by " . \clases\Database::TABLA_CITA . "." . \clases\Cita::COL_CODIGO_PACIENTE;
        
$result = $database->request($sentencia);

if($result != null) {
    $row = mysqli_fetch_assoc($result);
    
    $fecha = date_create($row[\clases\Cita::COL_F_CITA]);
    
    echo '<p><b class="label">Nombre del paciente:</b> ' . $row[\clases\Paciente::COL_NOMBRE_PACIENTE] . '<p>';
    echo '<p><b class="label">Fecha de cita:</b> ' . date_format($fecha, "d/m/Y") . '<p>';
    echo '<p><b class="label">Hora de cita:</b> ' . date_format($fecha, "H:i:s") . '<p>';
    echo '<p><b class="label">Diagnóstico:</b> ' . $row[\clases\Cita::COL_MOTIVO] . '<p>';
    
    $_SESSION["codigo_cita"] = $row[\clases\Cita::COL_CODIGO_CITA];
}