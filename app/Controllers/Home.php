<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoriaModel;
use App\Models\ProductoModel;

class Home extends Controller
{

    /*LLama a la pagina principal*/
    public function index()
    {
        $data['titulo'] = 'FrikiVerse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/principal') . view('plantillas/footer');
    }

    /*LLama a la pagina contacto*/
    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto') . view('plantillas/footer');
    }

    /*LLama a la pagina quienes somos*/
    public function quienes_somos()
    {
        $data['titulo'] = '¿Quienes Somos?';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/quienesSomos') . view('plantillas/footer');
    }

    /*LLama a la pagina comercializacion*/
    public function comercializacion()
    {
        $data['titulo'] = 'Comercialización';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/comercializacion') . view('plantillas/footer');
    }

    /*LLama a la pagina terminos y usos*/
    public function terminos_usos()
    {
        $data['titulo'] = 'Términos y Usos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/terminosyUsos') . view('plantillas/footer');
    }

    /*LLama a la pagina iniciar sesión*/
    public function iniciar_sesion()
    {
        $data['titulo'] = 'Iniciar Sesión';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/iniciarSesion') . view('plantillas/footer');
    }

    /*LLama a la pagina de registro*/
    public function registrarse()
    {
        $data['titulo'] = 'Registrarse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/registrarse') . view('plantillas/footer');
    }

    public function modificarDatos()
    {
        $data['titulo'] = 'MisDatos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/misDatos') . view('plantillas/footer');
    }
    public function agregarProducto()
    {
        $data['titulo'] = 'agregarProducto';

        // Obtener categorías desde el productosController
        $categoriasController = new ProductosController(); // Asegúrate de usar la instancia correcta
        $categorias = $categoriasController->obtenerCategorias(); // Cambia 'obtenerCategorias' por el nombre de tu función

        // Cargar la vista
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/agregarProducto', ['categorias' => $categorias]) . view('plantillas/footer');
    }

    public function productos()
    {
        $data['titulo'] = 'Productos';

        // Inicia sesión si aún no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica si hay una sesión iniciada
        if (!isset($_SESSION['idUsuario'])) {
            return redirect()->to('principal'); // Redirige si no hay sesión
        }

        // Obtener el idRol y idUsuario del usuario
        $idRol = $_SESSION['idRol'] ?? null; // Obtiene el idRol, si existe
        $idUsuario = $_SESSION['idUsuario'] ?? null; // Obtiene el idUsuario, si existe

        // Cargar productos y categorías desde los modelos
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();

        $productos = $productoModel->findAll(); // Obtener todos los productos
        $categorias = $categoriaModel->findAll(); // Obtener todas las categorías

        // Pasa los datos a la vista
        return view('plantillas/header', $data) .
            view('plantillas/navbar', [
                'idRol' => $idRol, // Pasa el idRol a la vista de la navbar
                'idUsuario' => $idUsuario // Pasa el idUsuario a la vista de la navbar
            ]) .
            view('front/productos', [
                'productos' => $productos,
                'categorias' => $categorias,
                'idRol' => $idRol, // Pasa el idRol a la vista de productos
                'idUsuario' => $idUsuario // Pasa el idUsuario a la vista de productos
            ]) .
            view('plantillas/footer');
    }

    public function carrito()
    {
        $data['titulo'] = 'Carrito';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/carrito') . view('plantillas/footer');
    }
}