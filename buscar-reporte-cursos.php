<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	if(!isset($_POST['idcurso'])){
		header("Location: reporte-cursos.php");
	}

	// Recoger datos del formulario
	$idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;

	// Validamos
		// Obtenemos curso de la busqueda
		$sql = "SELECT * FROM cursos WHERE id = '$idcurso' AND estado = 1;";
		$curso_busqueda = consultar($sql);
		//debug_array($curso_busqueda);

		if(!isset($curso_busqueda[0]['id'])){
			header("Location: reporte-cursos.php");
		}

	// Obtenemos matriculas
		// Ejecutamos procedimiento almacenado
		$sql = "CALL promedios_calcular()";
		ejecutar($sql);

		// Obtenemos vista matriculas
		$sql = "SELECT * FROM vmatricula WHERE idcurso = '$idcurso' ORDER BY idalumno;";
		$matriculas = consultar($sql);
		//debug_array($matriculas);

	// Obtenemos cursos
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

	<!-- TABLA DE RESULTADOS -->
	<h1>Busqueda: <?=$curso_busqueda[0]['nombre'].' - '.$curso_busqueda[0]['codigo'];?></h1>
	<table border=1>
        <tr>
            <td>ALUMNO</td>
            <td>CURSO</td>
            <td>NOTA 1</td>
			<td>NOTA 2</td>
			<td>NOTA 3</td>
			<td>NOTA 4</td>
			<td>PROMEDIO</td>
            <td>NOTIFICADO</td>
			<td></td>
        </tr>
        <?php foreach ($matriculas as $value) { ?>
        <tr>
            <td><?=$value['alumno']?></td>
            <td><?=$value['nombre'].' - '.$value['codigo']?></td>
			<td><?=$value['n1']?></td>
			<td><?=$value['n2']?></td>
			<td><?=$value['n3']?></td>
			<td><?=$value['n4']?></td>
			<td><?=$value['prom']?></td>
			<td><?=$value['notificado']?></td>
            <td>
                <a href="editar-notas.php?idalumno=<?=$value['idalumno']?>&idcurso=<?=$value['idcurso']?>">Editar notas</a><br>
				<a href="enviar-correo.php?idalumno=<?=$value['idalumno']?>&idcurso=<?=$value['idcurso']?>" target="_blank">Enviar correo</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php require_once 'includes/pie.php'; ?>