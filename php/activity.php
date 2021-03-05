<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal">';
        include '../html/menu.php';
        $ubicArchivo = '../activity/activity.txt';
        $abrirArchivo = fopen($ubicArchivo, 'r');
        if ($abrirArchivo) {
            echo '<table class="activity-table">';
            echo '<tr><th><i class="far fa-clock"></i></th><th>Activity</th></tr>';
            while (!feof($abrirArchivo)) {
                $linea = fgets($abrirArchivo);
                if (strlen($linea) > 1) {
                    $separado = explode(';', $linea);
                    $consulta = 'SELECT foto FROM usuarios WHERE usuario=\'' . $separado[1] . '\'';
                    $conexion = conectar();
                    $enviarConsulta = mysqli_query($conexion, $consulta);
                    $datos = mysqli_fetch_array($enviarConsulta);
                    echo '<tr><td>' . $separado[0] . '</td><td>';
                    if (!empty($datos['foto'])) {
                        echo '<img class="img-activity me-3" src="' . $datos['foto'] . '">';
                    } else {
                        echo '';
                    }
                    echo '<b>' . $separado[1] . '</b> ' . $separado[2] . '</td></tr>';
                }
            }
            echo '</table>';
        }
        echo '</section>';
        include '../html/scripts.html';
    } else {
        nologin();
    }
?>