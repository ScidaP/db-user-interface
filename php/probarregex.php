<?php 
    include 'funciones.php';
    if (!empty($_POST)) {
        $error = validarPassword($_POST['pass']);
    }
?>

<form action="" method="POST">
<input type="text" name="pass">
<input type="submit" value="Enviar"></form>
<?php if (!empty($error)) { echo $error . '<br>';}
if (isset($_POST)) {echo 'Ultima pass usada:' . $_POST['pass'];}?>