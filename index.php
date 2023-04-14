<?php require_once 'includes/cabecera.php'; ?>

<!-- LOGIN DE USUARIO -->
<div>
    <?php if(!isset($_SESSION['usuario'])){ ?>
    <div>
        <h3>Identificate</h3>

        <form action="login.php" method="POST">
            <label>Usuario</label>
            <input type="text" name="usuario">

            <label>Contraseña</label>
            <input type="password" name="password">

            <input type="submit" value="Entrar">
        </form>
    </div>
    <?php } ?>
</div>

<?php require_once 'includes/pie.php'; ?>