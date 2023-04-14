<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<!-- CREAR USUARIOS -->
<div>
	<h1>Crear usuarios</h1>
	<p>Añade nuevas usuarios.</p>

	<?php echo isset($_SESSION['errores_usuarios']) ? mostrarError($_SESSION['errores_usuarios'], 'usuario') : ''; ?>
	<?php echo isset($_SESSION['errores_usuarios']) ? mostrarError($_SESSION['errores_usuarios'], 'password') : ''; ?>
	<?php echo isset($_SESSION['errores_usuarios']) ? mostrarError($_SESSION['errores_usuarios'], 'estado') : ''; ?>

	<form action="guardar-usuarios.php" method="POST">
		<label>Usuario:</label>
		<input type="text" name="usuario"><br>

		<label>Contraseña:</label>
		<input type="password" name="password"><br>

		<label>Estado:</label>
		<select name="estado">
			<option value="1">Activado</option>
			<option value="0">Desactivado</option>
		</select><br>

		<input type="submit" value="Guardar">
		<a href="listar-usuarios.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>