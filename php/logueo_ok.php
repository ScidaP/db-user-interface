<?php include '../html/head.html';?>
<?php
    session_start();
    if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
        include 'funciones.php';
        $conectar = conectar();
        $consulta = 'SELECT usuario, pass FROM usuarios WHERE usuario=\'' . $_POST['usuario'] . '\' AND pass=\'' . sha1($_POST['pass']) . '\'';
        $enviarConsulta = mysqli_query($conectar, $consulta);
        if (mysqli_num_rows($enviarConsulta) > 0) {
            $fila = mysqli_fetch_array($enviarConsulta);
            $_SESSION['usuario'] = $fila['usuario'];
            echo '<div id="error" class="redirecting login">';
            echo "<h2> Correct username. </h2>";
            echo "<p> Redirecting...";
            echo "</div>";               
            # --- Agregar a activity.txt ---
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $fecha = date("d-m-Y H:i", time());
            $activity = $fecha . ';' . $_SESSION['usuario'] . '; logged in';
            guardarDatos($activity);
        } else {
            echo '<div id="error" class="redirecting nologin">';
            echo "<p> Incorrect username or password.</p>";
            echo "<p> Redirecting... </p>";
            echo '</div>';
            include_once '../html/scripts.html';
        }
    } else {
        echo '<div id="error" class="redirecting nologin">';
        echo "<p> You didn\'t fill the log in form.</p>";
        echo "<p> Redirecting... </p>";
        echo '</div>';
        include_once '../html/scripts.html';
    }
?>
<?php include_once '../html/scripts.html';?>
<?php redirect() ?>