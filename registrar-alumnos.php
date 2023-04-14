<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	//OBTENEMOS ALUMNOS
	$sql = "SELECT * FROM valumnos;";
	$alumnos = consultar($sql);
	//debug_array($alumnos);

	//OBTENEMOS CURSOS
	$sql = "SELECT * FROM cursos WHERE estado = 1;";
	$cursos = consultar($sql);
	//debug_array($cursos);
?>

<!-- REGISTRAR ALUMNOS -->
<div>
	<h1>Registrar alumnos</h1>

	<?php if(isset($_SESSION['completado'])): ?>
		<div class="alerta alerta-exito">
			<?=$_SESSION['completado']?>
		</div>
	<?php elseif(isset($_SESSION['errores']['general'])): ?>
		<div class="alerta alerta-error">
			<?=$_SESSION['errores']['general']?>
		</div>
	<?php endif; ?>

	<?php echo isset($_SESSION['errores_alumnos']) ? mostrarError($_SESSION['errores_alumnos'], 'concedido') : ''; ?>

	<form action="guardar-alumnos.php" method="POST">
		<label>Alumnos:</label>
		<select name="idalumno">
			<?php foreach ($alumnos as $value) { ?>
			<?php $alumno = $value['paterno']." ".$value['materno']." ".$value['nombre']." - ".$value['codigo'].": ".$value["docu_num"]; ?>
			<option value="<?=$value['id']?>"><?=$alumno?></option>
			<?php } ?>
		</select><br>

		<label>Cursos:</label>
		<select name="idcurso">
			<?php foreach ($cursos as $value) { ?>
			<?php $curso = $value['nombre'].' - '.$value['codigo']; ?>
			<option value="<?=$value['id']?>"><?=$curso?></option>
			<?php } ?>
		</select><br>

		<input type="submit" value="Guardar">
		<a href="registrar-alumnos.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>