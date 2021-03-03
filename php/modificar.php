<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal">';
        if (!empty($_GET)) {
            include '../html/menu.php';
            $conectar = conectar();
            $id = $_GET['id'];
            $consulta = 'SELECT * FROM usuarios WHERE id=\'' . $id . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
            if (mysqli_num_rows($enviarConsulta) > 0) {
                $fila = mysqli_fetch_array($enviarConsulta);
                echo '    <form action="modificar_ok.php" method="POST" class="form-agregar mt-5">
                <h2 class="mb-5">Modify ';
                echo $fila['usuario'];
                echo '\'s data.</h2>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                    <input type="text" class="form-control" aria-label="First Name" aria-describedby="basic-addon1" placeholder="First Name" name="nombre" value="';
                echo $fila['nombre'];
                echo '">
                <span class="input-group-text ml-3" id="basic-addon1">/</span>
                <input type="text" class="form-control" aria-label="Last Name" aria-describedby="basic-addon1" placeholder="Last Name" name="apellido"value="';
                echo $fila['apellido'];
                echo '">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Username" name="usuario" value="';
                echo $fila['usuario'];
                echo '" required>
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
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                <input type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1" placeholder="Email" name="mail" value="';
                echo $fila['mail'];
                echo '">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
                    <input type="text" class="form-control" aria-label="phone number" aria-describedby="basic-addon1" placeholder="Phone Number" name="numero" value="';
                echo $fila['numero'];
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
                include '../html/scripts.html';
            } else {
                echo '<div class="redirecting">';
                echo "<h2> Error: user doesn't exist. Try again.</h2>";
                echo "<p> Redirecting... </p>";
                echo '</div>';
                header("refresh:2;url=search.php");
            }
        } else {
            echo '<div class="redirecting">';
            echo "<h2> Error: you didn't select any user. Try again.</h2>";
            echo "<p> Redirecting... </p>";
            echo '</div>';
            header("refresh:2;url=search.php");
        }
    } else {
        nologin();
    }
?>