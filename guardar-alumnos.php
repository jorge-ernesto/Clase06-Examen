<?php
require_once 'includes/libreria.php';

// Recoger datos del formulario
if(isset($_POST)){

	// Recoger datos del formulario
	$idalumno = isset($_POST['idalumno']) ? $_POST['idalumno'] : false;
	$idcurso = isset($_POST['idcurso']) ? $_POST['idcurso'] : false;

	// Validación
	$errores = array();

	$sql = "SELECT count(*) AS cantidad FROM matricula WHERE idalumno = '$idalumno' AND idcurso = '$idcurso'";
	$resultado = consultar($sql);
	$cantidad = $resultado[0]['cantidad'];
	//debug_array($cantidad);

	if($cantidad > 0){
		$errores['concedido'] = 'El alumno ya esta registrado en el curso indicado';
	}

	// Guardamos o editamos
	if(count($errores) == 0){
		$sql = "INSERT INTO matricula (id, idalumno, idcurso) VALUES(null, '$idalumno', '$idcurso');";
		$guardar = ejecutar($sql);

		if($guardar){
			$_SESSION['completado'] = "El registro se ha completado con éxito";
		}else{
			$_SESSION['errores']['general'] = "Fallo al guardar el usuario!!";
		}

		header("Location: registrar-alumnos.php");
	}else{
		$_SESSION["errores_alumnos"] = $errores;

		header("Location: registrar-alumnos.php");
	}

}

