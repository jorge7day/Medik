<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Agregar Diagnostico - Medik</title>

		<link rel="stylesheet" href="../css/paciente_style.css">
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


		<section id="citassection">
			<div id="parrafo">
					<p>Agregar Diagnostico</p>
			</div>

			<form action="" id="formularioc">
				<p><b class="label">Nombre del paciente:</b> Jose ksdljf sdf<p>
				<p><b class="label">Fecha de cita:</b> J1-2-1234<p>
				<p><b class="label">Hora de cita:</b> 12:00 AM<p>

				<textarea placeholder="Agregar Diagnostico"></textarea>
                <textarea placeholder="Medicamento"></textarea>

				<input type="text" name="Dosis" placeholder="Dosis" size="75"required>

				<div style="">
					<input type="submit" id="enviar_btn">
					<input type="button" id="cancelar_btn" onclick="mostrarFormulario()" value="Cancelar">
				</div>
			</form>

		</section>



		<!--
		<section id="form" style="display:none">
			<form action="" id="formulario">

				<p id="n2"> Crea tu cita</p>
				<input type="text" name="Nombre" placeholder="Nombre" required>
				<input type="number" name="edad" min="0" max="120" placeholder="Edad" required>
				<input type="text" name="ID" placeholder="Id de seguro" required>

				<div style="">
					<input type="submit" id="enviar_btn">
					<input type="button" id="cancelar_btn" onclick="mostrarFormulario()" value="Cancelar">
				</div>
			</form>

		</section>
		-->

		<footer style="display:none">
			Derechos Reservados &copy; 2016-2020
		</footer>
	</body>
</html>