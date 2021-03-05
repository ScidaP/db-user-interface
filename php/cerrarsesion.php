<?php 
    include '../html/head.html';
    include 'funciones.php';
    session_start();
    if (!empty($_SESSION['usuario'])) {
        # --- Agregar a activity.txt ---
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date("d-m-Y H:i", time());
        $activity = $fecha . ';' . $_SESSION['usuario'] . '; logged out';
        guardarDatos($activity);
        echo '<div class="redirecting">';
        echo '<h2>You\'re logging out</h2>';
        session_destroy();
        header('refresh:3;url=../index.php');
        echo '<p> Redirecting... </p>';
        echo '</div>';
    } else {
        nologin();
    }
    include '../html/scripts.html';
?>