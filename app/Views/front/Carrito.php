<h1>Carrito de Compras</h1>
<div class="carrito">
    <?php if (!empty($productos)): ?>
    <table class="tabla-carrito">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td>
                    <img src="<?= base_url('uploads/productos/' . htmlspecialchars($producto['fotoProducto'])); ?>"
                        alt="Foto del producto" style="max-width: 100px;">
                </td>
                <td><?= htmlspecialchars($producto['descripcion']); ?></td>
                <td>$<?= number_format($producto['precioUnit'], 2); ?></td>
                <td>
                    <form method="post" action="<?= site_url('agregarAlCarrito'); ?>">
                        <input type="hidden" name="productos[]"
                            value="<?= htmlspecialchars($producto['idProducto']); ?>">
                        <input type="number" name="cantidades[]" value="<?= htmlspecialchars($producto['cantidad']); ?>"
                            min="1">
                        <button type="submit" class="btn-agregar">Actualizar</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="<?= site_url('eliminarDelCarrito'); ?>">
                        <input type="hidden" name="productos[]"
                            value="<?= htmlspecialchars($producto['idProducto']); ?>">
                        <button type="submit" class="btn-eliminar">X</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="footer-carrito">
        <div class="total">
            <strong>Total:</strong> $<?= number_format($total, 2); ?>
        </div>
        <button class="btn-confirmar-compra">Confirmar Compra</button>
    </div>
    <?php else: ?>
    <p class="mensaje-vacio">No hay productos agregados</p>
    <?php endif; ?>
</div>