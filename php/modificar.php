<?php include '../html/head.html';?>
<section class="mprincipal">
<?php
    if (!empty($_GET)) {
        include '../html/menu.php';
        include 'funciones.php';
        $conectar = conectar();
        $id = $_GET['id'];
        $consulta = 'SELECT * FROM usuarios WHERE id=\'' . $id . '\'';
        $enviarConsulta = mysqli_query($conectar, $consulta);
        if (mysqli_num_rows($enviarConsulta) > 0) {
            $fila = mysqli_fetch_array($enviarConsulta);
        }
    }
?>
    <form action="modificar_ok.php" method="POST" class="form-agregar mt-5">
        <h2 class="mb-5">Modify <?php echo $fila['usuario']?>'s data.</h2>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
            <input type="text" class="form-control" aria-label="First Name" aria-describedby="basic-addon1" placeholder="First Name" name="nombre" value="<?php echo $fila['nombre']?>">
            <span class="input-group-text ml-3" id="basic-addon1">/</span>
            <input type="text" class="form-control" aria-label="Last Name" aria-describedby="basic-addon1" placeholder="Last Name" name="apellido"value="<?php echo $fila['apellido']?>">
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Username" name="usuario" value="<?php echo $fila['usuario']?>" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-shield"></i></span>
            <select class="form-select" aria-label="Default select example" name="tipo_cuenta" required>
                <option value="" disabled hidden>Account Type</option>
                <option value="Admin" <?php if ($fila['tipo_cuenta'] == 'Admin') {
                    echo 'selected';
                    }?>>Admin</option>
                <option value="Standard" <?php if ($fila['tipo_cuenta'] == 'Standard') {
                    echo 'selected';
                    }?>>Standard</option>
                <option value="Guest" <?php if ($fila['tipo_cuenta'] == 'Guest') {
                    echo 'selected';
                    }?>>Guest</option>
            </select>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
            <input type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1" placeholder="Email" name="mail" value="<?php echo $fila['mail']?>">
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
            <input type="text" class="form-control" aria-label="phone number" aria-describedby="basic-addon1" placeholder="Phone Number" name="numero" value="<?php echo $fila['numero']?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $fila['id'];?>">
        <button class="btn btn-success iniciar-sesion mb-3" type="submit">Modify</button>
        <a href="search.php">
            <button class="btn btn-primary iniciar-sesion" type="button">Go back</button>
        </a>
    </form>
</section>
<?php include '../html/scripts.html';?>