<?php
session_start();
//Carga de autoload para tener acceso a los objetos/clases de los controladores
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';

function show_error() {
    $error = new errorController();
    $error->index();
}

//Compruba que llegue el controlador por la url
if(isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'].'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
  } else {
    //echo 'La página que buscas no existe';
    show_error();
    exit();
}

//Comprueba si existe la clase/controlador
if(class_exists($nombre_controlador)) {
    //Si existe creamos el objeto
    $controlador = new $nombre_controlador();

    //Comprueba que llega la accion por url, y que existe el controlador
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        //Si existe invocamos al método/acción
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        //echo 'La página que buscas no existe';
        show_error();

    }
} else {
    //echo 'La página que buscas no existe';
    show_error();
}

require_once 'views/layouts/footer.php';
