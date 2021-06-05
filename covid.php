<?php

$content = @file_get_contents("https://corona.lmao.ninja/v3/covid-19/countries/belarus");

if ($content === FALSE) {
    $cases = "Загрузка...";
    $recovered = "Загрузка...";
    $deaths = "Загрузка...";
}
else {
    $response = json_decode(file_get_contents("https://corona.lmao.ninja/v3/covid-19/countries/belarus"));
    $cases = $response->cases;
    $recovered = $response->recovered;
    $deaths = $response->deaths;
}

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
                    <a class="nav__link" href="covid.php"><p class="nav-panel__link">COVID-19</p></a>
                    <a class="nav__link" href="courier.php">Стать курьером</a>
                    <a class="nav__link" href="login/">Панель администратора</a>
                </nav>
            </div>
        </section>
    </header>

    <main class="main">
        <section class="covid-intro">
            <div class="container">
                <div class="covid-intro__inner">
                    <h2 class="covid__title">Ситуация с COVID-19 в Республике Беларусь</h2>
                    <div class="cases__inner">
                        <div class="cases">
                            <h2 class="case__title"><?php echo $cases ?></h2>
                            <h3 class="case__subtitle">случаев заболеваний</h3>
                        </div>
                        <div class="recovered">
                            <h2 class="case__title"><?php echo $recovered ?></h2>
                            <h3 class="case__subtitle">случаев выздоровления</h3>
                        </div>
                        <div class="deaths">
                            <h2 class="case__title"><?php echo $deaths ?></h2>
                            <h3 class="case__subtitle">смертельных случаев</h3>
                        </div>
                    </div>
                    <div class="source__inner">
                        <a href="https://t.me/minzdravbelarus" class="source__link">Источник: Министерство здравоохранения Республики Беларусь</a>
                    </div>
                    <div class="symptoms__inner">
                        <h3 class="symptoms__title">Часто наблюдаемые сиптомы:</h3>
                        <p class="symptom-item">сухой кашель</p>
                        <p class="symptom-item">утомляемость</p>
                        <p class="symptom-item">повышение температуры</p>
                    </div>
                    <div class="prevention__inner">
                        <h3 class="prevention__title">Профилактика COVID-19:</h3>
                        <p class="symptom-item">Соблюдайте правила гигиены рук.</p>
                        <p class="symptom-item">Держитесь на безопасном расстоянии от чихающих или кашляющих людей.</p>
                        <p class="symptom-item">Носите маску, когда находитесь в окружении других людей.</p>
                        <p class="symptom-item">Не прикасайтесь руками к глазам, рту или носу.</p>
                        <p class="symptom-item">При кашле или чихании прикрывайте рот и нос локтевым сгибом или платком.</p>
                        <p class="symptom-item">Если вы чувствуете недомогание, оставайтесь дома.</p>
                        <p class="symptom-item">В случае повышения температуры, появления кашля и одышки обратитесь за медицинской помощью.</p>
                    </div>
                </div>
            </div>
    </main>

</body>
</html>