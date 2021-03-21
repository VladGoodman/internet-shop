<?php
    require_once('bd.php');
    class Product{

        public function createProduct($name, $descr,$price){
            global $mysql;
            $query = "INSERT INTO `product`(`name`, `descr`, `price`) VALUES ('$name', '$descr', '$price')";
            $result = mysqli_query($mysql, $query);
            if($result == 'TRUE'){
                return true;
            }else{
                return false;
            }
        }

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

        public function updateProduct($id, $name, $descr, $price){
            global $mysql;
            $query = "UPDATE `product` SET `name`='$name',`descr`='$descr',`price`=$price WHERE id=$id";
            $result = mysqli_query($mysql, $query);
            if($result == 'TRUE'){
                return true;
            }else{
                return false;
            }
        }
        public function deleteProduct($id){
            global $mysql;
            $query = "DELETE FROM `product` WHERE id=$id";
            $result = mysqli_query($mysql, $query);
            if($result == 'TRUE'){
                return true;
            }else{
                return false;
            }
        }
    }
$product = new Product();
?>