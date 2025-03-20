<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\CategoriaModel;

class CarritoController extends BaseController
{

    protected $facturaModel;
    protected $detalleFacturaModel;
    protected $categoriaModel;

    protected $helpers = ['url', 'form'];

    // CARRITO DE COMPRAS
    public function vistaCarrito()
    {
        $cart = \Config\Services::cart();
        $data['titulo'] = 'Carrito de compras';
        $data['productos'] = $cart->contents();

        return view('plantillas/header', $data)
            . view('plantillas/navbar')
            . view('front/carrito')
            . view('plantillas/footer');
    }



    public function agregar()
    {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $productoModel = new ProductoModel();
        $producto = $productoModel->find($request->getPost('id_producto'));

        $data = array(
            'id' => $request->getPost('id_producto'),
            'name' => $request->getPost('nombre_producto'),
            'price' => $request->getPost('precio_producto'),
            'qty' => 1
        );

        $cart1 = $cart->contents();

        foreach ($cart1 as $item) {
            $producto = $productoModel->where('id_producto', $item['id'])->first();

            if ($producto['stock_producto'] < $item['qty'] || $producto['stock_producto'] == 0) {
                return redirect()->route('carrito')->with('mensaje', '¡No hay Stock!');
            }
        }

        $cart->insert($data);

        return redirect()->route('carrito')->with('mensaje', '¡El producto se agregó exitosamente!');
    }
    public function borrar($rowid)
    {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        if ($$rowid === "all") {
            $cart->destroy();
        } else {
            $cart->remove($rowid);
        }
        return redirect()->back()->withInput();
    }
    public function actualizar_carrito()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];
        $idProducto = $this->request->getPost('idProducto');
        $cantidad = (int) $this->request->getPost('cantidad', FILTER_VALIDATE_INT);

        if (isset($carrito[$idProducto]) && $cantidad > 0) {
            $carrito[$idProducto]['cantidad'] = $cantidad;
        }

        $session->set('carrito', $carrito);
        return redirect()->to('/carrito')->with('success', 'Carrito actualizado.');
    }

    public function remover_producto($idProducto)
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        if (isset($carrito[$idProducto])) {
            unset($carrito[$idProducto]);
            $session->set('carrito', $carrito);
        }

        return redirect()->to('/carrito')->with('success', 'Producto eliminado del carrito.');
    }

    public function borrar_carrito()
    {
        $session = session();
        $session->remove('carrito');
        return redirect()->to('/carrito')->with('success', 'Carrito vaciado.');
    }

    public function guardar_compra()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        if (empty($carrito)) {
            return redirect()->to('/carrito')->with('error', 'El carrito está vacío.');
        }

        $facturaData = [
            'fecha' => date('Y-m-d'),
            'total' => array_sum(array_map(function ($item) {
                return $item['precioUnit'] * $item['cantidad'];
            }, $carrito))
        ];

        $idFactura = $this->facturaModel->insert($facturaData);

        foreach ($carrito as $item) {
            $detalleData = [
                'idFactura' => $idFactura,
                'idProducto' => $item['idProducto'],
                'cantidad' => $item['cantidad'],
                'precioUnit' => $item['precioUnit']
            ];
            $this->detalleFacturaModel->insert($detalleData);
            $this->productosModel->decrementStock($item['idProducto'], $item['cantidad']);
        }

        $session->remove('carrito');
        return redirect()->to('/compra_final')->with('success', 'Compra realizada con éxito.');
    }
}