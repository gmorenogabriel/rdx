<!-- app/Views/carrito.php -->
<h2>Productos seleccionados</h2>
<?php if (!empty($productos)): ?>
    <ul>
    <?php
        $totalGlobal = 0;
        foreach ($productos as $producto):
            $totalProducto = $producto['precio'] * $producto['cantidad'];
            $totalGlobal += $totalProducto;
    ?>
        <li>
            <?php echo $producto['nombre']; ?> -
            Precio: $<?php echo $producto['precio']; ?> -
            Cantidad: <?php echo $producto['cantidad']; ?> -
            Total: $<?php echo $totalProducto; ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <p><strong>Total de la compra: $<?php echo $totalGlobal; ?></strong></p>
<?php else: ?>
    <p>No hay productos seleccionados.</p>
<?php endif; ?>
