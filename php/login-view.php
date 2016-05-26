<!DOCTYPE html>
<html lang="es">
<head>
<title>Login</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div id="inicioSesion">
		<section>
		<header id="principal">
			<img src="../files/icon_microscope.svg" id="logo">
			<span id="titulo">Medik</span>
		</header>

	</section>

	<section id="secf">
            <form action="login.php" id="formulario" method="post">
                <img src="../files/open-lock-1.png" id="img1">

			<span id="n2">Iniciar Sesion</span>

			<input style="width:100%" type="text" name="nombre_usuario" placeholder="Usuario" required>
			<input style="width:100%" type="password" name="contraseña" placeholder="Pasword" required>
			<input style="width:100%" type="submit" value="Ingresar" id="boton1">
<!--			<input type="submit"id="boton2" value="Registrarse">-->
                        <a href="../views/registro_paciente.php" class="link">Registrarse</a>
		</form>
    </section>

		<footer id="pie">
         Derechos Reservados &copy; 2016-2020
        </footer>
	</div>
</body>
</html>
