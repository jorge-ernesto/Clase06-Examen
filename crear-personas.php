<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	//OBTENER DOCUMENTOS
	$sql = "SELECT * FROM documentos;";
	$documentos = consultar($sql);
	//debug_array($documentos);
?>

<!-- CREAR PERSONAS -->
<div>
	<h1>Crear personas</h1>
	<p>Añade nuevos personas.</p>

	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'paterno') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'materno') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'nombre') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'genero') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'docu_tip') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'docu_num') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'correo') : ''; ?>

	<form action="guardar-personas.php" method="POST">
		<label>Paterno:</label>
		<input type="text" name="paterno"><br>

		<label>Materno:</label>
		<input type="text" name="materno"><br>

		<label>Nombre:</label>
		<input type="text" name="nombre"><br>

		<label>Genero:</label>
		<select name="genero">
			<option value="M">Masculino</option>
			<option value="F">Femenino</option>
		</select><br>

		<label>Documento:</label>
		<select name="docu_tip">
		<?php foreach ($documentos as $value) { ?>
			<option value="<?=$value['id']?>"><?=$value['codigo'].' - '.$value['nombre']?></option>
		<?php } ?>
		</select><br>

		<label>Numero de documento:</label>
		<input type="text" name="docu_num"><br>

		<label>Correo:</label>
		<input type="email" name="correo"><br>

		<input type="submit" value="Guardar">
		<a href="listar-personas.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>