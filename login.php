<?php
require 'modules/user_module.php'; 
echo $user->getFio();
if(!empty($_POST)){
    if(!empty($_POST['email']) and !empty($_POST['password'])){
        $login_info = $user->auth($_POST['email'], $_POST['password']) === true?
        header('refresh:0; url=index.php'): 
        $user->auth($_POST['email'], $_POST['password']);
    }else{
        $login_info = 'Одно из полей пустое';
    }
}

require 'header.php';
if(empty($user->getFio())){
    echo '
        <form method="post">
            <label >Email
                <input type="email" name="email" value="admin@shop.ru" >
            </label><br>
            <label >Password 
                <input type="text" name="password" value="QWEasd123" >
            </label><br>
            <button type="submit">Войти</button>
            <p>'.$login_info.'</p>
        </form> 
        ';
}else{
    echo '<h1>Вы уже авторизированы (<a href="index.php"> На главную</a> )</h1>';
}

?>

