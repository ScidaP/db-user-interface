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
            if ($enviarConsulta) {
                redirecting();
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