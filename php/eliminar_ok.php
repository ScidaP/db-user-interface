<?php include '../html/head.html';?>
<?php 
    if (!empty($_POST)) {
        include 'funciones.php';
        $id = $_POST['id'];
        $consulta = 'DELETE FROM usuarios WHERE id=\'' . $id . '\'';
        $conexion = conectar();
        $enviarConsulta = mysqli_query($conexion, $consulta);
        if ($enviarConsulta) {
            redirecting();
        } else {
            echo "<h2> User couldn't be deleted due to an unknown error. </h2>";
            echo "<p> Try again later. </p>";
            header("refresh:2;url=search.php");
        }
    } else {
        echo "<h2> Error. Try again. </h2>";
        echo "<p> Redirecting... </p>";
        header("refresh:2;url=search.php");
    }
?>
<?php include '../html/scripts.html';?>