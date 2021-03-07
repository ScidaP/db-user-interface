<?php 
	session_start();
    include 'funciones.php';
    if (!empty($_SESSION['usuario'])) {
        include '../html/head.html';
        echo '<section class="mprincipal mprincipal-pref">';
        include '../html/menu.php';
        echo '<form action="preferencias_ok.php" class="form-pref mt-5" method="POST">
        <div class="input-group m-4">
            <p class="fs-3 me-3">Search Table Font Size</p>
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-plus"></i></span>
            <select class="form-select" aria-label="Default select example" name="table_size">
                <option value="" disabled selected hidden>Choose table font size</option>
                <option value="1"';
        if (!empty($_COOKIE[$_SESSION['usuario']])) {
           if ($_COOKIE[$_SESSION['usuario']] == '1') {
                echo 'selected';
            }
        }
        echo '>1</option>
        <option value="2"';
        if (!empty($_COOKIE[$_SESSION['usuario']])) {
            if ($_COOKIE[$_SESSION['usuario']] == '2') {
                echo 'selected';
            }
        }
        echo '>2</option>
        <option value="3"';
        if (!empty($_COOKIE[$_SESSION['usuario']])) {
            if ($_COOKIE[$_SESSION['usuario']] == '3') {
                echo 'selected';
            }
        }
        echo '>3 (default)</option>
        <option value="4"';
        if (!empty($_COOKIE[$_SESSION['usuario']])) {
            if ($_COOKIE[$_SESSION['usuario']] == '4') {
                echo 'selected';
            }
        }
        echo '>4</option>
        <option value="5"';
        if (!empty($_COOKIE[$_SESSION['usuario']])) {
            if ($_COOKIE[$_SESSION['usuario']] == '5') {
                echo 'selected';
            }
        }
        echo '>5</option>
        </select>
    </div>
    <hr class="hr">
    <div class="input-group m-4">
        <p class="fs-3 me-3">Change your avatar</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cambiarAvatarUsuario">
            Select avatar
        </button>
        <div class="modal fade" id="cambiarAvatarUsuario" tabindex="-1" aria-labelledby="cambiarAvatar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarAvatar">Select your avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body elegir-avatar">';
        $dir_name = "../profilepics/";
        $images = glob($dir_name. "*.png");
        $value = 1;
        foreach($images as $image) {
            echo '<div class="form-check">
           <input class="form-check-input mt-3" type="radio" name="avatar" id="';
            echo 'imagen' . $value;
            echo '" value="';
                echo 'img' . $value . '">
        <label for="imagen' . $value . '"><img src="';
            echo '../profilepics/img' . $value . '.png';
            echo '" class="imagenAvatar"></label></div>';
            $value++;
        }
        echo '</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
        </div>
        </div>
    </div>
</div>
</div>
<hr class="hr">
<button class="btn btn-success ms-4 mt-4 act-pref" type="submit">Update</button>
</form>';
        include '../html/scripts.html';
    } else {
        nologin();
    }
?>
<?php redirect() ?>