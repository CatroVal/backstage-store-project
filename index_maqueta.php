<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>BackStage Instrumentos Musicales</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div id="container">
        <!--CABECERA-->
        <header id="header">
            <div id="logo">
                <a href="index.php"><img src="assets/img/Logo-Tienda-Musica-Small.png" alt="Tienda Logo"></a>
            </div>
        </header>
        <!--MENU-->
        <nav id="menu">
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoría 1</a>
                </li>
                <li>
                    <a href="#">Categoría 2</a>
                </li>
                <li>
                    <a href="#">Categoría 3</a>
                </li>
                <li>
                    <a href="#">Categoría 4</a>
                </li>
                <li>
                    <a href="#">Categoría 5</a>
                </li>
            </ul>
        </nav>

        <div id="content">
        <!--BARRA LATERAL-->
        <aside id="lateral">
            <div id="login" class="block_aside">
                <h3>Entra a la Tienda</h3>
                <form action="#" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email">

                    <label for="password">Contraseña</label>
                    <input type="password" name="password">

                    <input type="submit" value="Enviar">
                </form>

                <ul>
                    <li><a href="#">Mis Pedidos</a></li>
                    <li><a href="#">Gestionar Pedidos</a></li>
                    <li><a href="#">Gestionar Categorías</a></li>
                </ul>
            </div>
        </aside>

        <!--CONTENIDO CENTRAL-->
        <div id="central">
            <h1>Productos Destacados</h1>
            <div class="product">
                <img src="assets/img/Gibson Les Paul Standard 60s, Iced Tea.jpg">
                <h2>Gibson Les Paul Standard 60s, Iced Tea</h2>
                <p>2.075,00 Euros</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/Ibanez RG421AHM, Blue Moon Burst.jpg">
                <h2>Ibanez RG421AHM, Blue Moon Burst</h2>
                <p>385,50 Euros</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/Yamaha TRBX304, Candy Apple Red.jpg">
                <h2>Yamaha TRBX304, Candy Apple Red</h2>
                <p>355,00 Euros</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/Mapex Saturn V Exotic 22in, Cherry Mix.jpg">
                <h2>Mapex Saturn V Exotic 22in, Cherry Mix</h2>
                <p>1.476,00 Euros</p>
                <a href="" class="button">Comprar</a>
            </div>

        </div>
        </div>

        <!--PIE DE PAGINA-->
        <footer id="footer">Desarrollado por Carlos Trogolo &copy; <?=date('Y')?></footer>
    </div>
</body>
</html>
