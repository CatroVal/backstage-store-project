<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>BackStage Instrumentos Musicales</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
</head>

<body>
    <div id="container">
        <!--CABECERA-->
        <header id="header">
            <div id="logo">
                <a href="<?=base_url?>"><img src="<?=base_url?>assets/img/Logo-Tienda-Musica-Small.png" alt="Tienda Logo"></a>
            </div>
        </header>
        <!--MENU-->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>

        <div id="content">
