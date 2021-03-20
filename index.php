<?php 
    require 'user_module.php'; 
    require 'products_module.php'; 
    require 'header.php';
    foreach($product->getAllProduct() as $product){
        echo '<hr>';
        echo $product['name'];
        echo '<br>';
        echo $product['descr'];
        echo '<br>';
        echo $product['price'];
        echo '<hr>';
    }
?>