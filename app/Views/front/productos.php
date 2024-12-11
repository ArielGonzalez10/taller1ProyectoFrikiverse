<h1>Listado de Productos</h1>
<form method="get" action="<?= site_url('productos'); ?>" style="display: flex; align-items: center; gap: 10px;">
    <!-- Lista desplegable de categorías -->
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

    <!-- Buscador de productos -->
    <input type="text" name="busqueda" placeholder="Buscar producto..."
        value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
    <button type="submit">Buscar</button>

    <?php if (session()->get('idRol') == 1): // Verifica si es administrador 
    ?>
    <a href="<?= site_url('agregarProducto'); ?>" class="btn btn-primary">Agregar Producto</a>

    <?php endif; ?>
</form>

<form method="post" action="<?= site_url('eliminarProducto'); ?>">
    <table>
        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>ID Producto</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>Stock</th>
                <th>ID Categoría</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td>
                    <!-- Checkbox para seleccionar productos -->
                    <input type="checkbox" name="productos[]" value="<?= htmlspecialchars($producto['idProducto']); ?>">
                </td>
                <td><?= htmlspecialchars($producto['idProducto']); ?></td>
                <td><?= htmlspecialchars($producto['descripcion']); ?></td>
                <td><?= htmlspecialchars($producto['precioUnit']); ?></td>
                <td><?= htmlspecialchars($producto['stock']); ?></td>
                <td><?= htmlspecialchars($producto['idCategoria']); ?></td>
                <td>
                    <?php if (!empty($producto['foto'])): ?>
                    <img src="<?= base_url('uploads/productos/' . htmlspecialchars($producto['foto'])); ?>"
                        alt="Foto del Producto" style="max-width: 100px; max-height: 100px;">
                    <?php else: ?>
                    Sin Imagen
                    <?php endif; ?>
                </td>
                <td>
                    <!-- Botón para modificar -->
                    <a href="<?= site_url('modificarProducto/' . htmlspecialchars($producto['idProducto'])); ?>"
                        class="btn btn-warning">Modificar</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="8">No hay productos disponibles</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Botón para eliminar los productos seleccionados -->
    <button type="submit" class="btn btn-danger">Eliminar Seleccionados</button>
</form>