<?php 
    include '../html/head.html';
    session_start();
    if (!empty($_SESSION['usuario'])) {
        echo '<div class="redirecting">';
        echo '<h2>You\'re logging out</h2>';
        session_destroy();
        header('refresh:3;url=../index.php');
        echo '<p> Redirecting... </p>';
        echo '</div>';
    } else {
        echo '<div class="redirecting">';
        echo '<h2>You didn\'t log in. Try again.</h2>';
        header('refresh:3;url=../index.php');
        echo '<p> Redirecting... </p>';
        echo '</div>';
    }
    include '../html/scripts.html';
?>