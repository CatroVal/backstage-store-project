<?php
//Con este require tenemos acceso al objeto
require_once 'models/producto.php';

class carritoController {

    public function index() {
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
        }

        require_once 'views/carrito/index.php';
    }

    public function add() {
        //Recoger parametro por la url que va a ser el id del producto a comprar
        if(isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location:'.base_url);
        }

        if(isset($_SESSION['carrito'])) {
            /*Recorremos el array de la sesion 'carrito', y por cada iteracion saca el indice del array y
            el elemento (producto)*/
            $counter = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento) {
                /*Si el producto que tengo ya en el carrito coincide con el id del producto que me llega
                por GET, entonces le sumamaos una unidad*/
                if($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++ ;
                    $counter++ ;
                }
            }
        }

        if(!isset($counter) || $counter == 0) {
            //Conseguir el producto de la BBDD
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            //Añadir al carrito
            if(is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header("Location:".base_url."carrito/index");
    }

    public function delete() {
        if(isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location:".base_url."carrito/index");
    }

    public function up() {
        if(isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location:".base_url."carrito/index");
    }

    public function down() {
        if(isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location:".base_url."carrito/index");
    }

    public function delete_all() {
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/index");
    }
}
