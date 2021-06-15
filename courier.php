<?php

$response = json_decode(file_get_contents("https://corona.lmao.ninja/v3/covid-19/countries/belarus"));

$cases = $response->cases;
$recovered = $response->recovered;
$deaths = $response->deaths;

?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>DELIVERYTEKA</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/shortcut_logo.svg" type="image/vsg">
</head>
<body>
    <header class="header">
        <section class="container">
            <div class="header__inner">
                <a class="logo" href="">
                    <img class="main-logo" src="img/logo.svg" alt="logo">
                </a>
                <nav class="main-navigation">
                    <a class="nav__link" href="index.php">Главная</a>
                    <a class="nav__link" href="covid.php">COVID-19</a>
                    <a class="nav__link" href="courier.php"><p class="nav-panel__link">Стать курьером</p></a>
                    <a class="nav__link" href="login/">Панель администратора</a>
                </nav>
            </div>
        </section>
    </header>
    <main class="courier-main">
        <section class="courier-intro">
            <div class="container">
                <div class="courier-intro__inner">
                    <h2 class="courier__title">Как стать курьером DELIVERYTEKA?</h2>
                    <div class="steps__inner">
                        <div class="step-one">
                            <h2 class="step__title">1</h2>
                            <p class="step__info">Позвоните оператору<br> по номеру:<br> <a class="phone__link" href="tel:+375(29)8877361">+375(29)88-77-361</a></p>
                        </div>
                        <div class="step-two">
                            <h2 class="step__title">2</h2>
                            <p class="step__info">Приедьте в офис<br> с пакетом документов</p>
                        </div>
                        <div class="step-three">
                            <h2 class="step__title">3</h2>
                            <p class="step__info">Пройдите небольшой тест<br> и посмотрите обучающее видео</p>
                        </div>
                        <div class="step-four">
                            <h2 class="step__title">4</h2>
                            <p class="step__info">Станьте курьером доставки DELIVERYTEKA,<br> получите доступ в приложение,<br> всё необходимое - и вперёд,<br> на первый заказ!</p>
                        </div>
                    </div>
                </div>
                <div class="popular-questions__inner">
                    <h2 class="popular-questions__title">Популярные вопросы</h2>
                    <div class="questions__inner">
                        <details class="question">
                            <summary class="question__title">Можно ли выполнять заказы по выходным?</summary>
                            <p class="question__info">Да, вы сами выбираете доступное время.</p>
                        </details>
                        <details class="question">
                            <summary class="question__title">Какое расписание для выполнеия заказов?</summary>
                            <p class="question__info">Расписание Вы составляете самостоятельно, можно выбрать смену от 4 до 8 часов.</p>
                        </details>
                        <details class="question">
                            <summary class="question__title">Сколько обычно заказов выполняется в час?</summary>
                            <p class="question__info">По данным сервиса, в обычный день за час в среднем может быть до двух заказов от пользователей.</p>
                        </details>
                        <details class="question">
                            <summary class="question__title">У меня есть основоное время работы, можно ли совмещать?</summary>
                            <p class="question__info">Да, обычно курьеры могут совмещать основную работу с подработкой.</p>
                        </details>
                        <details class="question">
                            <summary class="question__title">Выдают ли одежду с логотипом?</summary>
                            <p class="question__info">Курьерская служба предоставит вам черно-белую одежду с логотипом сервиса после начала сотрудничества.<br>
                                Не забывайте надевать её на заказы.</p>
                        </details>
                        <details class="question">
                            <summary class="question__title">Какие документы нужны для оформления?</summary>
                            <p class="question__info">Паспорт с пропиской и медецинская книжка.</p>
                        </details>
                        <details class="question">
                            <summary class="question__title">Есть ли страхование во время выполнения заказов?</summary>
                            <p class="question__info">Да — страховое возмещение можно получить в случае серьёзных травм, которые случились с вами во время заказа.<br>
                                За информацией нужно будет обратиться в службу поддержки.</p>
                        </details>
                    </div>
                </div>
                <div class="courier-app__inner">
                    <h2 class="courier-app__title">Приложение DELIVERYTEKA-Courier</h2>
                    <p class="courier-app__info">Скачать мобильное приложение DELIVERYTEKA-Courier можно по <a class="courier-app__link" href="DeliverytekaCourier.rar">ссылке</a>.</p>
                </div>
            </div>
    </main>
</body>
</html>