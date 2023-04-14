<?php
require_once 'includes/libreria.php';

// Recoger datos del formulario
if(isset($_POST)){

	// Recoger datos de alumno y curso
	$idalumno = $_GET['idalumno'];
	$idcurso = $_GET['idcurso'];

	// Recoger datos del formulario
	$n1 = isset($_POST['n1']) ? $_POST['n1'] : false;
	$n2 = isset($_POST['n2']) ? $_POST['n2'] : false;
	$n3 = isset($_POST['n3']) ? $_POST['n3'] : false;
	$n4 = isset($_POST['n4']) ? $_POST['n4'] : false;

	// Validación
	$errores = array();
	if(!is_numeric($n1) || strlen($n1) > 2){
		$errores['n1'] = 'La nota 1 no es válida';
	}
	if(!is_numeric($n2) || strlen($n2) > 2){
		$errores['n2'] = 'La nota 2 no es válida';
	}
	if(!is_numeric($n3) || strlen($n3) > 2){
		$errores['n3'] = 'La nota 3 no es válida';
	}
	if(!is_numeric($n4) || strlen($n4) > 2){
		$errores['n4'] = 'La nota 4 no es válida';
	}

	// Guardamos o editamos
	if(count($errores) == 0){
		$sql = "UPDATE matricula
				SET n1 = '$n1', n2 = '$n2', n3 = '$n3', n4 = '$n4'
				WHERE idalumno = '$idalumno' AND idcurso = '$idcurso';";
		$editar = ejecutar($sql);

		if($editar){
			$_SESSION['completado'] = "Las notas se actualizaron correctamente";
		}else{
			$_SESSION['errores']['general'] = "Fallo al actualizar las notas!!";
		}

		header("Location: editar-notas.php?idalumno=".$idalumno."&idcurso=".$idcurso);
	}else{
		$_SESSION["errores_notas"] = $errores;

		header("Location: editar-notas.php?idalumno=".$idalumno."&idcurso=".$idcurso);
	}

}

