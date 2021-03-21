<?php
    require_once('bd.php');
    require_once('products_module.php');
    require_once('user_module.php');

    class Basket extends Product{
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
            if($product = $this->getProduct($id)){
                array_push($_SESSION['basket'],
                        array( 
                            "product_id"=>$product['id'],
                            "product"=>$product['name'],
                            "price" => $product['price'] 
                        )); 
                return true;
            }else{
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
        private function clearBasket(){
            $_SESSION['basket']= [];
        }
        public function addOreder(){
            global $user;
            global $mysql;
            $user_email = $user->getEmail();
            foreach($this->getAllBasketItems() as $basket_item){
                $product_id = (int) $basket_item['product_id'];
                $query = "INSERT INTO `orders`(`product_id`, `user`) VALUES ($product_id, '$user_email')";
                mysqli_query($mysql, $query);
            }
            $this->clearBasket();
            return true;
        }

    }
    $basket = new Basket();
?>