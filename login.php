<?php
session_start();
require 'user_module.php';
if(!empty($_POST)){
    if(!empty($_POST['username']) and !empty($_POST['password'])){
        $user->Auth($_POST['username'], $_POST['password']);
        header('refresh:0; url=index.php');
    }
}
echo $user->getUsername();
?>
<form method="post">
    <label >Username
        <input type="text" name="username">
    </label><br>
    <label >Password
        <input type="text" name="password">
    </label><br>
    <button type="submit">Войти</button>
</form>