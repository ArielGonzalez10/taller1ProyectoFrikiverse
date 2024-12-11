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
    <a href="<?= site_url('productos/modificar'); ?>" class="btn btn-primary">Agregar Producto</a>
    <button type="submit" name="eliminar_productos" class="btn btn-danger">Eliminar Producto</button>
    <?php endif; ?>
</form>


<form method="post" action="<?= site_url('cargarProductos'); ?>">
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
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td>
                    <input type="checkbox" name="productos[]" value="<?= htmlspecialchars($producto['idProducto']); ?>">
                </td>
                <td><?= htmlspecialchars($producto['idProducto']); ?></td>
                <td>
                    <input type="text" name="descripcion[<?= htmlspecialchars($producto['idProducto']); ?>]"
                        value="<?= htmlspecialchars($producto['descripcion']); ?>" required>
                </td>
                <td>
                    <input type="number" name="precioUnit[<?= htmlspecialchars($producto['idProducto']); ?>]"
                        value="<?= htmlspecialchars($producto['precioUnit']); ?>" required step="0.01">
                </td>
                <td>
                    <input type="number" name="stock[<?= htmlspecialchars($producto['idProducto']); ?>]"
                        value="<?= htmlspecialchars($producto['stock']); ?>" required>
                </td>
                <td><?= htmlspecialchars($producto['idCategoria']); ?></td>
                <td>
                    <?php if (!empty($producto['foto'])): ?>
                    <img src="<?= base_url('uploads/productos/' . htmlspecialchars($producto['foto'])); ?>"
                        alt="Foto del Producto" style="max-width: 100px; max-height: 100px;">
                    <?php else: ?>
                    Sin Imagen
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="7">No hay productos disponibles</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (session()->get('idRol') == 1): // Verifica si es administrador 
    ?>
    <button type="submit" name="guardar_cambios" class="btn btn-primary">Guardar Cambios</button>
    <?php endif; ?>
</form>