<?php include '../html/head.html';?>
<?php
        if (!empty($_POST)) {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $usuario = $_POST['usuario'];
            $pass = sha1($_POST['pass']);
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $tipo = $_POST['tipo_cuenta'];
            $mail = $_POST['mail'];
            $fecha = date("d-m-Y H:i", time());
            $numero = $_POST['numero'];
            include 'funciones.php';
            $consulta = "INSERT INTO usuarios(usuario, pass, nombre, apellido, tipo_cuenta, mail, fecha_cuenta, numero) VALUES ('$usuario', '$pass', '$nombre', '$apellido', '$tipo', '$mail', '$fecha', '$numero')";
            $conexion = conectar();
            $enviarConsulta = mysqli_query($conexion, $consulta);
            if ($enviarConsulta) {
                redirecting();
            }
        } else {
            echo '<div class="redirecting"><h2> You didn\'t complete the add user form. Try again </h2>';
            echo "<p> Redirecting... </p></div>";
            header("refresh:2;url=agregar.php");
        }
?>
<?php include '../html/scripts.html';?>