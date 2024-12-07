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
$routes->get('registrarse', 'Home::registrarse'); // Ruta para mostrar el formulario
$routes->get('iniciarSesion', 'Home::iniciar_sesion'); // Ruta para mostrar el formulario
$routes->post('iniciarSesion', 'Home::inicio_sesion');
$routes->post('contacto', 'Controllers::contactarse');   // Ruta para procesar el registro
$routes->get('cerrarSesion', 'Home::cerrar_sesion');
$routes->get('misDatos', 'Home::modificarDatos');
$routes->post('misDatos', 'Home::modificar');
$routes->get('productos', 'Home::productos');