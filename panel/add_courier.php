<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: login.php'); // если не залогинен переходим на страницу логина
}

if (!empty($_POST)) {
    $errors = []; // создаем массив ошибок
    $username = isset($_POST['name']) ? trim($_POST['name']) : ''; // если введено значения name то удаляем из него пробелы и присваиваем это переменной
    $password = isset($_POST['password']) ? trim($_POST['password']) : ''; // если введено значения password то удаляем из него пробелы и присваиваем это переменной
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : ''; // если введено значения phone то удаляем из него пробелы и присваиваем это переменной
    if (!$username) { // если нету переменной имени
        $errors[] = "Введите имя курьера";
    } elseif (isUniqueCourierPhone($phone)) { // проверка телефона на уникальность
        $errors[] = "Такой номер уже зарегистрирован";
    }
    if (!$password) { // если нету переменной пароля
        $errors[] = "Введите пароль курьера";
    }
    if (!$phone) { // если нету переменной email
        $errors[] = "Введите номер курьера";
    }
    if (empty($errors)) { // если ошибок нету
        registerCourier($phone, $password, $username); // срабатывает функция регистрации
    }
}
?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Панель администратора DELIVERYTEKA</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/shortcut_logo.svg" type="image/vsg">
</head>

<body>
    <header class="header">
        <section class="container">
                <div class="header__inner">
                    <a class="nav__link" href="../"><img class="arrow-back__link" src="../img/back_arrow.svg" alt="back_arrow" width="19" height="8">На главную</a>
                    <nav class="main-navigation">
                        <a class="nav__link" href="#"><p class="nav-panel__link">Здравствуйте, <?php echo $admin_login; ?>!</p></a>
                        <a class="nav__link" href="../logout">Выйти</a>
                    </nav>
                </div>
                <div class="under-header__inner">
                    <a class="nav__link" href="medicine.php">Препараты</a>
                    <a class="nav__link" href="#">Добавить препарат</a>
                    <a class="nav__link" href="#">Удалить препарат</a>
                    <a class="nav__link" href="users.php">Пользователи</a>
                    <a class="nav__link" href="#">Заказы</a>
                    <a class="nav__link" href="#">Курьеры</a>
                    <a class="nav__link" href="#"><p class="nav-panel__link">Добавить курьера</p></a>
                </div>
        </section>
    </header>

    <main class="main">
        <section class="login">
            <div class="container">
                <div class="login__inner">
                    <form class="login__form" action="" method="post">
                        <h3 class="add__title">Введите данные курьера для добавления в БД:</h3>
                        <input class="phone__input" type="text" name="phone" maxlength="16" placeholder="Номер телефона" title="Введите номер телефона">
                        <input class="login__input" type="text" name="name" maxlength="16" placeholder="Имя" title="Введите имя">
                        <input class="password__input" type="password" name="password" maxlength="16" placeholder="Пароль" title="Введите пароль">
                        <button class="login__button" type="submit">Добавить</button>
                        <?php getErrors($errors); $errors = [];?>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
