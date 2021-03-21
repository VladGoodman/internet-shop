<?php
    require 'modules/user_module.php'; 
    require 'modules/products_module.php'; 

?>
<div class="container">
    <? require 'header.php' ?>
    <h1>Ваш профиль: <span><?= $user->getFio() ?></span></h1>
    <h4>Ваши заказы: </h4>
    <ul>

    </ul class="list-group">
    <?php
        foreach($user->getUserOrders($user->getEmail()) as $order){
            echo '
                <li class="list-group-item">
                    <div>';
                        echo $product->getNameForId($order['product_id']).' : '.$order['date'];
            echo '</div>
                </li>';
        }
    ?>

</div>