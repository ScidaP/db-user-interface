<?php include '../html/head.html';?>
<?php 
    if (isset($_POST['id'])) {
        include 'funciones.php';
        $conectar = conectar();
        $consulta = 'UPDATE usuarios SET ';
        foreach ($_POST as $clave => $valor) {
            if (!empty($valor) && $clave != 'id') {
                $consulta .= $clave . '="' . $valor . '", ';
            }
        }
        $id = $_POST['id'];
        $consulta .= 'WHERE ID = ' . $id . ';';
        $consulta = str_replace(", WHERE", " WHERE", $consulta);
        $enviarConsulta = mysqli_query($conectar, $consulta);
        if ($enviarConsulta) {
            redirecting();
        } else {
            echo "<h2> Unknown error: couldn't modify user data. Try again. </h2>";
            echo "<p> Redirecting... </p>";
            header("refresh:2;url=search.php");
        }
    } else {
        echo "<h2> You didn't send the form. Try again.</h2>";
        echo "<p> Redirecting... </p>";
        header("refresh:2;url=search.php");
    }
?>
<?php include '../html/scripts.html';?>