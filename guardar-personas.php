<?php
require_once 'includes/libreria.php';

// Recoger datos del formulario
if(isset($_POST)){

	conectar();
	global $cnx;
	// debug_array($cnx, TRUE);

	// Recoger datos del formulario
	$paterno = isset($_POST['paterno']) ? mysqli_real_escape_string($cnx, $_POST['paterno']) : false;
	$materno = isset($_POST['materno']) ? mysqli_real_escape_string($cnx, $_POST['materno']) : false;
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($cnx, $_POST['nombre']) : false;
	$genero = isset($_POST['genero']) ? mysqli_real_escape_string($cnx, $_POST['genero']) : false;
	$docu_tip = isset($_POST['docu_tip']) ? $_POST['docu_tip'] : false;
	$docu_num = isset($_POST['docu_num']) ? mysqli_real_escape_string($cnx, $_POST['docu_num']) : false;
	$correo = isset($_POST['correo']) ? mysqli_real_escape_string($cnx, $_POST['correo']) : false;

	// echo "<pre>";
	// print_r($_POST);
	// print_r($_GET);
	// echo "</pre>";
	// die();

	// Validación
	$errores = array();
	if(empty($paterno) || is_numeric($paterno) || preg_match("/[0-9]/", $paterno)){
		$errores['paterno'] = 'El paterno no es válido';
	}
	if(empty($materno) || is_numeric($materno) || preg_match("/[0-9]/", $materno)){
		$errores['materno'] = 'El materno no es válido';
	}
	if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)){
		$errores['nombre'] = 'El nombre no es válido';
	}
	if(empty($genero) || is_numeric($genero) || preg_match("/[0-9]/", $genero)){
		$errores['genero'] = 'El genero no es válido';
	}
	if(empty($docu_tip) || !is_numeric($docu_tip)){
		$errores['docu_tip'] = 'El documento no es válido';
	}
	if(empty($docu_num)){
		$errores['docu_num'] = 'El numero de documento no es válido';
	}
	if(empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
		$errores['correo'] = "El email no es válido";
	}

	// Guardamos o editamos
	if(count($errores) == 0){
		if(isset($_GET['editar'])){
			$persona_id = $_GET['editar'];

			$sql = "UPDATE personas
					SET paterno='$paterno', materno='$materno', nombre='$nombre', genero='$genero', docu_tip=$docu_tip, docu_num='$docu_num', correo='$correo'
					WHERE id=$persona_id";
		}else{
			$sql = "INSERT INTO personas VALUES(null, '$paterno', '$materno', '$nombre', '$genero', $docu_tip, '$docu_num', '$correo');";
		}
		$guardar = mysqli_query($cnx, $sql);

		header("Location: listar-personas.php");
	}else{
		$_SESSION["errores_personas"] = $errores;

		if(isset($_GET['editar'])){
			header("Location: editar-personas.php?id=".$_GET['editar']);
		}else{
			header("Location: crear-personas.php");
		}
	}

	desconectar();

}

