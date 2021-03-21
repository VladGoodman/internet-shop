<?php
require 'basket_module.php'; 

if(isset($_GET['action']) && $_GET['action']==='add'){
    if($basket->addItemInBasket($_GET['id']) === true){
        header('Location: http://localhost/LPR%207/2/index.php');
    }
}

if(isset($_GET['action']) && $_GET['action']==='delete_product'){
    if($basket->deleteItemBasket($_GET['del_id']) === true){
        header('Location: http://localhost/LPR%207/2/index.php');
    }else{
        echo $basket->deleteItemBasket($_GET['del_id']);
    }
}



    
?>
<div class="basket bg-dark">
    <div class="fs-3 my-1 basket__title text-center text-white">
        Корзина
    </div>
    <ul class="list-group">
        <?php
        $sum_price = 0;
        if($basket->getAllBasketItems()){
            foreach($basket->getAllBasketItems() as $key => $item){
                echo '
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        '.$item['product'].'
                        <a class="link-danger" href="?action=delete_product&del_id='.$key.'">Удалить</a>
                    </li>
                    ';
                $sum_price += (int)$item['price'];
            }
            echo '
            <span class="fs-5 my-3 text-white">Сумма всех покупок: '.$sum_price.'</span>
            <a class="btn btn-warning" href="?action=order_add">Оформить заказ</a>
            ';
        }else{
            echo '<p class="text-white fs-5">В корзине пока нет продуктов</p>';
        }
        ?>
    </ul>
</div>