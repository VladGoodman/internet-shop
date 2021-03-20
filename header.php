
<header>
    <div class="container">
        <div class="header__left">
            <a href="index.php">Главная</a>
        </div>
        <div class="header__right">
            <?php
                if($user->getFio()){
                    echo '
                    <a href="profile.php">'.$user->getFio().' ('.$user->getRole().')</a>
                    <a href="?logout">Выход</a>';
                }else{
                    echo '
                    <a href="login.php">Вход</a>
                    <a href="registration.php">Регистрация</a>';
                }
            ?>
        </div>
    </div>
</header>