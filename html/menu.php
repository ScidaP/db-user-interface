<?php 
  if (!empty($_SESSION['usuario'])) {
    echo '<nav class="nav">
    <div class="user-container">';
    $conectar = conectar();
    $consulta = 'SELECT foto FROM usuarios WHERE usuario=\'' . $_SESSION['usuario'] . '\'';
    $enviarConsulta = mysqli_query($conectar, $consulta);
    $datos = mysqli_fetch_array($enviarConsulta);
    echo '<img src="';
    if (empty($datos['foto'])) {
      echo '../profilepics/img1.png';
    } else {
      echo $datos['foto'];
    }
    echo '" class="foto-perfil" alt="">';
    echo '<div class="user">
        <a href="principal.php" class="username-menu">
            <h2>';
    echo $_SESSION['usuario'] . '</h2>
        </a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Log out</a>
      </div>
    </div>
    <ul>
      <li><a href="agregar.php"><i class="fas fa-user-plus"></i>Add</a></li>
      <li><a href="search.php"><i class="fab fa-searchengin"></i>Search</a></li>
      <li><a href="cambiarpass.php"><i class="fas fa-cog"></i>Change Password</a></li>
      <li><a href="preferencias.php"><i class="fas fa-angle-double-right"></i>Preferences</a></li>
      <li><a href="activity.php"><i class="fas fa-chart-line"></i>Activity</a></li>
    </ul>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Logging out...</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to log out ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a href="cerrarsesion.php">
                <button type="button" class="btn btn-primary">Log out</button>
              </a>
          </div>
        </div>
      </div>
    </div>
  </nav>';
  }
?>