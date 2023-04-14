<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<!-- CREAR CURSOS -->
<div>
	<h1>Crear cursos</h1>
	<p>Añade nuevos cursos.</p>

	<?php echo isset($_SESSION['errores_cursos']) ? mostrarError($_SESSION['errores_cursos'], 'nombre') : ''; ?>
	<?php echo isset($_SESSION['errores_cursos']) ? mostrarError($_SESSION['errores_cursos'], 'codigo') : ''; ?>
	<?php echo isset($_SESSION['errores_cursos']) ? mostrarError($_SESSION['errores_cursos'], 'estado') : ''; ?>

	<form action="guardar-cursos.php" method="POST">
		<label>Nombre:</label>
		<input type="text" name="nombre"><br>

		<label>Codigo:</label>
		<input type="text" name="codigo"><br>

		<label>Estado:</label>
		<select name="estado">
			<option value="1">Activado</option>
			<option value="0">Desactivado</option>
		</select><br>

		<input type="submit" value="Guardar">
		<a href="listar-cursos.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>