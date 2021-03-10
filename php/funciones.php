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

    function validarUsername($nombre) {
        // Username regex
        $usernameRegex = '/^[A-Za-z\d]{4,20}$/'; 
        if (strlen($nombre) < 4) {
            return "Username must have at least 4 characters";
        }
        if (strlen($nombre) > 20) {
            return "Username must have no more than 20 characters";
        }
        if (!preg_match($usernameRegex, $nombre)) {
            return "Username only accepts letters and numbers";
        }
    }

    function validarPassword($pass) {
        $passwordRegex = '/^[A-Za-z\d]{8,28}$/';
        if (strlen($pass) < 8) {
            return "Password must have at least 8 characters";
        }
        if (strlen($pass) > 28) {
            return "Password must have no more than 28 characters";
        }
        if (!preg_match($passwordRegex, $pass)) {
            return "Password can only contain letters, numbers and \$._%";
        }
    }

    function validarMail($mail) {
        $emailRegex = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}$/';
        if (!preg_match($emailRegex, $mail)) {
            return "Email adress is invalid";
        }
    }

    function validarNumero($numero) {
        $numeroRegex = '/^[\d\+]+$/';
        if (!preg_match($numeroRegex, $numero)) {
            return "Invalid phone number. Use only numbers and '+'";
        }
    }
?>