<?php
require 'user_module.php'; 
echo $user->getUsername();
if(!empty($_POST)){
    if(!empty($_POST['username']) and !empty($_POST['password'])){
        $user->auth($_POST['username'], $_POST['password'])?
        header('refresh:0; url=index.php'): null;
    }
}
require 'header.php';
if(empty($user->getUsername())){
    echo '
        <form method="post">
            <label >Username
                <input type="text" name="username">
            </label><br>
            <label >Password
                <input type="text" name="password">
            </label><br>
            <button type="submit">Войти</button>
        </form> 
        ';
}else{
    echo '<h1>Вы уже авторизированы (<a href="index.php"> На главную</a> )</h1>';
}

?>

