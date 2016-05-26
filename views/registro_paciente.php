<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro Paciente - Medik</title>
        
        <link rel="stylesheet" href="../css/style.css">
        
        <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="../js/crearCita_controller.js"></script>
        
    </head>
    
    <body>
        <!--Usando plantillas-->
        <?php include 'templates/header.php'; ?>
        
        
        <!--</section>-->
        <section id="">
            <div id="parrafo">
                
                <p>Registrar Paciente</p>
                
                <form class="registroseccion2">
                    <input type="text" name="Nombre" placeholder="Nombre" size="75" required>
                    <br>
                    <input type="text" name="Apellido" placeholder="Apellido" size="75" required>
                    <br>
                    <input type="text" name="Dirección" placeholder="Dirección" size="75" required>
                    <br>
                    <br>
                    <input type="text" name="Usuario" placeholder="USUARIO" size="75" required>
                    <br>
                    <input type="password" name="Contraseña" placeholder="Contraseña" size="75" required>
                    <br>
                    <input type="password" name="Contraseña2" placeholder="Repita la contraseña" size="75" required>
                    <br>
                    <input type="radio" name="sexo" value="hombre"> <label>Hombre</label>
                    <input type="radio" name="sexo" value="mujer"> <label>Mujer</label>
                    <br>
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="edad" placeholder="Fecha de nacimiento" size="100" required>
                    <br>
                    <div>
                        <input type="button" id="cancelar_btn" value="Guardar">
                    </div>
                </form>
            </div>
        </section>
        
    </body>
    
    <footer style="display:none">
        Derechos Reservados &copy; 2016-2020
    </footer>
    
</html>
