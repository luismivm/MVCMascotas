<?php
    // Requerimos el bootstrap Y autoload
    require_once("../bootstrap.php");
    require_once("../vendor/autoload.php");


    use App\Core\Router;
    $router = new Router();

/* PRIMERA /
	accion: indexAction()
		descripcion: muestra todos los perros

SEGUNDA /add
	controlador: mascotasController
	accion: addAction()
		descripcion: añade un nuevo perro

TERCERA /del/nº
	accion: delAction()
		descripcion: borra perro

CUARTA /edit
	accion: editAction()
		descripcion: edita un perro

QUINTA /search?q=(cadena)
	accion: searchAction()
		descripcion: busca un perro */

    $router->add(array(
        'name'=>'primera',
        'path'=>'/^\/$/',
        'action'=> [mascotasController::class,'IndexAction']
    ));

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if($route){
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
    
} else{
    echo "NO route";
}
 