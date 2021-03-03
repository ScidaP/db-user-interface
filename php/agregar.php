<?php 
    session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal">';
        include '../html/menu.php';
        echo '<form action="agregar_ok.php" method="POST" class="form-agregar mt-5">
        <h2 class="mb-5">Register a new user into the database</h2>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
            <input type="text" class="form-control" aria-label="First Name" aria-describedby="basic-addon1" placeholder="First Name" name="nombre">
            <span class="input-group-text ml-3" id="basic-addon1">/</span>
            <input type="text" class="form-control" aria-label="Last Name" aria-describedby="basic-addon1" placeholder="Last Name" name="apellido">
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Username" name="usuario" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
            <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon1" placeholder="Password" name="pass" id="password">
            <span class="pass-eye"><i class="fas fa-eye" id="eye" onclick="toggle()"></i></span>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-shield"></i></span>
            <select class="form-select" aria-label="Default select example" name="tipo_cuenta" required>
                <option value="" disabled selected hidden>Account Type</option>
                <option value="Admin">Admin</option>
                <option value="Standard">Standard</option>
                <option value="Guest">Guest</option>
            </select>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
            <input type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1" placeholder="Email" name="mail">
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-clock"></i></span>
            <input type="text" placeholder="';
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        echo date("d-m-Y H:i", time());
        echo '" class="form-control" aria-label="email" aria-describedby="basic-addon1" disabled="disabled" readonly>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
            <input type="text" class="form-control" aria-label="phone number" aria-describedby="basic-addon1" placeholder="Phone Number" name="numero">
        </div>
        <button class="btn btn-primary iniciar-sesion mb-3" type="submit">Add</button>
        <button class="btn btn-secondary iniciar-sesion" type="reset">Clear</button>
    </form>
</section>';
        include '../html/scripts.html';
    } else {
        include '../html/head.html';
        nologin();
        include '../html/scripts.html';
    }
?>