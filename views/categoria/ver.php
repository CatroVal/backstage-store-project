<?php if(isset($categoria)) : ?>
    <h1><?=$categoria->nombre?></h1>
    <?php if($productos->num_rows == 0) : ?>
        <p>No hay productos para esta categoría</p>
    <?php else : ?>

        <?php while($product = $productos->fetch_object()) : ?>
        <div class="product">
            <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
                <?php if($product->imagen != null) : ?>
                    <img src="<?=base_url?>uploads/images/<?=$product->imagen?>">
                <?php else : ?>
                    <img src="<?=base_url?>assets/img/Logo-Tienda-Musica.png">
                <?php endif; ?>
                <h2><?=$product->nombre?></h2>
            </a>
            <strong style="color: #FFA500;"><?=$product->stock > 0 ? "En Stock: " . $product->stock : "Stock Agotado"?></strong>
            <p><?=$product->precio?> Euros</p>
            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
        </div>
        <?php endwhile; ?>

    <?php endif; ?>
<?php else : ?>
    <h1>La categoría no existe</h1>
<?php endif; ?>
