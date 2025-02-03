<h1>Listado de Productos</h1>
<form method="get" action="<?= site_url('productos'); ?>" style="display: flex; align-items: center; gap: 10px;">
    <select name="categoria" onchange="this.form.submit();" style="max-width: 200px;">
        <option value="">Categorías</option>
        <?php if (!empty($categorias)): ?>
        <?php foreach ($categorias as $categoria): ?>
        <option value="<?= htmlspecialchars($categoria['idCategoria']); ?>"
            <?= (isset($_GET['categoria']) && $_GET['categoria'] == $categoria['idCategoria']) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($categoria['descripcion']); ?>
        </option>
        <?php endforeach; ?>
        <?php else: ?>
        <option value="">No hay categorías disponibles</option>
        <?php endif; ?>
    </select>

    <input type="text" name="busqueda" placeholder="Buscar producto..."
        value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
    <button type="submit">Buscar</button>

    <?php if (session()->get('idRol') == 1): ?>
    <a href="<?= site_url('agregarProducto'); ?>" class="btn btn-primary">Agregar Producto</a>
    <?php endif; ?>

    <?php if (session()->get('idRol') == 2): ?>
    <button type="button" class="btn btn-warning" id="agregarCarritoBtn">Agregar al Carrito</button>
    <?php endif; ?>
</form>

<form method="post" action="<?= site_url('agregarAlCarrito'); ?>" id="carritoForm">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Foto</th>
                    <th>Detalles</th>
                    <?php if (session()->get('idRol') == 1): ?>
                    <th>Modificar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="productos[]"
                            value="<?= htmlspecialchars($producto['idProducto']); ?>">
                    </td>
                    <td>
                        <?php if (!empty($producto['fotoProducto'])): ?>
                        <img src="<?= base_url('uploads/productos/' . htmlspecialchars($producto['fotoProducto'])); ?>"
                            alt="Foto del Producto">
                        <?php else: ?>
                        Sin Imagen
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']); ?><br>
                        <strong>Precio Unitario:</strong> <?= htmlspecialchars($producto['precioUnit']); ?><br>
                        <strong>Stock:</strong> <?= htmlspecialchars($producto['stock']); ?><br>
                    </td>
                    <?php if (session()->get('idRol') == 1): ?>
                    <td>
                        <a href="<?= site_url('modificarProducto/' . htmlspecialchars($producto['idProducto'])); ?>"
                            class="btn btn-warning">Modificar</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="<?= session()->get('idRol') == 1 ? '4' : '3'; ?>">No hay productos disponibles</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (session()->get('idRol') == 1): ?>
    <button type="submit" class="btn btn-danger">Eliminar Seleccionados</button>
    <?php endif; ?>
</form>

<script>
document.getElementById('agregarCarritoBtn').addEventListener('click', function() {
    document.getElementById('carritoForm').submit();
});
</script>