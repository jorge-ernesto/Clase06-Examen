<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	//REDIRECCION EN CASO NO EXISTA EL USUARIO
	$id = $_GET['id'];
	$sql = "SELECT * FROM personas WHERE id = $id;";
	$resultado = consultar($sql);
	$persona_actual = $resultado[0];
	//debug_array($persona_actual);

	if(!isset($persona_actual['id'])){
		header("Location: index.php");
	}

	//OBTENEMOS GENEROS
	$genero = array(
		'M' => "Masculino",
		'F' => "Femenino"
	);

	//OBTENEMOS DOCUMENTOS
	$sql = "SELECT * FROM documentos;";
	$documentos = consultar($sql);
	//debug_array($documentos);
?>

<!-- CREAR PERSONAS -->
<div>
	<h1>Editar personas</h1>
	<p>Editar personas.</p>

	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'paterno') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'materno') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'nombre') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'genero') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'docu_tip') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'docu_num') : ''; ?>
	<?php echo isset($_SESSION['errores_personas']) ? mostrarError($_SESSION['errores_personas'], 'correo') : ''; ?>

	<form action="guardar-personas.php?editar=<?=$persona_actual['id']?>" method="POST">
		<label>Paterno:</label>
		<input type="text" name="paterno" value="<?=$persona_actual['paterno']?>"><br>

		<label>Materno:</label>
		<input type="text" name="materno" value="<?=$persona_actual['materno']?>"><br>

		<label>Nombre:</label>
		<input type="text" name="nombre" value="<?=$persona_actual['nombre']?>"><br>

		<label>Genero:</label>
		<select name="genero">
			<?php foreach($genero as $key => $value){ ?>
			<?php $selected = ($key == $persona_actual['genero']) ? "selected" : ""; ?>
			<option value="<?=$key?>" <?=$selected?> ><?=$value?></option>
			<?php } ?>
		</select><br>

		<label>Documento:</label>
		<select name="docu_tip">
			<?php foreach ($documentos as $value) { ?>
			<?php $selected = ($value['id'] == $persona_actual['docu_tip']) ? "selected" : ""; ?>
			<option value="<?=$value['id']?>" <?=$selected?> ><?=$value['codigo'].' - '.$value['nombre']?></option>
			<?php } ?>
		</select><br>

		<label>Numero de documento:</label>
		<input type="text" name="docu_num" value="<?=$persona_actual['docu_num']?>"><br>

		<label>Correo:</label>
		<input type="email" name="correo" value="<?=$persona_actual['correo']?>"><br>

		<input type="submit" value="Guardar">
		<a href="listar-personas.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>