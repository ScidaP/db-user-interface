<?php
    session_start();
    include_once 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include_once '../html/head.html';
        if (!empty($_POST)) {
            $conectar = conectar();
            $consulta = 'SELECT pass FROM usuarios WHERE usuario = \'' . $_SESSION['usuario'] . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
	        $datos = mysqli_fetch_array($enviarConsulta);
            $errorPass = validarPassword($_POST['nuevapass']);
            if (empty($errorPass)) {
                $consulta2 = 'UPDATE usuarios SET pass = \'' . sha1($_POST['nuevapass']) . '\' WHERE usuario=\'' . $_SESSION['usuario'] . '\'';
                $consultaCambiarPass = mysqli_query($conectar, $consulta2);
                if ($consultaCambiarPass) {
                    redirecting();
                } else {
                    echo '<div id="error" class="redirecting cambiarpass"><h2>An unknown error occurred. Try again later.</h2>';
                    echo '<p>Redirecting...</p></div>';
                }
            }
        }
    } else {
        nologin();
    }
?>
<?php 
    include_once 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include_once '../html/head.html';
        echo '<section class="mprincipal">';
        include_once '../html/menu.php';
        echo '<form action="" method="POST" class="form-cambiarpass mt-5">';
        if (!empty($errorPass)) {echo '<div class="alert alert-danger" role="alert">' . $errorPass . '<i class="fas fa-chevron-down"></i></div>';}
        echo '<div class="input-group mb-4">
            <span class="input-group-text ml-3" id="basic-addon1"><b>*</b></span>
            <input type="text" class="form-control" aria-label="Old Password" aria-describedby="basic-addon1" placeholder="Old Password" name="passvieja">
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text ml-3" id="basic-addon1"><b>*</b></span>
            <input type="password" class="form-control" aria-label="New Password" aria-describedby="basic-addon1" placeholder="New Password" name="nuevapass" id="password">
            <span class="pass-eye"><i class="fas fa-eye" id="eye" onclick="toggle()"></i></span>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text ml-3" id="basic-addon1"><b>*</b></span>
            <input type="password" class="form-control" aria-label="Confirm New Password" aria-describedby="basic-addon1" placeholder="Confirm New Password" name="confirmarnuevapass">
        </div>
        <input type="hidden" name="tipopass" value="1">
        <button class="btn btn-success iniciar-sesion mb-3" type="submit">Change Password</button>
        <button class="btn btn-primary iniciar-sesion" type="reset">Clear</button>
    </form></section>';
    include_once '../html/scripts.html';
    } else {
        nologin();
    }
?>
<?php redirect() ?>