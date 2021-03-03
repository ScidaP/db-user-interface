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
            echo '<div class="redirecting">';
            echo "<p> Correct username. </p>";
            echo "<p> Redirecting...";
            echo "</div>";
            header("refresh:3;url=principal.php");
        } else {
            echo '<div class="redirecting">';
            echo "<p> Incorrect username or password.</p>";
            echo "<p> Redirecting... </p>";
            echo '</div>';
            header("refresh:3;url=../index.php");
        }
    }
?>
<?php include '../html/scripts.php';?>