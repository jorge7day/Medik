<!DOCTYPE html>
<html lang="es">
<head>
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="inicioSesion">
		<section>
		<header id="principal">
			<img src="files/icon_microscope.svg" id="logo">
			<span id="titulo">Medik</span>
		</header>
		<nav>
		<ul>
			<li><a title="Opcion 1" href="mis_citas.php">Mis Citas</a></li>
			<li><a title="Opcion 2" href="gestionar_cita.php">Gestionar Citas</a></li>
			<li><a title="Opcion 2" href="pacientes.php">Pacientes</a></li>
			<li id="last_li"><a title="Opcion 2" href="#">Usuario</a></li>
		</ul>
		</nav>
	</section>

	<section id="secf">
		<form action="" id="formulario">
			<img src="files/open-lock-1.png" id="img1">

			<span id="n2">Iniciar Sesion</span>

			<input type="text" name="Id" placeholder="Usuario" required>
			<input type="password" name="pasword" placeholder="Pasword" required>
			<input type="submit" value="Ingresar"id="boton1">
			<input type="submit"id="boton2" value="Registrarse">
		</form>
    </section>

<footer id="pie">
         Derechos Reservados &copy; 2016-2020
        </footer>
	</div>
</body>
</html>
