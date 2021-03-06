<?php

 class Pedido {

     private $id;
     private $usuario_id;
     private $provincia;
     private $ciudad;
     private $direccion;
     private $coste;
     private $estado;
     private $fecha;
     private $hora;
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

     public function getUsuarioId() {
         return $this->usuario_id;
     }

     public function setUsuarioId($usuario_id) {
         $this->usuario_id = $usuario_id;
     }

     public function getProvincia() {
         return $this->provincia;
     }

     public function setProvincia($provincia) {
         $this->provincia = $this->db->real_escape_string($provincia);
     }

     public function getCiudad() {
         return $this->ciudad;
     }

     public function setCiudad($ciudad) {
         $this->ciudad = $this->db->real_escape_string($ciudad);
     }

     public function getDireccion() {
         return $this->direccion;
     }

     public function setDireccion($direccion) {
         $this->direccion = $this->db->real_escape_string($direccion);
     }

     public function getCoste() {
         return $this->coste;
     }

     public function setCoste($coste) {
         $this->coste = $coste;
     }

     public function getEstado() {
         return $this->estado;
     }

     public function setEstado($estado) {
         $this->estado = $estado;
     }

     public function getFecha() {
         return $this->fecha;
     }

     public function setFecha($fecha) {
         $this->fecha = $fecha;
     }

     public function getHora() {
         return $this->hora;
     }

     public function setHora($hora) {
         $this->hora = $hora;
     }

     public function getAll() {
         $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
         return $productos;

     }

     public function getOne() {
         $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
         return $producto->fetch_object();
     }

     public function getOneByUser() {
         $sql = "SELECT p.id, p.coste  FROM pedidos p "
                //. "INNER JOIN lineas_pedidos lp ON  lp.pedido_id = p.id "
                . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY id DESC LIMIT 1";
         $pedido = $this->db->query($sql);

         //echo $sql;
         //echo $this->db->error;
         //die();

         return $pedido->fetch_object();
     }

     public function getAllByUser() {
         $sql = "SELECT p.* FROM pedidos p "
                . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY id DESC";
         $pedido = $this->db->query($sql);

         return $pedido;
     }

     public function getProductosByPedido($id) {
         //$sql = "SELECT * FROM productos WHERE id IN "
                //. "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id})";
         $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                . "WHERE lp.pedido_id = {$id}";

         $productos = $this->db->query($sql);

         return $productos;
     }

     public function save() {

         $sql = "INSERT INTO pedidos VALUES(null, {$this->getUsuarioId()}, '{$this->getProvincia()}', '{$this->getCiudad()}', '{$this->getDireccion()}',
                {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
         $save = $this->db->query($sql);

         $result = false;
         if($save) {
             $result = true;
         }
         return $result;
     }

     public function save_lineaPedido() {
         $sql = "SELECT LAST_INSERT_ID() AS 'pedido';";
         $query = $this->db->query($sql);
         $pedido_id = $query->fetch_object()->pedido;

         foreach ($_SESSION['carrito'] as $elemento) {
             $producto = $elemento['producto'];

             if($producto->stock == 0 || $producto->stock < $elemento['unidades']) {
               echo "<h2 style='color: #0082B3;'>$producto->nombre</h2><br>
                  <strong style='color: red;'>Lo sentimos, no hay suficiente stock!</strong>";
               exit();
             }

             $insert = "INSERT INTO lineas_pedidos VALUES(null, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
             $save = $this->db->query($insert);
             //Actualizar stock
             $this->updateStock($producto->id, $elemento['unidades']);
         }

         $result = false;
         if($save) {
             $result = true;
         }
         return $result;
     }

     public function updateStock($id, $unidades) {
       $sql = "SELECT stock FROM productos WHERE id=$id;";
       $query = $this->db->query($sql);
       $registro = $query->fetch_object()->stock;

       $newStock = 0;

       if($registro) {
         $newStock = $registro;
       }
       $newStock -= $unidades;

       $sql = "UPDATE productos SET stock = $newStock WHERE id=$id;";
       $this->db->query($sql);
     }

     public function edit() {
         $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
         $sql .= " WHERE id={$this->id};";

         $save = $this->db->query($sql);

         $result = false;
         if($save) {
             $result = true;
         }
         return $result;
     }

 } //Fin de la clase
