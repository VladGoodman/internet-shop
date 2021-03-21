<?php 
    require 'modules/user_module.php'; 
    require 'modules/products_module.php'; 
    if(!empty($user->getFio())){
        require 'basket.php';
    }
    echo '<div class="container">';
        require 'header.php';
        echo '<h1>Товары: </h1>
        <div>';
        foreach($product->getAllProduct() as $product){
            echo '<hr>';
            echo $product['name'];
            echo '<br>';
            echo $product['descr'];
            echo '<br>';
            echo $product['price'];
            if(!empty($user->getFio())){
                echo '<br><a href="?action=add&id='.$product['id'].'">Добавить в корзину</a>';
            }
            echo '<hr>';
        }
        echo '</div>';
    echo '</div>';
?>