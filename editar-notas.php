<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	// OBTENEMOS GET
	$idalumno = $_GET['idalumno'];
	$idcurso = $_GET['idcurso'];
	//debug_array($_GET);

	// OBTENEMOS ALUMNO
	$sql = "SELECT * FROM valumnos WHERE id = '$idalumno';";
	$alumno_busqueda = consultar($sql);
	$alumno_busqueda = $alumno_busqueda[0];
	//debug_array($alumno_busqueda);

	// OBTENEMOS CURSO
	$sql = "SELECT * FROM cursos WHERE id = '$idcurso' AND estado = 1;";
	$curso_busqueda = consultar($sql);
	$curso_busqueda = $curso_busqueda[0];
	//debug_array($curso_busqueda);

	// OBTENEMOS NOTAS
	$sql = "SELECT * FROM matricula WHERE idalumno = '$idalumno' AND idcurso = '$idcurso';";
	$notas_busqueda = consultar($sql);
	$notas_busqueda = $notas_busqueda[0];
	//debug_array($notas_busqueda);
?>

<!-- REPORTE CURSOS -->
<div>
	<h1>EDITAR NOTAS</h1>
	<h3>
		Alumno: <?=$alumno_busqueda['paterno'].' '.$alumno_busqueda['materno'].' '.$alumno_busqueda['nombre'].' - '.$alumno_busqueda['codigo'].': '.$alumno_busqueda['docu_num'];?><br>
		Curso: <?=$curso_busqueda['nombre'].' - '.$curso_busqueda['codigo'];?>
	</h3>

	<?php if(isset($_SESSION['completado'])): ?>
		<div class="alerta alerta-exito">
			<?=$_SESSION['completado']?>
		</div>
	<?php elseif(isset($_SESSION['errores']['general'])): ?>
		<div class="alerta alerta-error">
			<?=$_SESSION['errores']['general']?>
		</div>
	<?php endif; ?>

	<?php echo isset($_SESSION['errores_notas']) ? mostrarError($_SESSION['errores_notas'], 'n1') : ''; ?>
	<?php echo isset($_SESSION['errores_notas']) ? mostrarError($_SESSION['errores_notas'], 'n2') : ''; ?>
	<?php echo isset($_SESSION['errores_notas']) ? mostrarError($_SESSION['errores_notas'], 'n3') : ''; ?>
	<?php echo isset($_SESSION['errores_notas']) ? mostrarError($_SESSION['errores_notas'], 'n4') : ''; ?>

	<!-- FORMULARIO DE BUSQUEDA -->
	<form action="guardar-notas.php?idalumno=<?=$idalumno?>&idcurso=<?=$idcurso?>" method="POST">
		<label>Nota 1:</label>
		<input type="text" name="n1" value="<?=$notas_busqueda['n1']?>"><br>

		<label>Nota 2:</label>
		<input type="text" name="n2" value="<?=$notas_busqueda['n2']?>"><br>

		<label>Nota 3:</label>
		<input type="text" name="n3" value="<?=$notas_busqueda['n3']?>"><br>

		<label>Nota 4:</label>
		<input type="text" name="n4" value="<?=$notas_busqueda['n4']?>"><br>

		<input type="submit" value="Guardar">
		<a href="buscar-reporte-cursos.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>