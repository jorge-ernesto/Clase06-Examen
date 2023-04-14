<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/libreria.php'; ?>

<?php
	if(!isset($_GET['idcurso']) || !isset($_GET['idalumno'])){
		echo "ERROR: No se envio correo";
		die();
	}

	// Recoger datos del formulario
	$idcurso = isset($_GET['idcurso']) ? $_GET['idcurso'] : false;
	$idalumno = isset($_GET['idalumno']) ? $_GET['idalumno'] : false;

	// Validamos
		// Obtenemos curso de la busqueda
		$sql = "SELECT * FROM cursos WHERE id = '$idcurso' AND estado = 1;";
		$curso_busqueda = consultar($sql);
		//debug_array($curso_busqueda);

		// Obtenemos alumno de la busqueda
		$sql = "SELECT * FROM personas WHERE id = '$idalumno';";
		$alumno_busqueda = consultar($sql);
		//debug_array($alumno_busqueda);

		if(!isset($curso_busqueda[0]['id'])){
			echo "ERROR: No existe curso";
			die();
		}
		if(!isset($alumno_busqueda[0]['id'])){
			echo "ERROR: No existe alumno";
			die();
		}

	// Obtenemos notas
		// Ejecutamos procedimiento almacenado
		$sql = "CALL promedios_calcular()";
		ejecutar($sql);

		// Obtenemos vista matriculas
		$sql = "SELECT * FROM vmatricula WHERE idcurso = '$idcurso' AND idalumno = '$idalumno' ORDER BY idalumno;";
		$matriculas = consultar($sql);
		//debug_array($matriculas);

	// Enviamos correo
	foreach ($matriculas as $value) {
		// Correo en formato HTML
		$destino  = $value['correo'];
		$titulo   = "Nota del curso ".$curso_busqueda[0]['nombre']." - ".$curso_busqueda[0]['codigo'];
		$mensaje  = "Estimado(a) alumno(a) <b>".$value['alumno']."</b>, por medio de la presente se te facilitan tus notas.";

		$cabecera = "Content-Type: text/html; charset=\"utf8\"\n";

		// heredoc o documento inscrustado
		$contenido=<<<PERU
		<html>
			<head>
			</head>
			<body>
				<div style="height: 300px; width:500px;  border:solid 1px;">
					<h2>{$titulo}</h2>
					<p>{$mensaje}</p>
					<p>Nota 1: {$value['n1']}</p>
					<p>Nota 2: {$value['n2']}</p>
					<p>Nota 3: {$value['n3']}</p>
					<p>Nota 4: {$value['n4']}</p>
					<p>Promedio: {$value['prom']}</p>
				</div>
			</body>
		</html>
		PERU;

		$envio = mail($destino, $titulo, $contenido, $cabecera);
		if ($envio) {
			$sql = "UPDATE matricula SET notificado = 1 WHERE idalumno = '$idalumno' AND idcurso = '$idcurso';";
			ejecutar($sql);
			echo "Mensaje enviado: " . date('Y-m-d h:i:s') . "<br>";
			echo "Se notifico al alumno(a)";
		} else {
			echo "Error al enviar: " . date('Y-m-d h:i:s');
		}
	}
?>