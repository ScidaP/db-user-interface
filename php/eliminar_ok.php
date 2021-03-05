<?php 
    include 'funciones.php';
    session_start();
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $conexion = conectar();
            $obtenerUsuario = 'SELECT usuario FROM usuarios WHERE id=\'' . $id . '\'';
            $enviarObtenerUsuario = mysqli_query($conexion, $obtenerUsuario);
            $datos = mysqli_fetch_array($enviarObtenerUsuario);
            $consulta = 'DELETE FROM usuarios WHERE id=\'' . $id . '\'';
            $enviarConsulta = mysqli_query($conexion, $consulta);
            if ($enviarConsulta) {
                redirecting();
                # --- Agregar a activity.txt ---
                date_default_timezone_set("America/Argentina/Buenos_Aires");
                $fecha = date("d-m-Y H:i", time());
                $activity = $fecha . ';' . $_SESSION['usuario'] . ';deleted <b>' . $datos['usuario'] . '</b> from the database';
                guardarDatos($activity);
            } else {
                echo '<div class="redirecting">';
                echo "<h2> User couldn't be deleted due to an unknown error. </h2>";
                echo "<p> Try again later. </p>";
                echo '</div>';
                header("refresh:2;url=search.php");
            }
        } else {
            echo '<div class="redirecting">';
            echo "<h2> Error. Try again. </h2>";
            echo "<p> Redirecting... </p>";
            echo '</div>';
            header("refresh:2;url=search.php");
        }
    } else {
        nologin();
    }
?>