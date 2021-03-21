<?php
    require 'modules/user_module.php'; 
    require 'modules/products_module.php';
    require 'modules/basket_module.php';
    
    if($user->getRole() !== 1){
        echo 'Вам недоступна эта страница';
        exit;
    }

    if(isset($_GET['action']) && $_GET['action']==='del_product'){
        $product->deleteProduct($_GET['id']);
        header('Location: http://localhost/LPR%207/2/admin.php');
    }

    if(isset($_POST['name_product']) and isset($_POST['descr_product']) and isset($_POST['price_product'])){
        if($product->createProduct($_POST['name_product'], $_POST['descr_product'], $_POST['price_product']) === true){
            $text_info = 'Продукт успешно создан'; 
            header('Refresh: 0');
        }
    }

    if(isset($_POST['save_prod_name']) and isset($_POST['save_prod_descr']) and isset($_POST['save_prod_price']) and isset($_POST['save_product'])){
        $product->updateProduct($_POST['save_product'], $_POST['save_prod_name'],$_POST['save_prod_descr'],$_POST['save_prod_price'])?
            header('Location: http://localhost/LPR%207/2/admin.php'):null;
    }

    if(isset($_GET['action']) && $_GET['action']==='del_order'){
        $basket->delOrder($_GET['id']);
        header('Location: http://localhost/LPR%207/2/admin.php');
    }
    require 'header.php';
?>
<div class="container">
    <h1>Панель администратора</h1>
    <h3>Добавить товар:</h3>
    <form method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="name_product">
        </div>
        <div class="mb-3">
          <label for="exampleInputDesc" class="form-label">Description</label>
          <input type="text" class="form-control" id="exampleInputDesc" name="descr_product">
        </div>
        <div class="mb-3">
          <label for="exampleInputprice" class="form-label">Price</label>
          <input type="number" min="1" class="form-control" id="exampleInputprice"  name="price_product">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>

    <h3>Все товары:</h3>
    <table class="table">
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Change</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($product->getAllProduct() as $prod){
                    if($_GET['change_id'] == $prod['id']){
                            echo '<tr>
                            <th scope="row">'.$prod["id"].'</th>
                            <form method="post">
                                <td><input name="save_prod_name" value="'.$prod["name"].'"></td>
                                <td><input name="save_prod_descr" value="'.$prod["descr"].'"></td>
                                <td><input type="number" name="save_prod_price" value="'.$prod["price"].'"></td>
                                <td>
                                    <button name="save_product" value="'.$prod["id"].'">Сохранить</button>
                                </td>
                            <form>    
                        </tr>';
                    }else{
                        echo '<tr>
                                <th scope="row">'.$prod["id"].'</th>
                                <td>'.$prod["name"].'</td>
                                <td>'.$prod["descr"].'</td>
                                <td>'.$prod["price"].'</td>
                                <td>
                                    <a href="?action=del_product&id='.$prod["id"].'">Удалить</a>
                                    <a href="?action=change_product&change_id='.$prod["id"].'">Изменить</a>
                                </td>
                            </tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    <br>
    <hr>
    <br>
    <h3>Все заказы:</h3>
    <table class="table">
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">product_id</th>
              <th scope="col">user</th>
              <th scope="col">date</th>
              <th scope="col">Change</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($basket->getAllOreder() as $order){
                    echo '<tr>
                            <th scope="row">'.$order["id"].'</th>
                            <td>'.$order["product_id"].'</td>
                            <td>'.$order["user"].'</td>
                            <td>'.$order["date"].'</td>
                            <td>
                                <a href="?action=del_order&id='.$order["id"].'">Удалить</a>
                            </td>
                        </tr>';
                }
            ?>
        </tbody>
    </table>
</div>
