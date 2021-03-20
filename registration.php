<?php
require 'user_module.php'; 
setlocale(LC_ALL, "ru_RU.UTF-8");

function checkFioForCorrectness($string){
    $change_fio = explode(' ', $string);
    if(count($change_fio) === 2 || count($change_fio) === 3){
        if(strlen($string)<6 or strlen($string)>50){
            return 'Поле ФИО должно содержать больше 6 символов и менее 50';
        }
        else{
            return true;
        }
    }else{
        return 'Поле ФИО должно состоять из 2х или 3х слов';
    }
}

function checkPasswordForCorrectness($password, $repeat_password){
    if(strlen($password) < 6 or strlen($password) > 20){
        return 'Пароль должен содержать больше 6 и менее 20 символов';
    }elseif($password !== $repeat_password){
        return 'Пароли не совпадают';
    }else{
        return true;
    }
}

function checkInfoInputs($fio, $email, $password, $repeat_password){
    if($fio==false or $email==false or $password==false or $repeat_password==false){
        return 'Одно из полей не заполнено';
    }elseif(checkFioForCorrectness($fio) !== true){
        return checkFioForCorrectness($fio);
    }elseif(checkPasswordForCorrectness($password, $repeat_password) !== true){
        return checkPasswordForCorrectness($password, $repeat_password);
    }else{
        return true;
    }
}

if(!empty($_POST)){
    if(checkInfoInputs($_POST['fio'],$_POST['email'], $_POST['password'], $_POST['repeat_password']) === true){
        if($user->registration($_POST['fio'], $_POST['email'], $_POST['password']) === true){
            $form_info = 'Регистрация пройдена успешно. Переадресация на логин...';
            header('refresh:5; url=login.php');
        }else{
            $form_info = $user->registration($_POST['fio'], $_POST['email'], $_POST['password']);
        }
    }
    else{
        $form_info = checkInfoInputs($_POST['fio'],$_POST['email'], $_POST['password'], $_POST['repeat_password']);
    }
}

// HTML CONTENT
require 'header.php';

if(!$user->getUsername()){
    echo '
        <form method="post">
            <label >ФИО
                <input type="text" name="fio">
            </label><br>
            <label >E-mail
                <input type="email" name="email">
            </label><br>
            <label >Password
                <input type="password" name="password">
            </label><br>
            <label >Reapeat password
                <input type="password" name="repeat_password">
            </label><br>
            <button type="submit">Зарегистрироваться</button>';
            echo $form_info.'
        </form>'; 
}else{
    echo '<h1>Вы уже авторизированы (<a href="index.php"> На главную</a> )</h1>';
}
?>
