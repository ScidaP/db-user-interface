<?php 
    include_once 'funciones.php';
    session_start();
    if (!empty($_SESSION['usuario'])) {
        if (isset($_POST['id'])) {
            include_once '../html/head.html';
            $id = $_POST['id'];
            $obtenerUsuario = 'SELECT * FROM usuarios WHERE id=\'' . $id . '\'';
            $conectar = conectar();
            $enviarObtenerUsuario = mysqli_query($conectar, $obtenerUsuario);
            $datos = mysqli_fetch_array($enviarObtenerUsuario);
            $usuario = $_POST['usuario'];
            $mail = $_POST['mail'];
            $numero = $_POST['numero'];
            $errorUsername = validarUsernameModificar($usuario, $datos['usuario']);
            $errorMail = validarMail($mail);
            $errorNumero = validarNumero($numero);
            if (empty($errorUsername) && empty($errorMail) && empty($errorNumero)) {
                $consulta = 'UPDATE usuarios SET ';
                foreach ($_POST as $clave => $valor) {
                    if (!empty($valor) && $clave != 'id') {
                        $consulta .= $clave . '="' . $valor . '", ';
                    }
                }
                $consulta .= 'WHERE ID = ' . $id . ';';
                $consulta = str_replace(", WHERE", " WHERE", $consulta);
                $enviarConsulta = mysqli_query($conectar, $consulta);
                if ($enviarConsulta) {
		    redirecting();
                    # --- Agregar a activity.txt ---
                    date_default_timezone_set("America/Argentina/Buenos_Aires");
                    $fecha = date("d-m-Y H:i", time());
                    $activity = $fecha . ';' . $_SESSION['usuario'] . ';modified <b>' . $datos['usuario'] . '</b>\'s data';
                    guardarDatos($activity);
                    include_once '../html/scripts.html';
                } else {
                    echo '<div id="error" class="redirecting nomodify">';
                    echo "<h2> Unknown error: couldn't modify user data. Try again. </h2>";
                    echo "<p> Redirecting... </p>";
                    echo '</div>';
                    include_once '../html/scripts.html';
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
        if (!empty($_GET)) {
            include_once '../html/menu.php';
            $conectar = conectar();
            $id = $_GET['id'];
            $consulta = 'SELECT * FROM usuarios WHERE id=\'' . $id . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
            if (mysqli_num_rows($enviarConsulta) > 0) {
                $fila = mysqli_fetch_array($enviarConsulta);
                echo '    <form action="" method="POST" class="form-agregar mt-5">
                <h2 class="mb-5">Modify ';
                echo $fila['usuario'];
                echo '\'s data.</h2>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                    <input type="text" class="form-control" aria-label="First Name" aria-describedby="basic-addon1" placeholder="First Name" name="nombre" value="';
                    if (!empty($_POST)) {
                        echo $_POST['nombre'];
                    } else {
                        echo $fila['nombre'];
                    }
                echo '">
                <span class="input-group-text ml-3" id="basic-addon1">/</span>
                <input type="text" class="form-control" aria-label="Last Name" aria-describedby="basic-addon1" placeholder="Last Name" name="apellido"value="';
                if (!empty($_POST)) {
                    echo $_POST['apellido'];
                } else {
                    echo $fila['apellido'];
                }
                echo '">
                </div>';
                if (!empty($_POST) && !empty($errorUsername)) {echo '<div class="alert alert-danger" role="alert">' . $errorUsername . '<i class="fas fa-chevron-down"></i></div>';}
                echo '<div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Username" name="usuario" value="';
                if (!empty($_POST)) {
                    echo $_POST['usuario'];
                } else {
                    echo $fila['usuario'];
                }
                echo '">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-shield"></i></span>
                    <select class="form-select" aria-label="Default select example" name="tipo_cuenta" required>
                        <option value="" disabled hidden>Account Type</option>
                        <option value="Admin" ';
                if ($fila['tipo_cuenta'] == 'Admin') {
                    echo 'selected';
                }
                echo '>Admin</option>
                <option value="Standard" ';
                if ($fila['tipo_cuenta'] == 'Standard') {
                    echo 'selected';
                }
                echo '>Standard</option>
                <option value="Guest" ';
                if ($fila['tipo_cuenta'] == 'Guest') {
                    echo 'selected';
                }
                echo '>Guest</option>
                </select>
            </div>';
            if (!empty($_POST) && !empty($errorMail)) {echo '<div class="alert alert-danger" role="alert">' . $errorMail . '<i class="fas fa-chevron-down"></i></div>';}
            echo '<div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                <input type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1" placeholder="Email" name="mail" value="';
                if (!empty($_POST)) {
                    echo $_POST['mail'];
                } else {
                    echo $fila['mail'];
                }
                echo '">
                </div>';
                if (!empty($_POST) && !empty($errorNumero)) {echo '<div class="alert alert-danger" role="alert">' . $errorNumero . '<i class="fas fa-chevron-down"></i></div>';}
                echo '<div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
                    <input type="text" class="form-control" aria-label="phone number" aria-describedby="basic-addon1" placeholder="Phone Number" name="numero" value="';
                    if (!empty($_POST)) {
                        echo $_POST['numero'];
                    } else {
                        echo $fila['numero'];
                    }
                echo '">
                </div>
                <input type="hidden" name="id" value="';
                echo $fila['id'];
                echo '">
                <button class="btn btn-success iniciar-sesion mb-3" type="submit">Modify</button>
                <a href="search.php">
                    <button class="btn btn-primary iniciar-sesion" type="button">Go back</button>
                </a>
            </form>
        </section>';
                include_once '../html/scripts.html';
            } else {
                echo '<div id="error" class="redirecting nomodify">';
                echo "<h2> Error: user doesn't exist. Try again.</h2>";
                echo "<p> Redirecting... </p>";
                echo '</div>';
                include_once '../html/scripts.html';
            }
        } else {
            echo '<div id="error" class="redirecting nomodify">';
            echo "<h2> Error: you didn't select any user. Try again.</h2>";
            echo "<p> Redirecting... </p>";
            echo '</div>';
            include_once '../html/scripts.html';
        }
    } else {
        nologin();
    }
?>
<?php redirect();?>