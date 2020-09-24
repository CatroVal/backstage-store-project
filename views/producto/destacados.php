<h1>Algunos de Nuestros Productos</h1>

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
