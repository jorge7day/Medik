<?php

//Reanudando la sesión
@session_start();

//Verificamos que exista una sesión activa, si no, se ejecutará el bloque dentro del IF
if($_SESSION["logged"] == null || $_SESSION["logged"] == false) {
    //Si no hay una sesión activa, se redireccionará hacia home
    header("Location: ./php/login.php");
}