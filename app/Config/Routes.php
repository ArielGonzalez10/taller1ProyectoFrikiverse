<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Rutas de las paginas
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');
$routes->get('contacto', 'Home::contacto');
$routes->get('quienesSomos', 'Home::quienes_somos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('terminosyUsos', 'Home::terminos_usos');
$routes->get('iniciarSesion', 'Home::iniciar_sesion');
$routes->get('registrarse', 'Home::registrarse'); // Ruta para mostrar el formulario
$routes->post('registrarse', 'Controllers::registro');   // Ruta para procesar el registro
$routes->post('contacto', 'Controllers::contactarse');   // Ruta para procesar el registro