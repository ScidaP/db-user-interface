<?php include 'html/head-index.html';?>
<h1 class="company-title">Any title you'd like</h1>
<section class="mprincipal mprincipal-logueo">
    <form action="php/logueo_ok.php" method="POST" class="mx-auto form-login">
        <div class="input-group mb-4 mt-5">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="usuario" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" id="password" aria-describedby="basic-addon1" name="pass" required>
            <span class="pass-eye"><i class="fas fa-eye" id="eye" onclick="toggle()"></i></span>
        </div>
        <button class="btn btn-primary iniciar-sesion" type="submit">Log in</button>
    </form>
</section>
<?php include 'html/scripts-index.html';?>
<?php ?>