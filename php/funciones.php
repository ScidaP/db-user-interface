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
        include '../html/head.html';
        echo '<div class="redirecting">';
        echo "<h2> You didn't log in. Try again. </h2>";
        echo "<p> Redirecting... </p>";
        echo "</div>";
        include '../html/scripts.html';
        header("refresh:2;url=../index.php");
    }

    function usarCookie($preferencia) {
        if (!empty($preferencia)) {
            if ($preferencia == 'moderno') {
                echo '<link rel="stylesheet" href="../css/pref_moderno.css">';
            } else if ($preferencia == 'clasico') {
                echo '<link rel="stylesheet" href="../css/pref_clasico.css">';
            } else if ($preferencia == 'colorido') {
                echo '<link rel="stylesheet" href="../css/pref_colorido.css">';
            }
        }
    }
?>