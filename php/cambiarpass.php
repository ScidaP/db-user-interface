<?php include '../html/head.html';?>
<section class="mprincipal">
<?php include '../html/menu.php';?>
<form action="cambiarpass_ok.php" method="POST" class="form-cambiarpass mt-5">
    <div class="input-group mb-4">
        <span class="input-group-text ml-3" id="basic-addon1"><b>*</b></span>
        <input type="text" class="form-control" aria-label="Old Password" aria-describedby="basic-addon1" placeholder="Old Password" name="passvieja">
    </div>
    <div class="input-group mb-4">
        <span class="input-group-text ml-3" id="basic-addon1"><b>*</b></span>
        <input type="password" class="form-control" aria-label="New Password" aria-describedby="basic-addon1" placeholder="New Password" name="nuevapass" id="password">
        <span class="pass-eye"><i class="fas fa-eye" id="eye" onclick="toggle()"></i></span>
    </div>
    <div class="input-group mb-4">
        <span class="input-group-text ml-3" id="basic-addon1"><b>*</b></span>
        <input type="password" class="form-control" aria-label="Confirm New Password" aria-describedby="basic-addon1" placeholder="Confirm New Password" name="confirmarnuevapass">
    </div>
    <button class="btn btn-success iniciar-sesion mb-3" type="submit">Change Password</button>
    <button class="btn btn-primary iniciar-sesion" type="reset">Clear</button>
</form>
<?php include '../html/scripts.html';?>