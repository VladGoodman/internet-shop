<?php
require 'user_module.php'; 

function checkInfoInputs($login, $pass){
    if(empty($login) or empty($pass)){
        return 'Одно из полей не заполнено';
    }
    elseif(!empty($pass) and strlen($pass) < 6 or strlen($pass) >= 20){
        return 'Длинна пароля должна быть больше 6-ти и не менее 20-ти символов';
    }
    elseif(!empty($login) and strlen($login) < 6 or strlen($login) >= 20){
        return 'Длинна имени должна быть больше 6-ти и не менее 20-ти символов';
    }
    else{
        return true;
    }
}

if(!empty($_POST)){
    if(checkInfoInputs($_POST['username'], $_POST['password']) === true){
        $user->Registration($_POST['username'], $_POST['password']) === true?
        header('refresh:0; url=login.php'):
        $info = $user->Registration($_POST['username'], $_POST['password']);
    }else{
        $info = checkInfoInputs($_POST['username'], $_POST['password']);
    }
}


require 'header.php';

if(!$user->getUsername()){
    echo '
        <form method="post">
            <label >Username
                <input type="text" name="username">
            </label><br>
            <label >Password
                <input type="text" name="password">
            </label><br>
            <button type="submit">Зарегистрироваться</button>';
            echo $info; 
            echo '
        </form>
        ';
}else{
    echo '<h1>Вы уже авторизированы (<a href="index.php"> На главную</a> )</h1>';
}

?>
