<h1>Detalles del Pedido</h1>

<?php if(isset($pedido)) : ?>
    <?php if(isset($_SESSION['admin'])) : ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="POST">
            <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
            <select name="estado">
                <option value="confirm" <?=$pedido->estado == 'confirm' ? 'selected' : '' ?>>Pendiente</option>
                <option value="preparation" <?=$pedido->estado == 'preparation' ? 'selected' : '' ?>>En preparación</option>
                <option value="ready" <?=$pedido->estado == 'ready' ? 'selected' : '' ?>>Preparado para enviar</option>
                <option value="sent" <?=$pedido->estado == 'sent' ? 'selected' : '' ?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br>
    <?php endif; ?>

    <h3>Datos de envío</h3>
    Dirección: <?=$pedido->direccion?><br>
    Ciudad: <?=$pedido->ciudad?><br>
    Provincia: <?=$pedido->provincia?><br><br>

    <h3>Datos de tu pedido</h3>
    Estado: <?=Utils::showStatus($pedido->estado)?><br>
    Nº del Pedido: <?=$pedido->id?><br>
    Importe Total: <strong><?=$pedido->coste?> €</strong><br><br>
    <h3><strong>Productos:</strong></h3><br>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while($producto = $productos->fetch_object()) : ?>
            <tr>
                <td>
                    <?php if($producto->imagen != null) : ?>
                        <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito">
                    <?php else : ?>
                        <img src="<?=base_url?>assets/img/Logo-Tienda-Musica.png" class="img_carrito">
                    <?php endif; ?>
                </td>
                <td><?=$producto->nombre?></td>
                <td><?=$producto->precio?> €</td>
                <!--El $elemento, a diferencia de $producto NO es un objeto; es un array!!!-->
                <td><?=$producto->unidades?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
