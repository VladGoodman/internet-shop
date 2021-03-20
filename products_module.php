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
    }
$product = new Product();
?>