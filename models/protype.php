<?php
class Protype extends Db{
    //Viet phuong thuc lay ra tat ca san pham moi nhat
    function getAllProtypes(){
        $sql = self::$connection->prepare("SELECT * 
        FROM protypes");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function getProtypesById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function updateProtypes($type_id, $type_name, $type_image){
        $stmt = self::$connection->prepare("UPDATE protypes SET type_name = ?, type_image = ? WHERE type_id = ?");
        $stmt->bind_param("ssi", $type_name, $type_image, $type_id );
        $stmt->execute();
    }

    function deleteProtypes($type_id){
        $stmt = self::$connection->prepare("DELETE FROM protypes WHERE type_id = ?");
        $stmt->bind_param("i", $type_id);
        $stmt->execute(); 
    }
}
?>