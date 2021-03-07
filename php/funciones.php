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
        echo '<div id="error" class="redirecting search">';
        echo "<h2> Changes saved successfully. </h2>";
        echo "<p> Redirecting... </p>";
        echo "</div>";
        include_once '../html/scripts.html';
    }

    function nologin() {
        include '../html/head.html';
        echo '<div id="error" class="redirecting nologin">';
        echo "<h2> You didn't log in. Try again. </h2>";
        echo "<p> Redirecting... </p>";
        echo "</div>";
        include_once '../html/scripts.html';
    }

    function guardarDatos($a) {
        $nombreArchivo = '../activity/activity.txt';
        $archivo = fopen($nombreArchivo, 'a+');
        fputs($archivo, $a . PHP_EOL);
        fclose($archivo);
    }

    function redirect() {
        echo '<script type="text/javascript">
        $error = document.getElementById("error");
        nombreClase($error);
        </script>';
    }
?>