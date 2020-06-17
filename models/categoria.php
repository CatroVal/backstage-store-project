<?php

class Categoria {
    //Propiedades de la clase para acceder mediante métodos
    private $id;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getId() {
       return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
       return $this->nombre;
    }

    public function setNombre($nombre) {
        /*Escapamos este campo para que no sea susceptible de que se introduzcan caracteres como ('')
        o (""). Así evitamos que se pueda hacer una inyeccion SQL*/
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll() {
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }

    public function getOne() {
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()};");
        return $categoria->fetch_object();
    }

    public function save() {
        $sql = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }

} //Fin de la clase
