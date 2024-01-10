<?php
class Manufacture extends Db{
    //Viet phuong thuc lay ra tat ca san pham moi nhat
    function getAllManu(){
        $sql = self::$connection->prepare("SELECT * FROM manufactures");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    function getManufactureById($id) {
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    function updateManufacture($manu_id, $name, $image){
        $stmt = self::$connection->prepare("UPDATE manufactures SET manu_name = ?, manu_image = ? WHERE manu_id = ?");
        $stmt->bind_param("ssi", $name, $image, $manu_id);
        $stmt->execute();
    }
    
}