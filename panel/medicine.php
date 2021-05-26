<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: login.php'); // если не залогинен переходим на страницу логина
}

$medicine_array = addImageAndPdfInMedicine(getMedicine());
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
                    <a class="nav__link" href="medicine.php"><p class="nav-panel__link">Препараты</p></a>
                    <a class="nav__link" href="#">Добавить препарат</a>
                    <a class="nav__link" href="#">Удалить препарат</a>
                    <a class="nav__link" href="users.php">Пользователи</a>
                    <a class="nav__link" href="orders.php">Заказы</a>
                    <a class="nav__link" href="couriers.php">Курьеры</a>
                    <a class="nav__link" href="add_courier.php">Добавить курьера</a>
                </div>
        </section>
    </header>

    <main class="main">
        <section class="output">
            <div class="container">
                <div class="output__inner">
                    <table class="output__table">
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Страна</th>
                            <th>Упаковка</th>
                            <th>Дозировка</th>
                            <th>Форма</th>
                            <th>Категория</th>
                            <th>Картинка</th>
                            <th>PDF</th>
                        </tr>
                        <?php foreach ($medicine_array as $row) { ?>
                         <tr>
                             <td><?php echo "$row->medicine_id"; ?></td>
                             <td><?php echo "$row->medicine_name"; ?></td>
                             <td><?php echo "$row->medicine_price"; ?></td>
                             <td><?php echo "$row->medicine_country"; ?></td>
                             <td><?php echo "$row->medicine_pack"; ?></td>
                             <td><?php echo "$row->medicine_dosage"; ?></td>
                             <td><?php echo "$row->medicine_form"; ?></td>
                             <td><?php echo "$row->medicine_category"; ?></td>
                             <td><a href="<?php echo "$row->medicine_img";?>" target="_blank"><img class="output__img" src="<?php echo "$row->medicine_img";?>" width="40" height="40" alt="Картинка"></a></td>
                             <?php if ( file_exists($row->medicine_pdf)) { ?>
                               <td><a href="<?php echo "$row->medicine_pdf"; ?>" target="_blank">PDF-файл</a></td>
                             <?php } else {?>
                               <td>-</td>
                             <?php } ?>
                         </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
