<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
$sql = "SELECT * FROM cursos;";
$resultado = consultar($sql);
//debug_array($resultado);
?>

<!-- CREAR CURSOS -->
<div>
	<h1>Listar cursos</h1>
	<p>
        Añade nuevos cursos.<br>
        <a href="crear-cursos.php">Crear cursos</a>
    </p>

    <table border=1>
        <tr>
            <td>ID</td>
            <td>NOMBRE</td>
            <td>CODIGO</td>
            <td>ESTADO</td>
        </tr>
        <?php foreach($resultado as $value){ ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['nombre']?></td>
            <td><?=$value['codigo']?></td>
            <td><?=$value['estado']==1?"Activo":"Desactivado"?></td>
            <td>
                <a href="editar-cursos.php?id=<?=$value['id']?>">Editar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
			
<?php require_once 'includes/pie.php'; ?>