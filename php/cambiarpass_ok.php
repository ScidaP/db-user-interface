<?php
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        if (!empty($_POST)) {
            $conectar = conectar();
            $consulta = 'SELECT pass FROM usuarios WHERE usuario = \'' . $_SESSION['usuario'] . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
            if ($enviarConsulta) {
                $datos = mysqli_fetch_array($enviarConsulta);
                if ($datos['pass'] == sha1($_POST['passvieja'])) {
                    if ($_POST['nuevapass'] == $_POST['confirmarnuevapass']) {
                        $consulta2 = 'UPDATE usuarios SET pass = \'' . sha1($_POST['nuevapass']) . '\' WHERE usuario=\'' . $_SESSION['usuario'] . '\'';
                        $consultaCambiarPass = mysqli_query($conectar, $consulta2);
                        if ($consultaCambiarPass) {
                            redirecting();
                        } else {
                            echo '<div class="redirecting"><h2> An unknown error occurred. Try again. </h2><p>
                            Redirecting... </p>';
                            echo '</div>';
                            header("refresh:2;url=cambiarpass.php");
                        }
                    } else {
                        echo '<div class="redirecting"><h2>Passwords don\'t match. Try again.</p>';
                        echo "<p>Redirecting... </p>'";
                        echo '</div>';
                        header("refresh:2;url=cambiarpass.php");
                    }
                } else {
                    echo '<div class="redirecting"><h2>Old password is incorrect. Try again.</p>';
                    echo "<p>Redirecting... </p>'";
                    echo '</div>';
                    header("refresh:2;url=cambiarpass.php");
                }
            } else {
                echo '<div class="redirecting"><h2> An unknown error occurred. Try again. </h2><p>
                Redirecting... </p>';
                echo '</div>';
                header("refresh:2;url=cambiarpass.php");
            }
        } else {
            echo '<div class="redirecting"><h2> You didn\'t fill password change form. Try again. </h2><p>
            Redirecting... </p>';
            echo '</div>';
            header("refresh:2;url=cambiarpass.php");
        }
    } else {
        nologin();
    }
?>
<?php include '../html/scripts.html';?>