<?php
include("conexionBD.php");

// Inicia sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si ya hay una sesión iniciada y redirige
if (isset($_SESSION['usuario'])) {
    header("Location: principal"); // Redirige a la página principal
    exit();
}

// Verifica si el usuario es administrador consultando la base de datos
$esAdministrador = false;
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = intval($_SESSION['idUsuario']); // Asegúrate de que sea un número entero
    $resultado = $conexion->query("SELECT idRol FROM usuario WHERE idUsuario = $idUsuario LIMIT 1");
    if ($resultado && $fila = $resultado->fetch_assoc()) {
        $esAdministrador = $fila['idRol'] == 1;
    }
}

// Función para obtener todos los productos
function cargar_productos($conexion)
{
    $resultado = $conexion->query("SELECT * FROM producto"); // Obtener todos los productos
    return $resultado->fetch_all(MYSQLI_ASSOC); // Devolver los resultados como un array asociativo
}

// Función para buscar productos por descripción
function buscar_productos($conexion, $busqueda)
{
    $busqueda = $conexion->real_escape_string($busqueda); // Escapar la entrada
    $resultado = $conexion->query("SELECT * FROM producto WHERE descripcion LIKE '%$busqueda%'"); // Filtrar por descripción
    return $resultado->fetch_all(MYSQLI_ASSOC); // Devolver los resultados
}

// Obtener el término de búsqueda
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : ''; // Obtener el término de búsqueda
$productos = $busqueda ? buscar_productos($conexion, $busqueda) : cargar_productos($conexion); // Cargar productos según

// Obtener todas las categorías de la base de datos
function obtener_categorias($conexion)
{
    $resultado = $conexion->query("SELECT idCategoria, descripcion FROM categoria"); // Consulta para las categorías
    return $resultado->fetch_all(MYSQLI_ASSOC); // Devolver las categorías como un array asociativo
}
$categorias = obtener_categorias($conexion);
?>
<h1>Listado de Productos</h1>

<form method="get" action="<?= site_url('productos'); ?>" style="display: flex; align-items: center; gap: 10px;">
    <!-- Lista desplegable de categorías -->
    <select name="categoria" style="max-width: 200px;">
        <option value="">Categorías</option>
        <?php foreach ($categorias as $categoria): ?>
        <option value="<?= htmlspecialchars($categoria['idCategoria']); ?>">
            <?= htmlspecialchars($categoria['descripcion']); ?>
        </option>
        <?php endforeach; ?>
    </select>
    <!-- Buscador de productos -->
    <input type="text" name="busqueda" placeholder="Buscar producto..."
        value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
    <button type="submit">Buscar</button>
    <?php if ($esAdministrador): ?>
    <a href="<?= site_url('productos/agregar'); ?>" class="btn btn-primary">Agregar Producto</a>
    <?php endif; ?>
</form>
<table>
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Stock</th>
            <th>ID Categoría</th>
            <?php if ($esAdministrador): ?>
            <th>Modificar</th>
            <th>Eliminar</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?= htmlspecialchars($producto['idProducto']); ?></td>
            <td><?= htmlspecialchars($producto['descripcion']); ?></td>
            <td><?= htmlspecialchars($producto['precioUnit']); ?></td>
            <td><?= htmlspecialchars($producto['stock']); ?></td>
            <td><?= htmlspecialchars($producto['idCategoria']); ?></td>
            <?php if ($esAdministrador): ?>
            <td style="text-align: center; border: 1px solid #ddd;">
                <label>
                    <input type="checkbox"
                        onclick="location.href='<?= site_url('productos/modificar/' . $producto['idProducto']); ?>';"
                        style="cursor: pointer;">
                </label>
            </td>
            <td style="text-align: center; border: 1px solid #ddd;">
                <label>
                    <input type="checkbox"
                        onclick="if(confirm('¿Estás seguro de eliminar este producto?')) { location.href='<?= site_url('productos/eliminar/' . $producto['idProducto']); ?>'; }"
                        style="cursor: pointer;">
                </label>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>