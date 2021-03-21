<?php
    require_once('bd.php');
    class Basket{

        public function getAllBasketItems(){
            if(isset($_SESSION['basket'])){
                return $_SESSION['basket'];
            }else{
                return false;
            }
        }

        public function addItemInBasket($id){
            global $mysql;
            $id = (int) $id;
            $query = "SELECT * FROM `product` WHERE id=$id";
            $result = mysqli_query($mysql, $query);
            if($result){
                if($product = mysqli_fetch_assoc($result)){
                    array_push($_SESSION['basket'],
                        array( 
                            "product"=>$product['name'],
                            "price" => $product['price'] 
                        )); 
                    return true;
                }
            }
            else{
                return 'Такого продукта нет в наличии';
            }
        }
        public function deleteItemBasket($id){
            if(isset($_SESSION['basket'][$id])){
                unset($_SESSION['basket'][$id]); 
                return true;
            }
            else{
                return 'Такого продукта нет в корзине';
            }
        }

    }
    $basket = new Basket();

?>