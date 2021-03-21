<head>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
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