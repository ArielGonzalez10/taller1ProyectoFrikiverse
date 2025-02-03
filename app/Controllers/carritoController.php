<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class CarritoController extends Controller
{
    public function agregarAlCarrito()
    {
        $session = session();
        $productosSeleccionados = $this->request->getPost('productos');
        $cantidades = $this->request->getPost('cantidades');

        // Obtener el carrito existente o inicializar uno vacío
        $carrito = $session->get('carrito') ?? [];

        // Verificar que productosSeleccionados y cantidades no sean nulos
        if (!empty($productosSeleccionados) && !empty($cantidades)) {
            foreach ($productosSeleccionados as $index => $idProducto) {
                $cantidad = (int)$cantidades[$index] ?? 1; // Obtener cantidad

                // Verificar si el producto ya está en el carrito
                if (isset($carrito[$idProducto])) {
                    // Si ya existe, sumar la nueva cantidad
                    $carrito[$idProducto] += $cantidad;
                } else {
                    // Si no existe, agregarlo al carrito
                    $carrito[$idProducto] = $cantidad;
                }
            }

            // Guardar el carrito actualizado en la sesión
            $session->set('carrito', $carrito);
        }

        return redirect()->to(site_url('productos'))->with('success', 'Productos agregados al carrito.');
    }

    public function verCarrito()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        // Verifica si el carrito está vacío
        if (empty($carrito)) {
            return view('carrito', ['productos' => [], 'total' => 0]);
        }

        // Obtener productos del carrito desde la base de datos
        $db = Database::connect();
        $query = $db->table('Producto')
            ->select('idProducto, descripcion, precioUnit, fotoProducto')
            ->whereIn('idProducto', array_keys($carrito))
            ->get();

        $productos = $query->getResultArray();
        $total = 0;

        // Calcular el total y agregar la cantidad a cada producto
        foreach ($productos as &$producto) {
            $idProducto = $producto['idProducto'];
            $producto['cantidad'] = $carrito[$idProducto] ?? 1;
            $total += $producto['cantidad'] * $producto['precioUnit'];
        }

        return view('carrito', ['productos' => $productos, 'total' => $total]);
    }
}