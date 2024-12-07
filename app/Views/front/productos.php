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

// Obtener la conexión a la base de datos


// Obtener el término de búsqueda
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : ''; // Obtener el término de búsqueda
$productos = $busqueda ? buscar_productos($conexion, $busqueda) : cargar_productos($conexion); // Cargar productos según


?>

<h1>Listado de Productos</h1>

<form method="get" action="<?= site_url('productos'); ?>">
    <input type="text" name="busqueda" placeholder="Buscar producto..."
        value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
    <button type="submit">Buscar</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Stock</th>
            <th>ID Categoría</th>
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
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>