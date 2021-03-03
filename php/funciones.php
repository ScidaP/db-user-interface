<?php 
    function conectar() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'interfacetest';
        $conectar = mysqli_connect($host, $user, $pass, $db);
        if ($conectar) {
            return($conectar);
        }
    }

    function desconectar($conexion) {
        if ($conexion) {
            $desconectar = mysqli_close($conexion);
        }
    }

    function redirecting() {
        echo '<div class="redirecting">';
        echo "<h2> Changes saved successfully. </h2>";
        echo "<p> Redirecting... </p>";
        echo "</div>";
        header("refresh:2;url=search.php");
    }

    function nologin() {
        echo '<div class="redirecting">';
        echo "<h2> You didn't log in. Try again. </h2>";
        echo "<p> Redirecting... </p>";
        echo "</div>";
        header("refresh:2;url=../index.php");
    }
?>