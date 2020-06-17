<h1>Gestionar Categorías</h1>

<!--Este mensaje solo deberia aparecer cuando se ha creado la categoria!!!-->
<?php if(isset($_SESSION['register_Cat']) && $_SESSION['register_Cat'] == 'complete'): ?>
    <strong class="alert_green">Categoría creada correctamente</strong>
<?php elseif (isset($_SESSION['register_Cat']) && $_SESSION['register_Cat'] == 'failed'): ?>
    <strong class="alert_red">Fallo al crear la categoría</strong>
<?php endif; ?>
<?php Utils::deleteSession('register_Cat'); ?>


<a href="<?=base_url?>categoria/crear" class="button button-small">Crear Categoría</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while($cat = $categorias->fetch_object()) : ?>
        <tr>
            <td><?=$cat->id;?></td>
            <td><?=$cat->nombre;?></td>
        </tr>
    <?php endwhile; ?>
</table>
