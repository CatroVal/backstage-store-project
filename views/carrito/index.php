<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>

    <?php
        foreach($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
    ?>
        <tr>
            <td>
                <?php if($producto->imagen != null) : ?>
                    <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito">
                <?php else : ?>
                    <img src="<?=base_url?>assets/img/Logo-Tienda-Musica.png" class="img_carrito">
                <?php endif; ?>
            </td>
            <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
            <td><?=$producto->precio?> Euros</td>
            <!--El $elemento, a diferencia de $producto NO es un objeto; es un array!!!-->
            <td>
                <div class="updown-unidades">
                    <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
                    <?=$elemento['unidades']?>
                    <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button">-</a>
                </div>
            </td>
            <td><a href="<?=base_url?>carrito/delete&index=<?=$indice?>">Eliminar</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<div class="delete-carrito">
    <a href="<?=base_url?>carrito/delete_all" class="button button_delete">Borrar Pedido</a>
</div>
<div class="total-carrito">
    <?php $stats = Utils::statsCarrito(); ?>
    <h3>Precio Total: <?=$stats['total']?> €</h3>
    <a href="<?=base_url?>pedido/hacer" class="button button_pedido">Confirmar Pedido</a>
</div>
<?php else: ?>
    <p>El carrito está vacío, añade algún producto</p>
<?php endif; ?>
