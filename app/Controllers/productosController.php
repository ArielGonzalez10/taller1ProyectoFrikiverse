<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Views\front\agregarProducto;

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


    public function obtenerCategorias()
    {
        return $this->categoriaModel->findAll();
    }

    public function eliminarProductos()
    {
        // Verificar si se envió la lista de productos seleccionados
        $productosSeleccionados = $this->request->getPost('productos');

        if (!empty($productosSeleccionados)) {
            // Iterar sobre los productos seleccionados y eliminarlos
            foreach ($productosSeleccionados as $idProducto) {
                $this->productoModel->delete($idProducto); // Eliminar producto de la base de datos
            }

            // Mensaje de éxito
            session()->setFlashdata('success', 'Los productos seleccionados fueron eliminados correctamente.');
        } else {
            // Mensaje de error
            session()->setFlashdata('error', 'No se seleccionaron productos para eliminar.');
        }

        // Redirigir a la vista de productos
        return redirect()->to(site_url('productos'));
    }

    public function modificarProducto($idProducto)
    {
        // Obtener el producto por su ID
        $producto = $this->productoModel->find($idProducto);

        if (!$producto) {
            // Si no se encuentra el producto, redirigir con un mensaje de error
            session()->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->to(site_url('productos'));
        }

        // Cargar la vista de edición con los datos del producto
        return view('modificarProducto', ['producto' => $producto]);
    }
    


    public function guardarProducto()
    {
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'precioUnit' => $this->request->getPost('precioUnit'),
            'stock' => $this->request->getPost('stock'),
            'idCategoria' => $this->request->getPost('idCategoria'),
        ];

        // Procesar la subida de imagen si se proporciona
        if ($this->request->getFile('foto')->isValid()) {
            $foto = $this->request->getFile('foto');
            $foto->move('uploads/productos', $foto->getName());
            $data['foto'] = $foto->getName();
        }

        // Guardar el producto en la base de datos
        if ($this->productoModel->insert($data)) {
            session()->setFlashdata('success', 'Producto agregado correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al agregar el producto.');
        }

        return redirect()->to(site_url('productos'));
    }
}