<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: login.php'); // если не залогинен переходим на страницу логина
}

$couriers_array = getCouriers();
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
<body onload="myFunction()">
    <div id="loader"></div>
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
                    <a class="nav__link" href="add_medicine.php">Добавить препарат</a>
                    <a class="nav__link" href="users.php">Пользователи</a>
                    <a class="nav__link" href="orders.php">Заказы</a>
                    <a class="nav__link" href="couriers.php"><p class="nav-panel__link">Курьеры</p></a>
                    <a class="nav__link" href="add_courier.php">Добавить курьера</a>
                </div>
        </section>
    </header>
    <main class="main animate-bottom" style="display:none;" id="content">
        <section class="output">
            <div class="container">
                <table class="output__table">
                    <tr>
                        <th>ID</th>
                        <th>Номер телефона</th>
                        <th>Имя</th>
                        <th>На смене</th>
                        <th>Смена</th>
                        <th>Удалить</th>
                    </tr>
                    <?php foreach ($couriers_array as $row) { ?>
                     <tr>
                         <td><?php echo "$row->courier_id"; ?></td>
                         <td><?php echo "$row->courier_phone"; ?></td>
                         <td><?php echo "$row->courier_name"; ?></td>
                         <?php
                            if ($row->is_online == 0) { ?>
                         <td>-</td>
                         <td>-</td>
                         <?php } else { ?>
                         <td>Да</td>
                         <td><a href="offline_courier.php?courier_id=<?php echo $row->courier_id?>">Закончить</a></td>
                         <?php } ?>
                         <td><a href="remove_courier.php?courier_id=<?php echo $row->courier_id?>">Удалить</a></td>
                     </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </main>
    <script src="../js/preloader.js"></script>
</body>
</html>
