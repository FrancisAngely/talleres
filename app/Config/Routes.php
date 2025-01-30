<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::inicio', ['filter' => 'authGuard']);
$routes->get('/inicio', 'Home::inicio', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/inicioGet', 'Home::inicioGet');
$routes->get('/formulario', 'Home::formulario', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/verificar', 'Home::comprobar');
$routes->get('image/display', 'ImageController::display');
$routes->match(['get', 'post'], '/SiginController/loginAuth', 'SiginController::loginAuth');
$routes->get('/salir', 'ProfileController::cerrar_sesion');
$routes->get('/sigin', 'SiginController::index', ['filter' => 'noauthGuard']);


//ROLES
$routes->get('/roles', 'RolesController::index');
$routes->get('/roles/nuevo', 'RolesController::nuevo');
$routes->match(['get', 'post'], '/roles/crear', 'RolesController::crear');
$routes->match(['get', 'post'], '/roles/editar', 'RolesController::editar');
$routes->match(['get', 'post'], '/roles/actualizar', 'RolesController::actualizar');
$routes->match(['get', 'post'], '/roles/eliminar', 'RolesController::delete');

//USUARIOS
$routes->get('/usuarios', 'UsuariosController::index');
$routes->get('/usuarios/nuevo', 'UsuariosController::nuevo');
$routes->match(['get', 'post'], '/usuarios/crear', 'UsuariosController::crear');
$routes->match(['get', 'post'], '/usuarios/editar', 'UsuariosController::editar');
$routes->match(['get', 'post'], '/usuarios/actualizar', 'UsuariosController::actualizar');
$routes->match(['get', 'post'], '/usuarios/eliminar', 'UsuariosController::delete');


//PROVINCIAS
$routes->get('/provincias', 'ProvinciasController::index');
$routes->get('/provincias/nuevo', 'ProvinciasController::nuevo');
$routes->match(['get', 'post'], '/provincias/crear', 'ProvinciasController::crear');
$routes->match(['get', 'post'], '/provincias/editar', 'ProvinciasController::editar');
$routes->match(['get', 'post'], '/provincias/actualizar', 'ProvinciasController::actualizar');
$routes->match(['get', 'post'], '/provincias/eliminar', 'ProvinciasController::delete');

//LOCALIDADES
$routes->get('/localidades', 'LocalidadesController::index');
$routes->get('/localidades/nuevo', 'LocalidadesController::nuevo');
$routes->match(['get', 'post'], '/localidades/crear', 'LocalidadesController::crear');
$routes->match(['get', 'post'], '/localidades/editar', 'LocalidadesController::editar');
$routes->match(['get', 'post'], '/localidades/actualizar', 'LocalidadesController::actualizar');
$routes->match(['get', 'post'], '/localidades/eliminar', 'LocalidadesController::delete');

//DISTRIBUIDORES

$routes->get('/distribuidores', 'DistribuidoresController::index');
$routes->get('/distribuidores/nuevo', 'DistribuidoresController::nuevo');
$routes->match(['get', 'post'], '/distribuidores/crear', 'DistribuidoresController::crear');
$routes->match(['get', 'post'], '/distribuidores/editar', 'DistribuidoresController::editar');
$routes->match(['get', 'post'], '/distribuidores/actualizar', 'DistribuidoresController::actualizar');
$routes->match(['get', 'post'], '/distribuidores/eliminar', 'DistribuidoresController::delete');
$routes->match(['get', 'post'], '/distribuidores/exportar', 'DistribuidoresController::exportar');
$routes->match(['get', 'post'], '/distribuidores/imprimir', 'DistribuidoresController::imprimir');

//MODELOS
$routes->get('/modelos', 'ModelosController::index');
$routes->get('/modelos/nuevo', 'ModelosController::nuevo');
$routes->match(['get', 'post'], '/modelos/crear', 'ModelosController::crear');
$routes->match(['get', 'post'], '/modelos/editar', 'ModelosController::editar');
$routes->match(['get', 'post'], '/modelos/actualizar', 'ModelosController::actualizar');
$routes->match(['get', 'post'], '/modelos/eliminar', 'ModelosController::delete');

//TALLERES
$routes->get('/talleres', 'talleresController::index');
$routes->get('/talleres/nuevo', 'talleresController::nuevo');
$routes->match(['get', 'post'], '/talleres/crear', 'talleresController::crear');
$routes->match(['get', 'post'], '/talleres/editar', 'talleresController::editar');
$routes->match(['get', 'post'], '/talleres/actualizar', 'talleresController::actualizar');
$routes->match(['get', 'post'], '/talleres/eliminar', 'talleresController::delete');
$routes->match(['get', 'post'], '/talleres/imprimir', 'talleresController::imprimir');
$routes->get('/talleres/graficas', 'talleresController::graficas');
