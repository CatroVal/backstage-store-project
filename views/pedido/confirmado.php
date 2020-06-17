<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'confirm') : ?>
    <h1>Tu pedido se ha realizado</h1>
    <p>
        Tu pedido ha sido guardado con éxito. Una vez que realices la transferencia
        bancaria por el importe total, será precesado y enviado a la dirección que
        nos has indicado.
    </p>
    <br>
    <?php if(isset($pedido)) : ?>
        <h3>Datos de tu pedido:</h3>
        <br>
        Nº del Pedido: <?=$pedido->id?><br>
        Importe Total: <strong><?=$pedido->coste?> €</strong><br><br>
        <strong>Productos:</strong>
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
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'confirm') : ?>
    <h1>Tu pedido no se ha podido completar</h1>
<?php endif; ?>
