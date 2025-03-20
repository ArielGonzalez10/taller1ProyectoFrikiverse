<div class="d-flex flex-column h-100" style="padding-top: 120px;">
    <!-- Begin page content -->
    <div class="container">
        <h3 class="my-2 text-center" style="font-size: 30px; font-weight: 700;" id="titulo">PRODUCTOS EN TU CARRITO</h3>
    </div>

    <!-- Flash messages for success and error -->
    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success text-center" role="alert" style="background-color: #ffc107;">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger text-center" role="alert" style="background-color: #ffcccc;">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <div class="text-center">
        <?php
        $session = session();
        $cart = \Config\Services::cart()->contents();

        // If cart is empty, provide a link to catalog
        if (empty($cart)) {
            echo 'Para agregar productos al carrito, click en "Comprar"';
        }
        ?>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered my-3 custom-table" style="border-radius: 15px;"
                aria-describedby="titulo">
                <thead class="table-dark">
                    <?php if ($cart == TRUE) : ?>
                    <tr>
                        <th
                            class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nombre del producto</th>
                        <th
                            class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Precio</th>
                        <th
                            class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Cantidad</th>
                        <th
                            class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Subtotal</th>
                        <th
                            class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Cancelar Producto</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    echo form_open('carrito_actualiza'); // Assuming this form is used elsewhere
                    $gran_total = 0;
                    $i = 1;
                    foreach ($cart as $item) :
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);

                        // Find the corresponding product for each item
                        $producto_en_carrito = null;
                        foreach ($productos as $producto) {
                            if ($producto['id_producto'] == $item['id_producto']) {
                                $producto_en_carrito = $producto;
                                break;
                            }
                        }
                    ?>
                    <tr>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <?php echo $i++; ?>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <?php echo $item['name']; ?>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            $<?php echo number_format($item['price'], 2); ?>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <?php echo $item['qty']; ?>
                        </td>
                        <?php $gran_total += $item['subtotal']; ?>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            $<?php echo number_format($item['subtotal'], 2); ?>
                        </td>
                        <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                            <a class="btn btn-danger btn-sm"
                                href="<?php echo base_url(); ?>remover_producto/<?php echo $item['rowid']; ?>">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5" class="text-center"><b>Total: $<?= number_format($gran_total, 2) ?></b></td>
                        <td colspan="5" class="text-end text-center">
                            <a class="btn btn-danger btn-sm" href="<?= base_url('eliminar_carrito') ?>">Borrar
                                Carrito</a>
                            <a class="btn btn-warning btn-sm" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalCompra">Comprar</a>
                        </td>
                    </tr>
                    <?php echo form_close(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>