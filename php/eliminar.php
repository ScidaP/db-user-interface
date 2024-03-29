<?php 
    include 'funciones.php';
    session_start();
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal">';
        if (!empty($_GET)) {
            include '../html/menu.php';
            $id = $_GET['id'];
            $conectar = conectar();
            $consulta = 'SELECT * FROM usuarios WHERE id=\'' . $id . '\'';
            $enviarConsulta = mysqli_query($conectar, $consulta);
            if (mysqli_num_rows($enviarConsulta) > 0) {
                echo '<div class="delete">';
                echo "<h2> You are about to delete the user: </h2>";
                echo "<table>";
                echo "<tr>";
                echo "<th class=\"th-pref\"> ID </th>";
                echo "<th class=\"th-pref\"> Username </th>";
                echo "<th class=\"th-pref\"> First Name </th>";
                echo "<th class=\"th-pref\"> Last Name </th>";
                echo "<th class=\"th-pref\"> Account Level </th>";
                echo "<th class=\"th-pref\"> Email </th>";
                echo "<th class=\"th-pref\"> Date Added </th>";
                echo "<th class=\"th-pref\"> Phone Number </th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($enviarConsulta)) {
                    echo "<tr>";
                    $fila['id'] = $id;
                    echo '<td class="td-pref">' . $id . "</td>";
                    echo '<td class=\"td-pref\">' . $fila['usuario'] . "</td>";
                    echo "<td class=\"td-pref\">" . $fila['nombre'] . "</td>";
                    echo "<td class=\"td-pref\">" . $fila['apellido'] . "</td>";
                    echo "<td class=\"td-pref\">" . $fila['tipo_cuenta'] . "</td>";
                    echo "<td class=\"td-pref\">" . $fila['mail'] . "</td>";
                    echo "<td class=\"td-pref\">" . $fila['fecha_cuenta'] . "</td>";
                    echo "<td class=\"td-pref\">" . $fila['numero'] . "</td>";
                    echo "</tr>";
                }
                echo '</table>';
                echo '<div class="botones-eliminar"><form method="POST" action="eliminar_ok.php">
                <input type="hidden" name="id" value="';
                echo $id;
                echo '"><button class="btn btn-danger delete-button" type="submit">Delete</button>
                </form>
                    <a href="search.php" class="go-back ms-5"><button class="btn btn-primary delete-button" type="button">Go back</button></a></div>';
                echo '</section>';
            } else {
                echo '<div id="error" class="redirecting nodelete">';
                echo "<h2> Error: user doesn't exist. Try again.</h2>";
                echo "<p> Redirecting... </p>";
                echo '</div>';
                include_once '../html/scripts.html';
            }
        } else {
            echo '<div id="error" class="redirecting nodelete"><h2> You didn\'t select a user to be deleted. Try again </h2>';
            echo "<p> Redirecting... </p></div>";
            include_once '../html/scripts.html';
        }
    } else {
        nologin();
    }
?>
<?php redirect() ?>