<?php if(isset($product)) : ?>
    <h1><?=$product->nombre?></h1>
    <div id="detail-product">

            <?php if($product->imagen != null) : ?>
                <img src="<?=base_url?>uploads/images/<?=$product->imagen?>">
            <?php else : ?>
                <img src="<?=base_url?>assets/img/Logo-Tienda-Musica.png">
            <?php endif; ?>

        <div class="data">
            <p><?=$product->descripcion?></p><br>
            <strong><p class="prize"><?=$product->precio?> Euros</p></strong><br>
            <p><?=$product->stock != null ? "En Stock" : "Fuera de Stock"?><p>
            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
        </div>
    </div>

<?php else : ?>
    <h1>EL producto no existe</h1>
<?php endif; ?>
