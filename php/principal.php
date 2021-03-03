<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal">';
        include '../html/menu.php';
        echo '    <article class="bienvenida">
        <div>
        <h2>Welcome back, ';
        echo $_SESSION['usuario'] . '</h2>';
        echo '<p class="text-muted">';
        $conectar = conectar();
        $consulta = 'SELECT mail FROM usuarios WHERE nombre=\'' . $_SESSION['usuario'] . '\'';
        $enviar = mysqli_query($conectar, $consulta);
        if ($enviar) {
            $datos = mysqli_fetch_array($enviar);
            echo $datos['mail'];
        }
        echo '        </p>
                </div>
            </article>
        </section>';
        include '../html/scripts.html';
    } else {
        include '../html/head.html';
        nologin();
        include '../html/scripts.html';
    }
?>