<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        if (!empty($_POST['avatar'])) {
            $prefFoto = '../profilepics/' . $_POST['avatar'] . '.png';
            $conectar = conectar();
            $consulta = 'UPDATE usuarios SET foto=\'' . $prefFoto . '\' WHERE usuario=\'' . $_SESSION['usuario'] . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
            if ($enviarConsulta) {
                redirecting();
            }
        }
        if (!empty($_POST['table_size'])) {
            $pref = $_POST["table_size"];
            $usuario = $_SESSION['usuario'];
            $tiempoExpiracion = time() + 30 * 24 * 60 * 60;
            $crearCookie = setcookie($usuario, $pref, $tiempoExpiracion, '/');
            if ($crearCookie) {
                redirecting();
            } else {
                echo '<div id="error" class="redirecting nopref"><h2>An unknown error occurred. Try again. </h2><p>Redirecting...</p></div>';
                include_once '../html/scripts.html';
            }
        }
    } else {
        nologin();
    }
?>
<?php redirect() ?>