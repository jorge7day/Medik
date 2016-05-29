<!DOCTYPE html>

<!--Se hará la comprobación de si ya se ingresaron algunos datos en la página,
    Si es así, se hará la inserción del paciente, sino no-->
<?php 
set_include_path("C:\\xampp\\htdocs\\medik\\php");
include 'Paciente.php';
include 'Credenciales.php';


//Comprueba si se ha enviado algún dato
if(isset($_POST["nombre"])) {
    //Variable bandera para probar los valores
    $isReady = true;
    
    //Se prueba si los nombres poseen números o signos no válidos en los nombres
    if(preg_match("/([\d]+|[^\w ])/", $_POST["nombre"]) === 1) {
        $isReady = false;
    }
    
    //Se prueba si el número de teléfono tiene un formato correcto
    if(preg_match("/([\d]+|[^\w ])/", $_POST["nombre"]) === 1) {
        $isReady = false;
    }
    
    //Comprobando contraseñas
    if($_POST["contraseña1"] != $_POST["contraseña2"]) {
        $isReady = false;
    }
    
    //Comprobando que no exista el usuario entre las credeciales
    if(Credenciales::find($_POST["usuario"])) {
        $isReady = false;
    }
    
    //Si no hay ninguna violación a las restricciones, el usuario se guardará
    if($isReady) {
        //Preparando la BD
        $database = new Database();
        
        //Construyendo al nuevo paciente
        $paciente = new Paciente();
        
        $paciente->nombre_paciente = $_POST["nombre"];
        $paciente->sexo_paciente = $_POST["sexo"];
        $paciente->f_nacimiento = date_create($_POST["f_nacimiento"]);
        $paciente->telefono_paciente = $_POST["telefono"];
        
        //Guardando al nuevo paciente
        $paciente->saveOnDB();
        
        //Construyendo sus credenciales
        $credenciales = new Credenciales($_POST["usuario"], hash("sha256", $_POST["contraseña1"]));
        
        //Buscando si existe al usuario recién creado
        $temp = Paciente::findByName($paciente->nombre_paciente);
        
        $credenciales->codigo_usuario = $temp->codigo_paciente;
        
        //Guardando credenciales
        echo $credenciales->saveOnDB();
    }
}
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro Paciente - Medik</title>
        
        <link rel="stylesheet" href="../css/style.css">
        
        <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="../js/crearCita_controller.js"></script>
        
        <script>
        </script>
        
    </head>
    
    <body>
        <!--Usando plantillas-->
        <?php include 'templates/header.php'; ?>
        
        <section id="">
            <div id="parrafo">
                
                <p>Registrar Paciente</p>
                
                <form class="registroseccion2" method="post" action="registro_paciente.php">
                    <input type="text" name="nombre" placeholder="Nombre" size="75" required>
                    <br>
                    <input type="text" name="telefono" placeholder="Teléfono (XXXX-XXXX)" size="75" required>
                    <br>
<!--                    <input type="text" name="direccion" placeholder="Dirección" size="75" required>
                    <br><br>-->
                    <input type="text" name="usuario" placeholder="USUARIO" size="75" required>
                    <br>
                    <input type="password" name="contraseña1" placeholder="Contraseña" size="75" required>
                    <br>
                    <input type="password" name="contraseña2" placeholder="Repita la contraseña" size="75" required>
                    <br>
                    <input type="radio" name="sexo" value=1 checked="true"> <label>Hombre</label>
                    <input type="radio" name="sexo" value=0> <label>Mujer</label>
                    <br>
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="f_nacimiento" placeholder="Fecha de nacimiento" size="100" required>
                    <br>
                    <div>
                        <input type="submit" id="cancelar_btn" value="Guardar">
                    </div>
                </form>
            </div>
        </section>
        
    </body>
    
    <footer style="display:none">
        Derechos Reservados &copy; 2016-2020
    </footer>
    
</html>
