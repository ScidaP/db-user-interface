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

    function validarUsernameAgregar($nombrePost) {
        // Username regex
        $usernameRegex = '/^[A-Za-z\d]{4,20}$/';
        $conectar = conectar();
        $usuarioIgual = 'SELECT usuario FROM usuarios';
        $enviarUsuarioigual = mysqli_query($conectar, $usuarioIgual);
        $usuariosIguales = false;
        while ($usuarios = mysqli_fetch_array($enviarUsuarioigual)) {
            if ($usuarios['usuario'] == $nombrePost) {
                $usuariosIguales = true;
            }
        }
        if ($usuariosIguales) {
            return "Username already exists";
        }
        if (strlen($nombrePost) < 4) {
            return "Username must have at least 4 characters";
        }
        if (strlen($nombrePost) > 20) {
            return "Username must have no more than 20 characters";
        }
        if (!preg_match($usernameRegex, $nombrePost)) {
            return "Username only accepts letters and numbers";
        }
    }

    function validarUsernameModificar($nombrePost, $nombreDB) {
        // Username regex
        $usernameRegex = '/^[A-Za-z\d]{4,20}$/';
        $conectar = conectar();
        $usuarioIgual = 'SELECT usuario FROM usuarios WHERE usuario != \'' . $nombreDB . '\'';
        $enviarUsuarioigual = mysqli_query($conectar, $usuarioIgual);
        $usuariosIguales = false;
        while ($usuarios = mysqli_fetch_array($enviarUsuarioigual)) {
            if ($usuarios['usuario'] == $nombrePost) {
                $usuariosIguales = true;
            }
        }
        if ($usuariosIguales) {
            return "Username already exists";
        }
        if (strlen($nombrePost) < 4) {
            return "Username must have at least 4 characters";
        }
        if (strlen($nombrePost) > 20) {
            return "Username must have no more than 20 characters";
        }
        if (!preg_match($usernameRegex, $nombrePost)) {
            return "Username only accepts letters and numbers";
        }
    }

    function validarPassword($pass) {
        if ($_POST['tipopass'] == 1) {
            $conectar = conectar();
            $consulta = 'SELECT pass FROM usuarios WHERE usuario = \'' . $_SESSION['usuario'] . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
            if ($enviarConsulta) {
                $datos = mysqli_fetch_array($enviarConsulta);
                if (($datos['pass']) != sha1($_POST['passvieja'])) {
                    $passIncorrecta = "Old password is incorrect. Try again.";
                    return $passIncorrecta;
                }
                if ($_POST['nuevapass'] != $_POST['confirmarnuevapass']) {
                    $passNoCoinciden = "Passwords don't match. Try again.";
                    return $passNoCoinciden;
                }
            }
        }
        $passwordRegex = '/^[A-Za-z\d$\._%]{8,28}$/';
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
        $emailRegex = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (!preg_match($emailRegex, $mail)) {
            return "Email adress is invalid";
        }
    }

    function validarNumero($numero) {
        $numeroRegex = '/^[\d\+]+$/';
        if (!preg_match($numeroRegex, $numero)) {
            return "Phone number can only contain numbers and '+'";
        }
    }
?>