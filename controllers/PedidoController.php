<?php
require_once 'models/pedido.php';

class pedidoController {

    public function hacer() {

        require_once 'views/pedido/hacer.php';
    }

    public function add() {
        if(isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            //Guardar datos en la BBDD
            if($direccion && $ciudad && $provincia) {
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setDireccion($direccion);
                $pedido->setCiudad($ciudad);
                $pedido->setProvincia($provincia);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //Guardar linea pedido
                $save_linea = $pedido->save_lineaPedido();

                if($save && $save_linea) {
                    $_SESSION['pedido'] = 'confirm';
                } else {
                    $_SESSION['pedido'] = 'failed';
                }
            } else {
                $_SESSION['pedido'] = 'failed';
            }

            header("Location:".base_url.'pedido/confirmado');

        } else {
            //Regirigir al index
            header("Location:".base_url);
        }
    }

    public function confirmado() {
        if(isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuarioId($identity->id);
            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);

        }

        require_once 'views/pedido/confirmado.php';
    }

    public function misPedidos() {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        //Sacar los pedidos del usuario
        $pedido->setUsuarioId($usuario_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalles() {
        Utils::isIdentity();
        //Recoger el id del producto por la url
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            //Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            require_once 'views/pedido/detalles.php';

        } else {
            header("Location: ".base_url.'pedido/mis_pedidos');
        }
    }

    public function gestion() {
        Utils::IsAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado() {
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            //Recoger datos del formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //Update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location: ".base_url.'pedido/detalles&id='.$id);
        } else {
            header("Location: ".base_url);
        }
    }
}
