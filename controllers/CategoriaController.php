<?php
//Carga de los modelos
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController {

    public function index() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function ver() {
        if(isset($_GET['id'])) {
            //var_dump($_GET['id']);
            $id = $_GET['id'];

            //Conseguir la categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            //var_dump($categoria);

            //Conseguir productos de cada categoria
            $producto = new Producto();
            $producto->setCategoriaId($id);
            $productos = $producto->getAllCategory();

        }

        require_once 'views/categoria/ver.php';
    }

    public function crear() {
        Utils::isAdmin();

        require_once 'views/categoria/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])) {
            //Guardar la categoria en la BBDD
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();

            if($save) {
                $_SESSION['register_Cat'] = "complete";
            } else {
                $_SESSION['register_Cat'] = "failed";
            }
        } else {
            $_SESSION['register_Cat'] = "failed";
        }
        header("Location: ".base_url."categoria/index");
    }

} //Fin de la clase
