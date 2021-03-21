<?php
    require_once('bd.php');
    class Product{
        public function getAllProduct(){
            global $mysql;
            $query = "SELECT * FROM `product`";
            $result = mysqli_query($mysql, $query);
            $result_array = [];
            while($row = mysqli_fetch_assoc($result)){
                $result_array[] = $row;
            }
            return $result_array;
        }
        public function getProduct($id){
            global $mysql;
            $query = "SELECT * FROM `product` WHERE id=$id";
            $result = mysqli_query($mysql, $query);
            if($result){
                if($product = mysqli_fetch_assoc($result)){
                    return $product;
                }
            }
        }
        public function getNameForId($id){
            global $mysql;
            $query = "SELECT name FROM `product` WHERE id=$id";
            $result = mysqli_query($mysql, $query);
            if($result){
                if($product = mysqli_fetch_assoc($result)){
                    return $product['name'];
                }
            }
        }
    }
$product = new Product();
?>