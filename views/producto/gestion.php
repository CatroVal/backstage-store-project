<h1>Gestión de Productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">Crear Producto</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert_green">Nuevo producto creado correctamente</strong>
<?php  elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>
    <strong class="alert_red">Fallo al crear el producto!!</strong>
<?php endif; ?>
<?php  Utils::deleteSession('producto'); ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php  elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <strong class="alert_red">Fallo al borrar el producto!!</strong>
<?php endif; ?>
<?php  Utils::deleteSession('delete'); ?>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php while($prod = $productos->fetch_object()) : ?>
        <tr>
            <td><?=$prod->id;?></td>
            <td><?=$prod->nombre;?></td>
            <td><?=$prod->precio;?></td>
            <td><?=$prod->stock;?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$prod->id?>" class="button">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>" class="button">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
