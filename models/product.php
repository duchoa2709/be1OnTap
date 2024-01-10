<?php
class Product extends Db{
    //Viet phuong thuc lay ra tat ca san pham moi nhat
    function getAllProducts(){
        $sql = self::$connection->prepare("SELECT * 
        FROM products                                   -- lay ra tat ca cac san pham
        ORDER BY id DESC                    -- sap xep theo id giam dan ~ moi nhat (tang dan dung ASC ~ cu nhat)
        ");                                             //giới hạn 6 sản phẩm ( LIMIT 0,10 ) 
        $sql->execute();                                //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC); 
        return $items; //return an array
    }

    //lay product theo id
    function getProductById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    // add product
    function addProduct($name, $manu_id, $type_id, $description, $price, $image, $feature, $created_at)
    {
        $sql = self::$connection->prepare("INSERT INTO products(name, manu_id, type_id, description, price, pro_image, feature, created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("siisissi", $name, $manu_id, $type_id, $description, $price, $image, $feature, $created_at);
        return $sql->execute();
    }

    // tìm kiếm không phân trang
    function searchProducts($keyword) {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name LIKE ?");
        $keyword = "%$keyword%";
        $sql->bind_param("s", $keyword);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    // Tìm kiếm có phân trang
    function searchAndPagination($search, $limit, $start) {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name LIKE ? LIMIT ?, ?");
        $search = "%$search%";
        $sql->bind_param("sii", $search, $start, $limit);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Phân trang
    function pagination($limit, $start) {
        $sql = self::$connection->prepare("SELECT * FROM products 
        ORDER BY id DESC 
        LIMIT ?, ? ");
        $sql->bind_param("ii", $start, $limit);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}