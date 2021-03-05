<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        if (isset($_POST['id'])) {
            include '../html/head.html';
            $conectar = conectar();
            $consulta = 'UPDATE usuarios SET ';
            foreach ($_POST as $clave => $valor) {
                if (!empty($valor) && $clave != 'id') {
                    $consulta .= $clave . '="' . $valor . '", ';
                }
            }
            $id = $_POST['id'];
            $consulta .= 'WHERE ID = ' . $id . ';';
            $consulta = str_replace(", WHERE", " WHERE", $consulta);
            $enviarConsulta = mysqli_query($conectar, $consulta);
            $obtenerUsuario = 'SELECT usuario FROM usuarios WHERE id=\'' . $id . '\'';
            $enviarObtenerUsuario = mysqli_query($conectar, $obtenerUsuario);
            $datos = mysqli_fetch_array($enviarObtenerUsuario);
            if ($enviarConsulta) {
                redirecting();
                # --- Agregar a activity.txt ---
                date_default_timezone_set("America/Argentina/Buenos_Aires");
                $fecha = date("d-m-Y H:i", time());
                $activity = $fecha . ';' . $_SESSION['usuario'] . ';modified <b>' . $datos['usuario'] . '</b>\'s data';
                guardarDatos($activity);
                include '../html/scripts.html';
            } else {
                echo '<div class="redirecting">';
                echo "<h2> Unknown error: couldn't modify user data. Try again. </h2>";
                echo "<p> Redirecting... </p>";
                echo '</div>';
                header("refresh:2;url=search.php");
            }
        } else {
            include '../html/head.html';
            echo '<div class="redirecting">';
            echo "<h2> You didn't send the form. Try again.</h2>";
            echo "<p> Redirecting... </p>";
            echo '</div>';
            header("refresh:2;url=search.php");
        }
    } else {
        nologin();
    }
?>