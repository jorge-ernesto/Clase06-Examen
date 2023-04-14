<?php require_once 'libreria.php'; ?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Examen PHP 1</title>
    <style>
        .alerta {
            font-weight: bold;
        }
        .alerta-error {
            color: red;
        }
        .alerta-exito {
            color: green;
        }
    </style>
</head>

<body>
    <!-- CABECERA -->
    <header>
        <!-- TITULO -->
        <a href="index.php">
            Examen PHP 1
        </a>

        <!-- MENU -->
        <nav>
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li>
                    <a href="listar-usuarios.php">Listar usuarios</a>
                </li>
                <li>
                    <a href="listar-personas.php">Listar personas</a>
                </li>
                <li>
                    <a href="listar-cursos.php">Listar cursos</a>
                </li>
                <li>
                    <a href="registrar-alumnos.php">Registrar alumnos</a>
                </li>
                <li>
                    <a href="reporte-cursos.php">Reporte cursos</a>
                </li>
                <?php if(isset($_SESSION['usuario'])){ ?>
                <li>
                    <a href="cerrar.php">Cerrar sesión</a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <!-- BIENVENIDA AL USUARIO -->
    <div>
        <?php if(isset($_SESSION['usuario'])){ ?>
        <div>
            <h3>Bienvenido Usuario: <?php echo $_SESSION['usuario']['usuario']; ?></h3>
            <p>Te autenticaste correctamente.</p>
        </div>
        <?php } ?>
    </div>