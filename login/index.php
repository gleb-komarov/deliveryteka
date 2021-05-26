<?php
require '../function.php';
session_start();

if ($_SESSION['login']) {
    header('Location: ../panel/');
}

if (!empty($_POST)) {
    $login = isset($_POST['login']) ? $_POST['login'] : ''; // если введено значения name то удаляем из него пробелы и присваиваем это переменной
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // если введено значения password то удаляем из него пробелы и присваиваем это переменной
    $user = loginUser($login, $password); // переменной user приравниваем переменную
    $errors = []; // массив для ошибок
    if (!empty($user)) { // если user существует
        $_SESSION['id'] = $user['admin_id']; // добавляем id пользователя в сессию
        $_SESSION['login'] = $user['admin_login']; // добавляем login пользователя в сессию
        header('Location: ../panel/'); // переходим в панель
        exit; // прерываем все процессы
    } else {
        $error = "Неверный логин или пароль!"; // добавляем ошибку
    }
}
?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Вход в панель администратора DELIVERYTEKA</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/shortcut_logo.svg" type="image/vsg">
</head>

<body>
    <header class="header">
        <section class="container">
            <div class="header__inner">
                <nav class="main-navigation">
                    <a class="nav__link" href="../"><img class="arrow-back__link" src="../img/back_arrow.svg" alt="back_arrow" width="19" height="8">На главную</a>
                </nav>
            </div>
        </section>
    </header>

    <main class="main">
        <section class="login">
            <div class="container">
                <div class="login__inner">
                    <img src="../img/logo_panel.svg" alt="logo_panel">
                    <form class="login__form" action="" method="post">
                        <input class="login__input" type="text" name="login" maxlength="16" placeholder="Логин" title="Введите Ваш логин">
                        <input class="password__input" type="password" name="password" maxlength="16" placeholder="Пароль" title="Введите Ваш пароль">
                        <button class="accept__button" type="submit">Войти</button>
                        <p class="login__error"><?php echo $error; unset($error)?></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>