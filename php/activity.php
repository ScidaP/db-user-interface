<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        $conexion = conectar();
        include '../html/head.html';
        echo '<section class="mprincipal">';
        include '../html/menu.php';
        $archivo = file('../activity/activity.txt');
        $archivo = array_reverse($archivo);
        echo '<div class="table-container activity-container">';
        echo '<table class="activity-table">';
        echo '<tr><th><i class="far fa-clock"></i></th><th>Activity</th></tr>';
        foreach($archivo as $linea) {
            if (strlen($linea) > 1) {
                $separado = explode(';', $linea);
                $consulta = 'SELECT foto FROM usuarios WHERE usuario=\'' . $separado[1] . '\'';
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
        echo '</div>';
        echo '</section>';
        include '../html/scripts.html';
    } else {
        nologin();
    }
?>