<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: login.php'); // если не залогинен переходим на страницу логина
}

$users_array = getUsers();
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
                    <a class="nav__link" href="users.php"><p class="nav-panel__link">Пользователи</p></a>
                    <a class="nav__link" href="orders.php">Заказы</a>
                    <a class="nav__link" href="couriers.php">Курьеры</a>
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
                        <th>Адрес</th>
                        <th>Номер мед. карты</th>
                    </tr>
                    <?php foreach ($users_array as $row) { ?>
                     <tr>
                         <td><?php echo "$row->user_id"; ?></td>
                         <td><?php echo "$row->user_phone"; ?></td>
                         <?php if ( $row->user_name != "") { ?>
                           <td><?php echo "$row->user_name"; ?></td>
                         <?php } else {?>
                           <td>-</td>
                         <?php } ?>
                         <?php if ( $row->user_address != "") { ?>
                             <td><?php echo "$row->user_address"; ?></td>
                         <?php } else {?>
                             <td>-</td>
                         <?php } ?>
                         <?php if ( $row->med_card_number != "") { ?>
                             <td><?php echo "$row->med_card_number"; ?></td>
                         <?php } else {?>
                             <td>-</td>
                         <?php } ?>
                     </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </main>
    <script src="../js/preloader.js"></script>
</body>
</html>
