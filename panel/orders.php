<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: login.php'); // если не залогинен переходим на страницу логина
}

$orders_array = getOrders();
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
                    <a class="nav__link" href="orders.php"><p class="nav-panel__link">Заказы</p></a>
                    <a class="nav__link" href="couriers.php">Курьеры</a>
                    <a class="nav__link" href="add_courier.php">Добавить курьера</a>
                </div>
        </section>
    </header>
    <main class="main animate-bottom" style="display:none;" id="content"">
        <section class="output">
            <div class="container">
                <table class="output__table">
                    <tr>
                        <th>ID</th>
                        <th>Дата/Время</th>
                        <th>Статус</th>
                        <th>Курьер</th>
                        <th>Клиент</th>
                        <th>Адрес</th>
                        <th>Коммент</th>
                        <th>Платеж</th>
                        <th>Сумма</th>
                    </tr>
                    <?php foreach ($orders_array as $row) { ?>
                        <tr>
                            <td><?php echo "$row->order_id"; ?></td>
                            <td><?php echo "$row->order_datetime"; ?></td>
                            <td><?php echo "$row->order_status"; ?></td>
                            <td><?php echo "$row->courier_phone"; ?></td>
                            <td><?php echo "$row->user_phone"; ?></td>
                            <td><?php echo "$row->user_address"; ?></td>
                            <td><?php echo "$row->user_comment"; ?></td>
                            <td><?php echo "$row->pay_method"; ?></td>
                            <td><?php echo "$row->order_total"; ?></td>
<!--                            --><?php //$order_content_array = addImageAndPdfInMedicine(getOrderContent($row->order_id)); $order_id = $row->order_id ?>
                        </tr>
<!--                        order content view-->
<!--                    --><?php //foreach ($order_content_array as $row) { ?>
<!--                            <tr class="order_content" id="content_--><?php //echo "$order_id"; ?><!--">-->
<!--                                <td>--><?php //echo "$row->medicine_id"; ?><!--</td>-->
<!--                                <td>--><?php //echo "$row->medicine_name"; ?><!--</td>-->
<!--                                <td>--><?php //echo "$row->medicine_price"; ?><!--</td>-->
<!--                                <td>--><?php //echo "$row->medicine_country"; ?><!--</td>-->
<!--                                <td>--><?php //echo "$row->medicine_pack"; ?><!--</td>-->
<!--                                <td>--><?php //echo "$row->medicine_dosage"; ?><!--</td>-->
<!--                                <td>--><?php //echo "$row->medicine_form"; ?><!--</td>-->
<!--                                <td><a href="--><?php //echo "$row->medicine_img";?><!--" target="_blank"><img class="output__img" src="--><?php //echo "$row->medicine_img";?><!--" width="40" height="40" alt="Картинка"></a></td>-->
<!--                                --><?php //if ( file_exists($row->medicine_pdf)) { ?>
<!--                                    <td><a href="--><?php //echo "$row->medicine_pdf"; ?><!--" target="_blank">PDF-файл</a></td>-->
<!--                                --><?php //} else {?>
<!--                                    <td>-</td>-->
<!--                                --><?php //} ?>
<!--                            </tr>-->
<!--                        --><?php //} ?>
                    <?php } ?>
                </table>
            </div>
        </section>
    </main>
    <script src="../js/preloader.js"></script>
    <script>
        function showhide(id) {
            var e = document.getElementById(id);
            e.style.display = (e.style.display == 'block') ? 'none' : 'block';
        }
    </script>
</body>
</html>