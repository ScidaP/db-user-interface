<?php 
    include 'funciones.php';
    session_start();
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $consulta = 'DELETE FROM usuarios WHERE id=\'' . $id . '\'';
            $conexion = conectar();
            $enviarConsulta = mysqli_query($conexion, $consulta);
            if ($enviarConsulta) {
                redirecting();
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