function redirect(ruta) {
    setTimeout(function (){
        window.location = ruta;
    }, 2500);
}

function nombreClase(elemento) {
    clases = elemento.classList;
    switch (clases[1]) {
        case 'logout':
        case 'nologin':
            ruta = '../index.php';
            break;
        case 'nodelete':
        case 'search':
        case 'nomodify':
            ruta = 'search.php';
            break;
        case 'agregar':
            ruta = 'agregar.php';
            break;
        case 'cambiarpass':
            ruta = 'cambiarpass.php';
            break;
        case 'login':
        case 'nopref':
            ruta = 'principal.php';
            break;
    }
    redirect(ruta);
}