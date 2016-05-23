<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Registro Paciente- Medik</title>

		<link rel="stylesheet" href="../css/style.css">

		<script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>

        <script type="text/javascript" src="../js/crearCita_controller.js"></script>

	</head>

	<body>
		<section id="inicio">
			<header id="principal">
				<img src="../files/icon_microscope.png" id="logo">
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



<!--</section>-->


		<section id="">
<div id="parrafo">

		  <p>Registrar Paciente</p>

          <form class="registroseccion2">
					  <input type="text" name="Nombre" placeholder="Nombre" size="75" required>
					  <br>
					  <input type="text" name="Apellido" placeholder="Apellido" size="75"required>
					  <br>
					  <input type="text" name="Dirección" placeholder="Dirección" size="75" required>
					  <br>
                      <br>
					  <input type="text" name="Usuario" placeholder="USUARIO" size="75"required>
                      <br>
					  <input type="password" name="Contraseña" placeholder="Contraseña" size="75" required>
					  <br>
					  <input type="password" name="Contraseña2" placeholder="Repita la contraseña" size="75" required>
					  <br>
					  <input type="radio" name="sexo">
					  <label>Hombre</label>
					  <input type="radio" name="sexo">
					  <label>Mujer</label>
					  <br>
                      <label>Fecha de Nacimiento</label>
					  <input type="date" name="edad" placeholder="Fecha de nacimiento" size="100" required>
					  <br>
					  <div style="">
					    <input type="button" id="cancelar_btn" onclick="mostrarFormulario()" value="Guardar">
				      </div>
    </form>
			</div>
</section>

</body>

	<footer style="display:none">
			Derechos Reservados &copy; 2016-2020
		</footer>

</html>
