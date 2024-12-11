<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas de las páginas
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');
$routes->get('contacto', 'Home::contacto');
$routes->get('quienesSomos', 'Home::quienes_somos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('terminosyUsos', 'Home::terminos_usos');
$routes->get('registrarse', 'Home::registrarse'); // Ruta para mostrar el formulario
$routes->get('iniciarSesion', 'Home::iniciar_sesion');
$routes->post('iniciarSesion', 'sesionController::iniciarSesion');
$routes->get('cerrarSesion', 'sesionController::cerrarSesion');
$routes->get('misDatos', 'Home::modificarDatos');
$routes->post('misDatos', 'Home::modificar');
$routes->get('productos', 'productosController::productos'); // Ruta para listar productos
$routes->post('productos/modificar', 'productosController::modificarProducto'); // Ruta para modificar producto
$routes->post('productos/eliminar', 'productosController::eliminarProducto'); // Ruta para eliminar producto
$routes->post('registrarse', 'Home::registrarUsuario');