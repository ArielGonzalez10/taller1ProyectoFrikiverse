<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class productosController extends BaseController
{
    protected $productoModel;
    protected $usuarioModel;
    protected $categoriaModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->categoriaModel = new CategoriaModel();
    }

    // Método para cargar la vista de productos
    public function productos()
    {
        // Obtener las categorías
        $categorias = $this->obtenerCategorias();
    
        // Obtener parámetros de búsqueda
        $categoria = $this->request->getGet('categoria'); // Obtener la categoría seleccionada
        $busqueda = $this->request->getGet('busqueda'); // Obtener el término de búsqueda
    
        // Cargar productos según los filtros aplicados
        $productos = $this->cargarProductos($categoria, $busqueda);
    
        // Pasar los datos a la vista
        $data = [
            'productos' => $productos,
            'categorias' => $categorias,
        ];
    
        // Cargar las diferentes partes de la plantilla
        $header = view('plantillas/header');
        $navbar = view('plantillas/navbar');
        $productosView = view('front/productos', $data);
        $footer = view('plantillas/footer');
    
        // Devolver la vista completa
        return $header . $navbar . $productosView . $footer;
    }
    


    private function cargarProductos($categoria = null, $busqueda = null)
{
    $conditions = [];

    // Filtrar por categoría
    if ($categoria) {
        $conditions['idCategoria'] = intval($categoria); // Filtrar por categoría seleccionada
    }

    // Filtrar por búsqueda
    if ($busqueda) {
        $conditions['LOWER(descripcion) LIKE'] = '%' . strtolower($busqueda) . '%';
    }

    return $this->productoModel->where($conditions)->findAll(); // Retornar productos filtrados
}


    private function obtenerCategorias()
    {
        return $this->categoriaModel->findAll();
    }
}