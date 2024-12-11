<h1>Modificar Producto</h1>

<form method="post" action="<?= site_url('modificarProducto'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="idProducto" value="<?= htmlspecialchars($producto['idProducto']); ?>">

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']); ?>"
        required>

    <label for="precioUnit">Precio Unitario:</label>
    <input type="number" id="precioUnit" name="precioUnit" value="<?= htmlspecialchars($producto['precioUnit']); ?>"
        required step="0.01">

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($producto['stock']); ?>" required>

    <label for="idCategoria">Categoría:</label>
    <select id="idCategoria" name="idCategoria" required>
        <?php foreach ($categorias as $categoria): ?>
        <option value="<?= htmlspecialchars($categoria['idCategoria']); ?>"
            <?= $producto['idCategoria'] == $categoria['idCategoria'] ? 'selected' : ''; ?>>
            <?= htmlspecialchars($categoria['descripcion']); ?>
        </option>
        <?php endforeach; ?>
    </select>

    <label for="foto">Foto del Producto:</label>
    <input type="file" id="foto" name="foto">

    <button type="submit">Guardar Cambios</button>
</form>