<?php if(isset($_SESSION['identity'])) : ?>
    <h1>Realizar Pedido</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver productos y precio del pedido</a>
    </p>
    <br>

    <h3>Dirección del envío:</h3>
    <form action="<?=base_url?>pedido/add" method="POST">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" required>

        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>

        <input type="submit" value="Confirmar Pedido">

    </form>


<?php else : ?>
    <h1>No estás identificado!</h1>
    <p>Debes estar registrado en la web para poder realizar tu pedido.</p>
<?php endif; ?>
