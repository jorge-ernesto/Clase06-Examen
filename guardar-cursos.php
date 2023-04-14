<?php
require_once 'includes/libreria.php';

// Recoger datos del formulario
if(isset($_POST)){

	conectar();
	global $cnx;
	// debug_array($cnx, TRUE);

	// Recoger datos del formulario
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($cnx, $_POST['nombre']) : false;
	$codigo = isset($_POST['codigo']) ? mysqli_real_escape_string($cnx, $_POST['codigo']) : false;
	$estado = isset($_POST['estado']) ? $_POST['estado'] : false;

	// Validación
	$errores = array();
	if(empty($nombre)){
		$errores['nombre'] = 'El usuario no es válido';
	}
	if(empty($codigo)){
		$errores['codigo'] = 'El password no es válido';
	}
	if(empty($estado) && !is_numeric($estado)){
		$errores['estado'] = 'El estado no es válido';
	}

	// Guardamos o editamos
	if(count($errores) == 0){
		if(isset($_GET['editar'])){
			$curso_id = $_GET['editar'];

			$sql = "UPDATE cursos
					SET nombre='$nombre', codigo='$codigo', estado=$estado
					WHERE id=$curso_id";
		}else{
			$sql = "INSERT INTO cursos VALUES(null, '$nombre', '$codigo', $estado);";
		}
		$guardar = mysqli_query($cnx, $sql);

		header("Location: listar-cursos.php");
	}else{
		$_SESSION["errores_cursos"] = $errores;

		if(isset($_GET['editar'])){
			header("Location: editar-cursos.php?id=".$_GET['editar']);
		}else{
			header("Location: crear-cursos.php");
		}
	}

	desconectar();

}

