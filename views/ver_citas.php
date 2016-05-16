<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Medik</title>

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

			<div id="parrafo">
				<p>Lista de citas programadas</p>
			</div>


		</section>


		<section id="citassection">
			<table id="citastable" border="1" style="width:100%">
			  <tr id="tr_tags">
				<th id="first-child">Nombre Paciente</th>
				<th>Causa</th>
				<th>Fecha</th>
				<th id="last-child">Hora</th>
			  </tr>
			  <tr>
				<td>Eve asdf asdf</td>
				<td>Jackson asdf asd asd</td>
				<td>94-45-1234</td>
				<td>12:30 AM</td>
			  </tr>
			  <tr>
				<td>Eve asdf asdf</td>
				<td>Jackson asdf asd asd</td>
				<td>94-45-1234</td>
				<td>12:30 AM</td>
			  </tr>
			  <tr>
				<td>Eve asdf asdf</td>
				<td>Jackson asdf asd asd</td>
				<td>94-45-1234</td>
				<td>12:30 AM</td>
			  </tr>
			  <tr>
				<td>Eve asdf asdf</td>
				<td>Jackson asdf asd asd</td>
				<td>94-45-1234</td>
				<td>12:30 AM</td>
			  </tr>
			  <tr>
				<td>Eve asdf asdf</td>
				<td>Jackson asdf asd asd</td>
				<td>94-45-1234</td>
				<td>12:30 AM</td>
			  </tr>
			  <tr>
				<td>Eve asdf asdf</td>
				<td>Jackson asdf asd asd</td>
				<td>94-45-1234</td>
				<td>12:30 AM</td>
			  </tr>
			</table>

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
