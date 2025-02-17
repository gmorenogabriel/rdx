<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
    <!-- Incluye CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Carrito de Compras</h1>

        <?php if (!empty($productos)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= esc($producto['nombre']) ?></td>
                            <td><?= number_format($producto['precio'], 2) ?> $</td>
                            <td><?= esc($producto['cantidad']) ?></td>
                            <td><?= number_format($producto['precio'] * $producto['cantidad'], 2) ?> $</td>
                        </tr>
                        <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td><strong><?= number_format($total, 2) ?> $</strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- Formulario para finalizar la compra -->
            <form action="<?= base_url();?>mant/carrito/carrito') ?>" method="post">

                <button type="submit" class="btn btn-success">Finalizar Compra</button>
            </form>
        <?php else: ?>
            <p>No tienes productos en el carrito.</p>
        <?php endif; ?>
    </div>

    <!-- Incluye JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
