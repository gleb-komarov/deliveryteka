<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: login.php'); // если не залогинен переходим на страницу логина
}

$medicine_form_array = getMedicineForms();
$medicine_category_array = getMedicineCategories();

if (!empty($_POST)) {
    $errors = []; // создаем массив ошибок
    $medicine_name = isset($_POST['medicine_name']) ? trim($_POST['medicine_name']) : '';
    $medicine_price = isset($_POST['medicine_price']) ? trim($_POST['medicine_price']) : '';
    $medicine_country = isset($_POST['medicine_country']) ? trim($_POST['medicine_country']) : '';
    $medicine_pack = isset($_POST['medicine_pack']) ? trim($_POST['medicine_pack']) : '';
    $medicine_dosage = isset($_POST['medicine_dosage']) ? trim($_POST['medicine_dosage']) : '';
    $medicine_form= isset($_POST['medicine_form']) ? trim($_POST['medicine_form']) : '';
    $medicine_category = isset($_POST['medicine_category']) ? trim($_POST['medicine_category']) : '';
    if ($_FILES["medicine_img"]["type"] != "image/jpeg" && $_FILES["medicine_img"]["type"] != "image/png")
    {
        $errors[] = "Картинка не выбрана";
    }
    if ($_FILES["medicine_pdf"]["type"] != "application/pdf")
    {
        $errors[] = "PDF-файл не выбран";
    }
    if (!$medicine_name) {
        $errors[] = "Введите название препарата";
    }
    if (!$medicine_price) {
        $errors[] = "Введите цену препарата";
    }
    if (!$medicine_country) {
        $errors[] = "Введите страну препарата";
    }
    if (!$medicine_pack) {
        $errors[] = "Введите упаковку препарата";
    }
    if (!$medicine_dosage) {
        $errors[] = "Введите дозировку препарата";
    }
    if (!$medicine_form) {
        $errors[] = "Выберите форму препарата";
    }
    if (!$medicine_category) {
        $errors[] = "Выберите категорию препарата";
    }
    if (empty($errors)) { // если ошибок нету
        $result = "<p class='error__list'>Вы успешно добавили препарат $medicine_name</p>";

        $name = $_FILES["medicine_img"]["name"];
        move_uploaded_file($_FILES["medicine_img"]["tmp_name"], $name);

        $name = $_FILES["medicine_pdf"]["name"];
        move_uploaded_file($_FILES["medicine_pdf"]["tmp_name"], $name);
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
                    <a class="nav__link" href="add_medicine.php"><p class="nav-panel__link">Добавить препарат</p></a>
                    <a class="nav__link" href="users.php">Пользователи</a>
                    <a class="nav__link" href="orders.php">Заказы</a>
                    <a class="nav__link" href="couriers.php">Курьеры</a>
                    <a class="nav__link" href="add_courier.php">Добавить курьера</a>
                </div>
        </section>
    </header>

    <main class="main animate-bottom" style="display:none;" id="content">
        <section class="login">
            <div class="container">
                <div class="login__inner">
                    <form class="login__form" action="" method="post" enctype="multipart/form-data">
                        <h3 class="add__title">Введите данные препарата для добавления в БД:</h3>
                        <input class="medicine-name__input" type="text" name="medicine_name" maxlength="18" placeholder="Название препарата" title="Введите название препарата">
                        <input class="medicine-price__input" type="number" step="any" name="medicine_price" min="0.1" max="999" placeholder="Цена препарата" title="Введите цену препарата">
                        <input class="medicine-country__input" type="text" name="medicine_country" maxlength="18" placeholder="Страна препарата" title="Введите страну препарата">
                        <input class="medicine-pack__input" type="text" name="medicine_pack" maxlength="18" placeholder="Упаковка препарата" title="Введите упаковку препарата">
                        <input class="medicine-dosage__input" type="text" name="medicine_dosage" maxlength="18" placeholder="Дозировка препарата" title="Введите дозировку препарата">
                        <select class="medicine-form__select" name="medicine_form" title="Выберите форму препарата">
                            <option disabled selected="selected">Выберите форму препарата</option>
                            <?php
                                foreach ($medicine_form_array as $row) { ?>
                                <option value="<?php echo "$row->medicine_form_id"?>"><?php echo "$row->medicine_form_name"?></option>
                            <?php } ?>
                        </select>
                        <select class="medicine-category__select" name="medicine_category" title="Выберите категорию препарата">
                            <option disabled selected="selected">Выберите категорию препарата</option>
                            <?php
                            foreach ($medicine_category_array as $row) { ?>
                                <option value="<?php echo "$row->medicine_category_id"?>"><?php echo "$row->medicine_category_name"?></option>
                            <?php } ?>
                        </select>
                        <p class="form-input__header">Выберите картинку препарата:</p>
                        <input class="medicine-img__input" id="medicine-img" type="file" name="medicine_img" title="Выберете картинку препарата">
                        <p class="form-input__header">Выберите PDF-файл препарата:</p>
                        <input class="medicine-pdf__input" id="medicine-pdf" type="file" name="medicine_pdf" title="Выберете PDF-файл препарата">
                        <button class="accept__button" type="submit">Добавить</button>
                        <?php
                        getErrors($errors);
                        $errors = [];
                        echo $result;
                        unset($result);
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="../js/preloader.js"></script>
</body>
</html>
