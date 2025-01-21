<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['filter'=>'authGuard']);
$routes->get('/inicio', 'Home::index',['filter'=>'authGuard']);
//http://localhost/talleres/inicio2?id=1
$routes->match(['get','post'],'/inicioGet', 'Home::inicioGet');
$routes->get('/formulario', 'Home::formulario',['filter'=>'authGuard']);

$routes->match( ['get','post'],'/verificar', 'Home::comprobar');



$routes->match( ['get','post'],'/SiginController/loginAuth', 'SiginController::loginAuth');
$routes->get('/salir', 'ProfileController::cerrar_sesion');

$routes->get('/sigin', 'SiginController::index',['filter'=>'noauthGuard']);


//ROLES
$routes->get('/roles', 'RolesController::index');
$routes->get('/roles/nuevo', 'RolesController::nuevo');
$routes->match( ['get','post'],'/roles/crear', 'RolesController::crear');
$routes->match( ['get','post'],'/roles/editar', 'RolesController::editar');
$routes->match( ['get','post'],'/roles/actualizar', 'RolesController::actualizar');
$routes->match( ['get','post'],'/roles/eliminar', 'RolesController::delete');

//USUARIOS
$routes->get('/usuarios', 'UsuariosController::index');
$routes->get('/usuarios/nuevo', 'UsuariosController::nuevo');
$routes->match( ['get','post'],'/usuarios/crear', 'UsuariosController::crear');
$routes->match( ['get','post'],'/usuarios/editar', 'UsuariosController::editar');
$routes->match( ['get','post'],'/usuarios/actualizar', 'UsuariosController::actualizar');
$routes->match( ['get','post'],'/usuarios/eliminar', 'UsuariosController::delete');
$routes->get('/usuarios/grafica', 'UsuariosController::grafica');
$routes->get('/usuarios/grafica2', 'UsuariosController::grafica2');

$routes->get('/usuarios/grafica3', 'UsuariosController::grafica3');

$routes->get('/usuarios/graficas', 'UsuariosController::graficas');

$routes->match( ['get','post'],'/usuarios/exportar', 'UsuariosController::exportar');

//PROVINCIAS
$routes->get('/provincias', 'ProvinciasController::index');
$routes->get('/provincias/nuevo', 'ProvinciasController::nuevo');
$routes->match( ['get','post'],'/provincias/crear', 'ProvinciasController::crear');
$routes->match( ['get','post'],'/provincias/editar', 'ProvinciasController::editar');
$routes->match( ['get','post'],'/provincias/actualizar', 'ProvinciasController::actualizar');
$routes->match( ['get','post'],'/provincias/eliminar', 'ProvinciasController::delete');

//LOCALIDADES
$routes->get('/localidades', 'LocalidadesController::index');
$routes->get('/localidades/nuevo', 'LocalidadesController::nuevo');
$routes->match( ['get','post'],'/localidades/crear', 'LocalidadesController::crear');
$routes->match( ['get','post'],'/localidades/editar', 'LocalidadesController::editar');
$routes->match( ['get','post'],'/localidades/actualizar', 'LocalidadesController::actualizar');
$routes->match( ['get','post'],'/localidades/eliminar', 'LocalidadesController::delete');

//DISTRIBUIDORES

$routes->get('/distribuidores', 'DistribuidoresController::index');
$routes->get('/distribuidores/nuevo', 'DistribuidoresController::nuevo');
$routes->match( ['get','post'],'/distribuidores/crear', 'DistribuidoresController::crear');
$routes->match( ['get','post'],'/distribuidores/editar', 'DistribuidoresController::editar');
$routes->match( ['get','post'],'/distribuidores/actualizar', 'DistribuidoresController::actualizar');
$routes->match( ['get','post'],'/distribuidores/eliminar', 'DistribuidoresController::delete');

// //INMUEBLES USO
// $routes->get('/inmuebles_usos', 'Inmuebles_usosController::index');
// $routes->get('/inmuebles_usos/nuevo', 'Inmuebles_usosController::nuevo');
// $routes->match( ['get','post'],'/inmuebles_usos/crear', 'Inmuebles_usosController::crear');
// $routes->match( ['get','post'],'/inmuebles_usos/editar', 'Inmuebles_usosController::editar');
// $routes->match( ['get','post'],'/inmuebles_usos/actualizar', 'Inmuebles_usosController::actualizar');
// $routes->match( ['get','post'],'/inmuebles_usos/eliminar', 'Inmuebles_usosController::delete');
// $routes->match( ['get','post'],'/inmuebles_usos/exportar', 'Inmuebles_usosController::exportar');
// $routes->match( ['get','post'],'/inmuebles_usos/imprimir', 'Inmuebles_usosController::imprimir');