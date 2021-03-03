<?php 
	session_start();
	include 'funciones.php';
	if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal">';
        include '../html/menu.php';
        echo '<div class="table-container">';
        echo '        <form action="" method="GET">
        <div class="input-group my-4 search-input">
        <input type="text" class="form-control" aria-label="Search" aria-describedby="basic-addon1" placeholder="Search by..." name="search" value="';
        if (empty($_GET)) {
            echo '';
        } else {
            echo $_GET['search'];
        }
        echo '"required>
        <select class="search-select form-select" aria-label="Default select example" name="filtro" required>
            <option value="" disabled selected hidden>Select a filter</option>
            <option value="usuario">Username</option>
            <option value="nombre">First Name</option>
            <option value="apellido">Last Name</option>
            <option value="id">ID</option>
            <option value="tipo_cuenta">Account Level</option>
            <option value="mail">Email</option>
            <option value="numero">Phone Number</option>
        </select>
        <button type="submit" class="btn btn-secondary">
            <i class="fas fa-search"></i>
        </button>
        <a href="search.php">
            <button type="button" class="btn btn-primary mostrar-todo">Show all</button>
        </a>
    </div>
</form>';
	}
?>

<?php include '../html/head.html';?>
<?php 
    echo '<section class="mprincipal">';
    include '../html/menu.php';
    include 'funciones.php';
    echo '<div class="table-container">';
    ?> 
        <form action="" method="GET">
            <div class="input-group my-4 search-input">
                <input type="text" class="form-control" aria-label="Search" aria-describedby="basic-addon1" placeholder="Search by..." name="search" value="<?php 
                    if (empty($_GET)) {
                        echo '';
                    } else {
                        echo $_GET['search'];
                    }
                ?>"required>
                <select class="search-select form-select" aria-label="Default select example" name="filtro" required>
                    <option value="" disabled selected hidden>Select a filter</option>
                    <option value="usuario">Username</option>
                    <option value="nombre">First Name</option>
                    <option value="apellido">Last Name</option>
                    <option value="id">ID</option>
                    <option value="tipo_cuenta">Account Level</option>
                    <option value="mail">Email</option>
                    <option value="numero">Phone Number</option>
                </select>
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-search"></i>
                </button>
                <a href="search.php">
                    <button type="button" class="btn btn-primary mostrar-todo">Show all</button>
                </a>
            </div>
        </form>
    <?php
    $conectar = conectar();
    $consulta = 'SELECT * FROM usuarios';
    $enviarConsulta = mysqli_query($conectar, $consulta);
    if (empty($_GET)) {
        if (mysqli_num_rows($enviarConsulta) > 0) {
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
                echo '<td class="td-pref">
                <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ' . $fila['id'] . '
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="modificar.php?id=' . $fila['id'] . '">Modify User</a></li>
                  <li><a class="dropdown-item" href="eliminar.php?id=' . $fila['id'] . '">Delete User</a></li>
                </ul>
                </div></td>';
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
            echo '</div>';
            echo '</section>';
        }
    } else {
        $busqueda = $_GET['search'];
        $filtro = $_GET['filtro'];
        $consultaBusqueda = 'SELECT * FROM usuarios WHERE ' . $filtro . ' like \'%' . $busqueda . '%\'';
        $enviarConsultaBusqueda = mysqli_query($conectar, $consultaBusqueda);
        $cantidadResultados = mysqli_num_rows($enviarConsultaBusqueda);
        if ($cantidadResultados > 0) {
            if ($cantidadResultados == 1) {
                echo '<h2 class="ms-4">' . $cantidadResultados . " result found </h2>";
            } else {
                echo '<h2 class="ms-4">' . $cantidadResultados . " results found </h2>";
            }
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
            while ($fila = mysqli_fetch_array($enviarConsultaBusqueda)) {
                echo "<tr>";
                echo '<td class="td-pref">
                <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ' . $fila['id'] . '
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="modificar.php?id=' . $fila['id'] . '">Modify User</a></li>
                  <li><a class="dropdown-item" href="eliminar.php?id=' . $fila['id'] . '">Delete User</a></li>
                </ul>
                </div></td>';
                echo "<td class=\"td-pref\">" . $fila['usuario'] . "</td>";
                echo "<td class=\"td-pref\">" . $fila['nombre'] . "</td>";
                echo "<td class=\"td-pref\">" . $fila['apellido'] . "</td>";
                echo "<td class=\"td-pref\">" . $fila['tipo_cuenta'] . "</td>";
                echo "<td class=\"td-pref\">" . $fila['mail'] . "</td>";
                echo "<td class=\"td-pref\">" . $fila['fecha_cuenta'] . "</td>";
                echo "<td class=\"td-pref\">" . $fila['numero'] . "</td>";
                echo "</tr>";
            }
            echo '</table>';
            echo '</div>';
            echo '</section>';
        } else {
            echo '<div class="no-results">';
            echo "<h2> No results found for query '" . $busqueda . "'. </h2>";
            echo "<p> Try again. </p>";
            echo "</div>";
        }
    }
?>
<?php include '../html/scripts.html';?>