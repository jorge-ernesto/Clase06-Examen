<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	//OBTENEMOS CURSOS
	$sql = "SELECT * FROM cursos WHERE estado = 1;";
	$cursos = consultar($sql);
	//debug_array($cursos);
?>

<!-- REPORTE CURSOS -->
<div>
	<h1>REPORTE CURSOS</h1>

	<!-- FORMULARIO DE BUSQUEDA -->
	<form action="buscar-reporte-cursos.php" method="POST">
		<label>Cursos:</label>
		<select name="idcurso">
			<?php foreach ($cursos as $value) { ?>
			<?php $curso = $value['nombre'].' - '.$value['codigo']; ?>
			<option value="<?=$value['id']?>"><?=$curso?></option>
			<?php } ?>
		</select><br>

		<input type="submit" value="Buscar">
	</form>
</div>

<?php require_once 'includes/pie.php'; ?>