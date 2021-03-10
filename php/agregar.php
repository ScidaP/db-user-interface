<?php
    session_start(); 
    include_once 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        if (!empty($_POST)) {
            include_once '../html/head.html';
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $tipo = $_POST['tipo_cuenta'];
            $mail = $_POST['mail'];
            $fecha = date("d-m-Y H:i", time());
            $numero = $_POST['numero'];
            $foto = '../profilepics/img1.png';
            $errorUsername = validarUsername($usuario);
            $errorPass = validarPassword($pass);
            $errorMail = validarMail($mail);
            $errorNumero = validarNumero($numero);
            if (empty($errorUsername) && empty($errorPass) && empty($errorMail) && empty($errorNumero)) {
                $pass = sha1($pass);
                $conectar = conectar();
                $usuarioIgual = 'SELECT usuario FROM usuarios';
                $enviarUsuarioigual = mysqli_query($conectar, $usuarioIgual);
                $usuariosIguales = false;
                while ($usuarios = mysqli_fetch_array($enviarUsuarioigual)) {
                    if ($usuarios['usuario'] == $usuario) {
                        $usuariosIguales = true;
                    }
                }
                if (!$usuariosIguales) {
                    $consulta = "INSERT INTO usuarios(usuario, pass, nombre, apellido, tipo_cuenta, mail, fecha_cuenta, numero, foto) VALUES ('$usuario', '$pass', '$nombre', '$apellido', '$tipo', '$mail', '$fecha', '$numero', '$foto')";
                    $conexion = conectar();
                    $enviarConsulta = mysqli_query($conexion, $consulta);
                } else {
                    include_once '../html/head.html';
                    echo '<div id="error" class="redirecting agregar"><h2> Username already exists. Try again. </h2>';
                    echo "<p> Redirecting... </p></div>";
                    include_once '../html/scripts.html';
                }
                if ($enviarConsulta) {
                    redirecting();
                    # --- Agregar a activity.txt ---
                    $activity = $fecha . ';' . $_SESSION['usuario'] . ';added <b>' . $usuario . '</b> into the database';
                    guardarDatos($activity);
                }
                include_once '../html/scripts.html'; 
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
        echo '<form action="" method="POST" class="form-agregar mt-5">
        <h2 class="mb-5">Register a new user into the database</h2>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
            <input type="text" class="form-control" aria-label="First Name" aria-describedby="basic-addon1" placeholder="First Name" name="nombre" value="';
        if (!empty($_POST['nombre'])) {
            echo $_POST['nombre'] . '">';
        } else {
            echo '">';
        }
        echo '<span class="input-group-text ml-3" id="basic-addon1">/</span>
            <input type="text" class="form-control" aria-label="Last Name" aria-describedby="basic-addon1" placeholder="Last Name" name="apellido" value="';
        if (!empty($_POST['apellido'])) {
            echo $_POST['apellido'] . '">';
        } else {
            echo '">';
        }
        echo '</div>';
        if (!empty($_POST)) {echo '<div class="errorMsg">' . $errorUsername . '</div>';}
        echo '<div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Username" name="usuario" value="';
            if (!empty($_POST['usuario'])) {
                echo $_POST['usuario'] . '" ';
            } else {
                echo '" ';
            }
        echo 'required></div>';
            if (!empty($_POST)) {echo '<div class="errorMsg">' . $errorPass . '</div>';}
        echo '<div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
            <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon1" placeholder="Password" name="pass" id="password" value="';
        if (!empty($_POST['pass'])) {
            echo $_POST['pass'] . '">';
        } else {
            echo '">';
        }
        echo '<span class="pass-eye"><i class="fas fa-eye" id="eye" onclick="toggle()"></i></span>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-shield"></i></span>
            <select class="form-select" aria-label="Default select example" name="tipo_cuenta" required>
                <option value="" disabled selected hidden>Account Type</option>
                <option value="Admin">Admin</option>
                <option value="Standard">Standard</option>
                <option value="Guest">Guest</option>
            </select>
        </div>';
        if (!empty($_POST)) {echo '<div class="errorMsg">' . $errorMail . '</div>';}
        echo '<div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
            <input type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1" placeholder="Email" name="mail" value="';
        if (!empty($_POST['mail'])) {
            echo $_POST['mail'] . '">';
        } else {
            echo '">';
        }
        echo '</div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-clock"></i></span>
            <input type="text" placeholder="';
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        echo date("d-m-Y H:i", time());
        echo '" class="form-control" aria-label="email" aria-describedby="basic-addon1" disabled="disabled" readonly>
        </div>';
        if (!empty($_POST)) {echo '<div class="errorMsg">' . $errorNumero . '</div>';}
        echo '<div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
            <input type="text" class="form-control" aria-label="phone number" aria-describedby="basic-addon1" placeholder="Phone Number" name="numero" value="';
        if (!empty($_POST['numero'])) {
            echo $_POST['numero'] . '">';
        } else {
            echo '">';
        }
        echo '</div>
        <button class="btn btn-primary iniciar-sesion mb-3" type="submit">Add</button>
    </form>
</section>';
        include_once '../html/scripts.html';
    } else {
        nologin();
    }
?>
<?php redirect() ?>