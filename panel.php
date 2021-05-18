<?php
session_start();
$admin_login = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Панель администратора DELIVERYTEKA</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/shortcut_logo.svg" type="image/vsg">
</head>

<body>
    <header class="header">
        <section class="container">
                <div class="header__inner">
                    <a class="nav__link" href="index.php"><img class="arrow-back__link" src="img/back_arrow.svg" alt="back_arrow" width="19" height="8">На главную</a>
                    <nav class="main-navigation">
                        <a class="nav__link" href="#">Здравствуйте, <?php echo $admin_login; ?>!</a>
                        <a class="nav__link" href="logout.php">Выйти</a>
                    </nav>
                </div>
                <div class="under-header__inner">
                    <a class="nav__link" href="#">Препараты</a>
                    <a class="nav__link" href="#">Добавить препарат</a>
                    <a class="nav__link" href="#">Удалить препарат</a>
                    <a class="nav__link" href="#">Пользователи</a>
                    <a class="nav__link" href="#">Заказы</a>
                    <a class="nav__link" href="#">Курьеры</a>
                    <a class="nav__link" href="#">Добавить курьера</a>
                </div>
        </section>
    </header>

    <main class="main">
        <section class="login">
            <div class="container">
                <div class="login__inner">
                    <img src="img/logo_panel.svg" alt="logo_panel">
                </div>
            </div>
        </section>
    </main>
</body>
</html>