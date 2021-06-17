-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 17 2021 г., 20:16
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id15940875_deliverytekadb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_login` varchar(16) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_root` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_login`, `admin_password`, `admin_root`) VALUES
(1, 'komaroff', 'komaroff', NULL),
(2, 'roman', 'roman', NULL),
(3, 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `basket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `count` int(3) NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`basket_id`, `user_id`, `medicine_id`, `count`, `sum`) VALUES
(135, 37, 32, 1, 22.02);

-- --------------------------------------------------------

--
-- Структура таблицы `couriers`
--

CREATE TABLE `couriers` (
  `courier_id` int(11) NOT NULL,
  `courier_phone` varchar(20) NOT NULL,
  `courier_password` varchar(255) NOT NULL,
  `courier_name` varchar(25) NOT NULL,
  `is_online` int(1) NOT NULL,
  `active_order_id` int(11) DEFAULT NULL,
  `all_shifts` int(11) NOT NULL,
  `all_hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `couriers`
--

INSERT INTO `couriers` (`courier_id`, `courier_phone`, `courier_password`, `courier_name`, `is_online`, `active_order_id`, `all_shifts`, `all_hours`) VALUES
(9, '+375 (29)585-60-30', '$2y$10$SjV4XFmso6HPXQ0MzVs6VOOT9QzsManZrhXguJmsEtNimJQr.LKOS', 'Роман', 0, NULL, 3, 13),
(10, '+375 (29)887-73-61', '$2y$10$PfNdsFT7fM9Er/fMhA3UYeKT935PGVNlxyovPo3Coepp4H7WDWsKq', 'Глеб', 0, NULL, 3, 13),
(11, '+375 (29)887-73-21', '$2y$10$wYGLO0uTjVMwwiX7kwgAMeZldxY95DYU8UQB6KBCXnVPhC5oYsQRS', 'Игорь', 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `favorit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(25) NOT NULL,
  `medicine_category` int(11) NOT NULL,
  `medicine_form` int(11) NOT NULL,
  `medicine_price` float NOT NULL,
  `medicine_pack` varchar(10) NOT NULL,
  `medicine_dosage` varchar(15) NOT NULL,
  `medicine_country` varchar(25) NOT NULL,
  `medicine_description` text NOT NULL,
  `medicine_is_recipe` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `medicine_category`, `medicine_form`, `medicine_price`, `medicine_pack`, `medicine_dosage`, `medicine_country`, `medicine_description`, `medicine_is_recipe`) VALUES
(1, 'АДИЦЕФ', 1, 6, 30.2, '10', '300', 'Палестина', 'Бежево-голубые капсулы с логотипом Фармакар на крышечке и корпусе капсулы.', 1),
(2, 'АКВА МАРИС', 8, 11, 18.87, '1', '200', 'Хорватия', 'Спрей назальный Аква Марис® Эктоин - это полностью натуральное средство, которое создает физическое препятствие («барьер») для прикрепления аллергенов к слизистой оболочке носа. Аква Марис® Эктоин защищает от развития аллергии, препятствует развитию аллергического ринита и способствует восстановлению слизистой оболочки носа, повреждённой под воздействием аллергенов.\r\n\r\nРаствор натуральной морской соли, входящий в состав Аква Марис® Эктоин, способствует механическому удалению аллергенов с поверхности слизистой оболочки носа и очищает ее поверхность от осевшей уличной и домашней пыли. Микроэлементы и минералы морской соли улучшают функцию мерцательного эпителия, оказывают противовоспалительное и восстановительное действие на слизистую оболочку полости носа.\r\nАква Марис® Эктоин не вызывает привыкания. Продолжительность применения не ограничена.\r\n\r\nПоказания:\r\n-Защита слизистой оболочки носа от воздействия:\r\n• пыльцы (в период сезонного цветения растений);\r\n• бытовых аллергенов (клещи домашней пыли);\r\n• шерсти животных;\r\n• аллергенов тараканов и других насекомых;\r\n• грибковых аллергенов;\r\n• аллергенов бытовой химии, а также других инородных частиц,\r\nпопадающих в полость носа при дыхании.\r\n-Симптоматическое лечение аллергического ринита с целью уменьшения выраженности зуда, чихания, насморка, слезотечения и заложенности носа.\r\n\r\nСпособ применения:\r\nИнтраназально.\r\nДетям с 2-х лет и взрослым по 1-2 впрыскивания в каждую ноздрю 3-4 раза в день. В случае необходимости препарат можно использовать так часто, как это требуется для достижения желаемого эффекта. Детям младше 10 лет применять спрей только под контролем взрослых.\r\n\r\nОсобые указания:\r\nДля максимального профилактического эффекта спрей назальный Аква Марис® Эктоин необходимо использовать за 10-15 минут до контакта с предполагаемым аллергеном или иным раздражителем.\r\nСпрей назальный Аква Марис® Эктоин следует применять систематически на протяжении всего периода активного цветения и пыления растений, вызывающих аллергию. Рекомендуется повторно использовать спрей для носа Аква Марис® Эктоин после каждого очищения носовой полости (высмаркивания или промывания).\r\n\r\nУказания по применению:\r\nПеред первым использованием следует снять защитный колпачок и нажать на распылитель 2-3 раза, чтобы удалить из него воздух. Не следует отрезать наконечник. Если функция спрея нарушена (например, если флакон находился в горизонтальном положении), то, удерживая флакон в вертикальном положении, необходимо нажать несколько раз на распылитель. По гигиеническим соображениям каждый флакон спрея назального Аква Марис® Эктоин должен использоваться только одним человеком. После каждого применения насухо вытирайте наконечник распылителя и плотно закрывайте флакон.\r\n\r\nПротивопоказания:\r\nПовышенная чувствительность к компонентам препарата.\r\nДетский возраст до 2-х лет. Не влияет на скорость реакции при управлении автотранспортом и работе с другими механизмами.\r\n\r\nНет противопоказаний к применению у беременных и кормящих женщин.', 0),
(3, 'БРОНХИПРЕТ', 7, 13, 10.91, '1', '50', 'Германия', 'БРОНХИПРЕТ (СИРОП ФЛ. 50 МЛ №1) BIONORICA SE-ГЕРМАНИЯ', 0),
(4, 'ДИМЕСТИН', 10, 14, 17.77, '1', '1', 'Палестина', 'ДИМЕСТИН (ГЕЛЬ ДЛЯ НАРУЖНОГО ПРИМЕНЕНИЯ 1 МГ/Г ТУБА 30 Г №1) BIRZEIT PHARMACEUTICAL COMPANY (BPC)-ПАЛЕСТИНА', 0),
(5, 'СТОПДИАР', 12, 1, 6.79, '24', '100', 'Польша', 'СТОПДИАР (ТАБ. П/П ОБ. 100 МГ №24Х1) GEDEON RICHTER POLAND CO LTD-ПОЛЬША', 0),
(6, 'АСПИКАРД', 2, 1, 3.17, '10', '75', 'Беларусь', 'АСПИКАРД (ТАБЛ.П.О.КИШЕЧ/РАСТВОР. 75 МГ №10Х5) БОРИСОВСКИЙ ЗАВОД МЕДИЦИНСКИХ ПРЕПАРАТОВ ОАО-БЕЛАРУСЬ', 0),
(7, 'МИРАСЕПТИН', 4, 10, 8.71, '1', '0.1', 'Беларусь', 'МИРАСЕПТИН (Р-Р Д/НАРУЖ.ПРИМ. 0,1 МГ/МЛ ФЛ. 100 МЛ С РЕЗЬБОВЫМ КОЛПАЧКОМ №1) ФАРМЛЭНД БЕЛОРУССКО-ГОЛЛАНДСКОЕ СП ООО-БЕЛАРУСЬ', 0),
(8, 'СУПРАДИН', 6, 4, 28, '1', '14', 'Швейцария', 'Супрадин Иммуно Форте – комбинация цинка и витамина С, усиленная натуральными экстрактами эхинацеи и прополиса – усиливает иммунитет в период простудных заболеваний:\r\nПри первых проявлениях простуды;\r\nВ период выздоровления после заболеваний.\r\n\r\nСодержание компонентов в 2 саше, мг: Витамин С 180, Цинк 15, Гидроксикоричные кислоты 12,2, Флавоны 7,8.\r\n\r\nСвойства компонентов:\r\nВитамин C стимулирует иммунную систему.\r\nЦинк помогает в выработке антител, защищающих от инфекционных заболеваний.\r\nПрополис обладает антибактериальным и иммуномодулирующим действием.\r\nЭхинацея оказывает противовоспалительное действие, повышает способность организма к сопротивлению бактериям и вирусам.\r\n\r\nПротивопоказания:\r\nИндивидуальная непереносимость компонентов (в т. ч. продуктов жизнедеятельности пчел), беременность, кормление грудью, склонность к аллергическим реакциям, прогрессирующие системные заболевания, детям до 14 лет. Не превышать рекомендуемую суточную дозу. Перед применением необходимо проконсультироваться с врачом.\r\n\r\nСпособ применения:\r\nСупрадин Иммуно Форте выпускается в формате растворимых во рту гранул, которые не требуется запивать водой, их можно принимать в любом месте! Взрослым и детям старше 14 лет - по 1 пакетику-саше 2 раза в день во время еды. Продолжительность приема - 1 месяц.\r\n\r\nБиологически активная добавка (БАД) к пище. Не является лекарственным средством. Перед применением рекомендуется проконсультироваться с врачом. Содержит подсластители.', 0),
(9, 'ФИГУРИН', 9, 6, 37.25, '30', '60', 'Беларусь', 'ФИГУРИН (КАПС. 60 МГ №10Х6) ЛЕКФАРМ СООО-БЕЛАРУСЬ', 0),
(10, 'АЛОТЕНДИН', 11, 1, 22.3, '30', '5', 'Венгрия', 'АЛОТЕНДИН (ТАБЛ. 5МГ/5МГ №10Х3) EGIS PLC-ВЕНГРИЯ', 0),
(11, 'АЛБЕНДАЗОЛ', 16, 1, 3.21, '2x1', '200мг', 'Беларусь', 'АЛБЕНДАЗОЛ (ТАБ. П/П ОБ. 200 МГ №2Х1) БОРИСОВСКИЙ ЗАВОД МЕДИЦИНСКИХ ПРЕПАРАТОВ ОАО-БЕЛАРУСЬ', 0),
(12, 'БАРБОВАЛ', 17, 5, 4.64, '1', '25мл', 'Украина', 'БАРБОВАЛ (КАПЛИ ДЛЯ ПЕРОРАЛЬНОГО ПРИМЕНЕНИЯ ФЛ. 25 МЛ №1) ФАРМАК, ОАО-УКРАИНА\r\n', 0),
(13, 'ТАРДОКС ', 1, 6, 8.77, '5х2', '100мг', 'Польша', 'ТАРДОКС (КАПСУЛЫ ТВЕРДЫЕ 100 МГ №5Х2) TARCHOMIN PHARMACEUTICAL WORKS POLFA S.A.-ПОЛЬША', 0),
(15, 'ЗОДАК', 10, 5, 17.36, '10мг', '1мл', 'Чешская Республика', 'ЗОДАК (КАПЛИ Д/ПРИЕМА ВНУТРЬ 10МГ/1МЛ ФЛ. 20 МЛ С КРЫШКОЙ-КАПЕЛЬНИЦЕЙ №1) ZENTIVA K.S.-ЧЕШСКАЯ РЕСПУБЛИКА', 0),
(17, 'ЭРИУС', 10, 13, 22.46, '60мл', '0,5мг/мл', 'Бельгия', 'ЭРИУС (СИРОП 0,5МГ/МЛ ФЛ. 60 МЛ №1) SCHERING-PLOUGH LABO N.V.-БЕЛЬГИЯ', 0),
(18, 'АЦЦ', 7, 13, 15.47, '100мл', '20 мг/мл', 'Германия', 'АЦЦ (СИРОП 20 МГ/МЛ ФЛ. 100 МЛ №1) PHARMA WERNIGERODE GMBH-ГЕРМАНИЯ', 0),
(19, 'ЛИНКАС', 7, 15, 4.68, '8', '2', 'Пакистан', 'ЛИНКАС (ПАСТИЛКИ С МЯТНЫМ ВКУСОМ №8Х2) HERBION PAKISTAN PRIVATE LIMITED-ПАКИСТАН', 0),
(20, 'ГЕРБИОН ПЛЮЩ', 7, 15, 9.52, '8х2', '35 мг', 'Словения', 'ГЕРБИОН ПЛЮЩ (ПАСТИЛКИ 35 МГ №8Х2) KRKA, D.D.-СЛОВЕНИЯ', 0),
(21, 'КСИНАЗОЛ', 8, 11, 7.43, '1', '1мг/мл', 'Беларусь', 'КСИНАЗОЛ (СПРЕЙ НАЗАЛЬНЫЙ С МЕНТОЛОМ И ЭВКАЛИПТОВЫМ МАСЛОМ 1МГ/МЛ ФЛ. 10 МЛ №1) РУБИКОН ООО-БЕЛАРУСЬ\r\nСпрей назальный с ментолом и эвкалиптовым маслом', 0),
(22, 'АМПИЦИЛЛИНА ТРИГИДРАТ', 1, 1, 3.12, '10х2', '250 мг', 'Беларусь', 'АМПИЦИЛЛИНА ТРИГИДРАТ (ТАБЛ. 250 МГ №10Х2) БЕЛМЕДПРЕПАРАТЫ РУП-БЕЛАРУСЬ', 0),
(23, 'ОСПАМОКС', 1, 1, 11.52, '6х2', '1000 мг', 'Австрия', 'ОСПАМОКС (ТАБ. П/П ОБ. 1000 МГ №6Х2) SANDOZ GMBH-АВСТРИЯ', 0),
(24, 'АМОКСИКАР', 1, 6, 10.78, '8х2', '500 мг', 'Палестина', 'АМОКСИКАР (КАПС. 500 МГ №8Х2) PHARMACARE PLC-ПАЛЕСТИНА', 0),
(25, 'МЕТРОНИДАЗОЛ', 1, 1, 5.32, '10х3', '250 мг', 'Беларусь', 'МЕТРОНИДАЗОЛ (ТАБЛ. 250 МГ №10Х3) БЕЛМЕДПРЕПАРАТЫ РУП-БЕЛАРУСЬ', 0),
(26, 'НАЗОНЕКС', 8, 11, 34.4, '1', '50мкг/доза', 'Бельгия', 'НАЗОНЕКС (СПРЕЙ НАЗАЛЬНЫЙ ДОЗИРОВАННЫЙ 50МКГ/ДОЗА ФЛ. 140 ДОЗ №1) SCHERING-PLOUGH LABO N.V.-БЕЛЬГИЯ\r\nспрей назальный дозированный', 0),
(27, 'ВИБРОЦИЛ', 10, 5, 14.16, '15мл', '2,5мг/1мл', 'Швейцария', 'ВИБРОЦИЛ (КАПЛИ НАЗАЛЬНЫЕ (2,5МГ/0,25МГ)/1МЛ ФЛ. 15 МЛ №1) GSK CONSUMER HEALTHCARE S.A.-ШВЕЙЦАРИЯ', 0),
(28, 'ЭНТЕРОСГЕЛЬ', 10, 14, 49.59, '1', '1', 'Россия', 'ЭНТЕРОСГЕЛЬ (ПАСТА Д/ПРИЕМА ВНУТРЬ В ТУБАХ 225Г №1) ТНК СИЛМА ООО-РОССИЯ', 0),
(29, 'НАСОБЕК', 10, 11, 17.95, '1', '50мкг', 'Чешская Республика', 'НАСОБЕК (СПРЕЙ НАЗАЛЬНЫЙ ДОЗИРОВАННЫЙ 50 МКГ/ДОЗА 200 ДОЗ №1) TEVA CZECH INDUSTRIES S.R.O.-ЧЕШСКАЯ РЕСПУБЛИКА', 0),
(30, 'ГИДРОКОРТИЗОН', 10, 16, 9.49, '1', '0,5%', 'Польша', 'ГИДРОКОРТИЗОН (МАЗЬ ГЛАЗН. 0,5% ТУБА 3 Г №1) PHARMACEUTICAL WORKS JELFA S.A.-ПОЛЬША', 0),
(31, 'ЛОРДЕС', 10, 1, 15.84, '10х1', '5 мг', 'Турция', 'ЛОРДЕС (ТАБ. П/П ОБ. 5 МГ №10Х1) NOBELFARMA ILAC SANAYII VE TICARET A.S.-ТУРЦИЯ', 0),
(32, 'ЦИТЕАЛ', 4, 10, 22.02, '1', '250мл', 'Франция', 'ЦИТЕАЛ (Р-Р Д/НАРУЖ.ПРИМ. ФЛ. 250 МЛ №1) PIERRE FABRE MEDICAMENT PRODUCTION-ФРАНЦИЯ', 0),
(33, 'СЕПТОЦИД-СИНЕРДЖИ', 4, 10, 11.07, '1', '100мл', 'Беларусь', 'СЕПТОЦИД-СИНЕРДЖИ (РАСТВОР ДЛЯ НАРУЖНОГО ПРИМЕНЕНИЯ В БУТЫЛКАХ 1000 МЛ №1) БЕЛАСЕПТИКА ЗАО-БЕЛАРУСЬ', 0),
(34, 'LAVAN', 4, 11, 5.5, '1', '50мл', 'Беларусь', 'LAVAN СПРЕЙ ДЛЯ РУК ОЧИЩАЮЩИЙ С АНТИБАКТЕРИАЛЬНЫМ ЭФФЕКТОМ 50 МЛ', 0),
(35, 'АНГИСЕПТИН', 7, 1, 6.42, '6х2', '1', 'Беларусь', 'АНГИСЕПТИН (ТАБЛ.Д/РАССАС. №6Х2) РУБИКОН ООО-БЕЛАРУСЬ', 0),
(36, 'АРГЕНТОКЕА', 7, 11, 18.33, '1', '25мл', 'Беларусь', 'Спрей для горла, применяемые в комплексном лечении тонзиллитов, ангины, фарингитов (как острых, так и хронических), стоматитов. Аргентокеа Нанолар вишня, благодаря входящей в его состав комбинации уникальных компонентов, обладает следующими свойствами: бактерицидным, противовирусным, противовоспалительным, увлажняющим, защитным, регенерирующим, очищающим, смягчающим и питательным. Препарат можно применять при язвенной болезнижелудка, сахарном диабете, беременности, кормлении грудью.\r\n\r\nАктивные компоненты:\r\n-наноколлоид серебра – мощный антимикробный эффект\r\n-глицерин – смягчает и увлажняет слизитую\r\n-раствор минеральных солей Na, Mg, Ca, K - очищает поверхность миндалин\r\n-масло мяты перечной –  снимает симптомы воспаления, боль, жжение, освежает дыхание.\r\n-экстракт бузины – обеззараживает и успокаивает\r\n\r\nПрименение:\r\nПеред первым использованием следует несколько раз нажать на дозатор, чтобы наполнить его препаратом. Дозатор следует поместить как можно глубже в ротовую полость и, нажимая, распылить в направлении горла 3-4 дозы 2-3 раза в день. В течение одного часа после орошения полости рта следует ограничить употребление жидкости и пищи.\r\n\r\nПротивопоказания:\r\nВозможные реакции гиперчувствительности к какому-либо компоненту. Не применять у пациентов, имеющих аллергию на серебро. Не применять у детей до 2 лет.', 0),
(37, 'ГЕКСАВИТ АЛТАЙВИТ', 6, 1, 2.04, '50', '1г', 'Россия', 'Комплексный поливитаминный препарат, действие которого обусловлено эффектами входящих в его состав витаминов.\r\n\r\nПоказания к применению:\r\n- профилактика и лечение гипо-и авитаминозов\r\n- для улучшения остроты зрения у лиц, работа которых требует повышенного внимания\r\n- для повышения сопротивляемости организма к инфекционным и простудным заболеваниям в период неблагоприятной эпидемической обстановки\r\n- в период восстановления после перенесенных заболеваний и длительной антибиотикотерапии\r\n\r\nСпособ применения и дозы\r\nВнутрь после еды с профилактической целью по 1 драже 1 раз в день; в остальных случаях – взрослым и детям старше 7 лет по 1 драже 3 раза в день; от 6 до 7 лет по 1 драже 2 раза в день. Курс лечения определяется индивидуально, в среднем составляет 1 месяц.', 0),
(38, 'ГЕКСАСПРЕЙ', 7, 2, 17.12, '1', '2,5%', 'Франция', 'ГЕКСАСПРЕЙ (АЭРОЗ. Д/МЕСТНОГО ПРИМ. 2,5% ФЛ. 30 Г №1) LABORATORIES BOUCHARA-RECORDATI-ФРАНЦИЯ', 0),
(39, 'ГРАММИДИН ДЕТСКИЙ', 7, 1, 16.26, '9х2', '1', 'Россия', 'ГРАММИДИН ДЕТСКИЙ (ТАБЛ.Д/РАССАС. №9Х2) ВАЛЕНТА ФАРМАЦЕВТИКА ОАО-РОССИЯ', 0),
(40, 'БИСОПРОЛОЛ', 11, 1, 3.08, '10х3', '5 мг', 'Беларусь', 'БИСОПРОЛОЛ (ТАБЛ.П.О. 5 МГ №10Х3) БОРИСОВСКИЙ ЗАВОД МЕДИЦИНСКИХ ПРЕПАРАТОВ ОАО-БЕЛАРУСЬ', 0),
(41, 'БЛОКОРДИЛ', 11, 1, 3.48, '10х2', '25 мг', 'Словения', 'БЛОКОРДИЛ (ТАБЛ. 25 МГ №10Х2) KRKA, D.D.-СЛОВЕНИЯ', 0),
(42, 'ВАЛЕРИАНА', 11, 1, 3.9, '30', '600 мг', 'Беларусь', 'Рекомендуется для поддержания физиологических функций центральной нервной и сердечно-сосудистой систем, желудочно-кишечного тракта.\r\n\r\nСпособ применения и дозы:\r\nЛицам страше 18 лет, принимать по 1 таблетке три раза в сутки после еды. При необходимости возможен одновременный прием 3-х таблеток. Курс приема - 2 недели. Рекомендуется прием в вечернее время.\r\n\r\nПрименение при беременности и в период лактации:\r\nБАД противопоказан в переиод беремонности и кормления.\r\n\r\nМеры предосторожности:\r\nНе является лекарственным средством. Перед применением рекомендутся проконсультироваться с врачом.\r\n\r\nПротивопоказания:\r\nИндивидуальная непереносимость компонентов.\r\n\r\nСостав:\r\nВитамин С - 90мг, Кислота валереновая 1,8 мг.', 0),
(43, 'ВАЛОДИП', 11, 1, 38.28, '10х3', '10мг/160мг', 'Россия', 'ВАЛОДИП (ТАБ. П/П ОБ. 10МГ/160МГ №10Х3) КРКА-РУС ООО-РОССИЯ', 0),
(44, 'ГИПОТИАЗИД', 11, 1, 9.37, '20х1', '100 мг', 'Венгрия', 'ГИПОТИАЗИД (ТАБЛ. 100 МГ №20Х1) CHINOIN PHARMACEUTICAL AND CHEMICAL WORKS PRIVATE CO. LTD.-ВЕНГРИЯ', 0),
(45, 'ДИАВЕНОН', 11, 6, 10.56, '10х3', '5мг/75мг', 'Польша', 'ДИАВЕНОН (КАПСУЛЫ ТВЕРДЫЕ 5МГ/75МГ №10Х3) PHARMACEUTICAL WORKS POLPHARMA S.A.-ПОЛЬША', 0),
(46, 'ЛАРЕМИД', 12, 1, 7.32, '15х2', '2 мг', 'Польша', 'ЛАРЕМИД (ТАБЛ. 2 МГ №15Х2) PHARMACEUTICAL WORKS POLPHARMA S.A.-ПОЛЬША', 0),
(47, 'НИФУРОКСАЗИД-ЛФ', 12, 6, 4.39, '10х3', '100 мг', 'Беларусь', 'НИФУРОКСАЗИД-ЛФ (КАПС. 100 МГ №10Х3) ЛЕКФАРМ СООО-БЕЛАРУСЬ', 0),
(48, 'СМЕКТА', 12, 9, 14.54, '10', '3 г', 'Франция', 'СМЕКТА (ПОР. Д/ПРИГ. СУСПЕНЗИИ Д/ВНУТРЕННЕГО ПРИМЕНЕНИЯ (АПЕЛЬСИНОВЫЙ) 3 Г ПАК. №10) BEAUFOUR IPSEN INDUSTRIE-ФРАНЦИЯ\r\nПор. д/приг. суспензии д/внутреннего применения (апельсиновый)', 0),
(49, 'УГОЛЬ АКТИВИРОВАННЫЙ', 12, 1, 0.56, '10', '250 мг', 'Украина', 'УГОЛЬ АКТИВИРОВАННЫЙ (ТАБЛ. 250 МГ №10) ПАО НПЦ БОРЩАГОВСКИЙ ХФЗ-УКРАИНА', 0),
(50, 'РЕННИ', 13, 1, 11.26, '12х2', '80мг/80мг', 'Франция', 'РЕННИ (ТАБЛ. ЖЕВ. С АПЕЛЬСИНОВЫМ ВКУСОМ 680МГ/80МГ №12Х2) BAYER CONSUMER CARE AG, ШВЕЙЦАРИЯ MANUFACTURED BY BAYER SANTE FAMILIALE-ФРАНЦИЯ', 0),
(51, 'РЭНИКЗОН', 13, 1, 4.31, '12х2', '680мг/80мг', 'Беларусь', 'РЭНИКЗОН (ТАБЛ. ЖЕВ. 680МГ/80МГ №12Х2) ЭКЗОН ОАО-БЕЛАРУСЬ', 0),
(52, 'ЛАНСАЗОЛ', 13, 6, 9.74, '10х2', '30 мг', 'Беларусь', 'ЛАНСАЗОЛ (КАПС. 30 МГ №10Х2) БОРИСОВСКИЙ ЗАВОД МЕДИЦИНСКИХ ПРЕПАРАТОВ ОАО-БЕЛАРУСЬ', 0),
(53, 'АНАЛЬГИН', 18, 1, 1.49, '10х2', '500 мг', 'Беларусь', 'АНАЛЬГИН (ТАБЛ. 500 МГ №10Х2) БЕЛМЕДПРЕПАРАТЫ РУП-БЕЛАРУСЬ', 0),
(54, 'НО-ШПА', 18, 1, 9.66, '24х1', '40 мг', 'Венгрия', 'НО-ШПА (ТАБЛ. 40 МГ №24Х1) CHINOIN PHARMACEUTICAL AND CHEMICAL WORKS PRIVATE CO. LTD.-ВЕНГРИЯ', 0),
(55, 'СПАЗМАЛГОН', 18, 10, 11.46, '10х1', '2мл', 'Болгария', 'СПАЗМАЛГОН (Р-Р Д/ИН. АМП. 2 МЛ №10Х1) SOPHARMA PLC-БОЛГАРИЯ', 0),
(56, 'ИБУПРОФЕН', 18, 16, 2.15, '1', '50 мг/г', 'Беларусь', 'ИБУПРОФЕН (МАЗЬ Д/НАРУЖНОГО ПРИМЕНЕНИЯ 50 МГ/Г ТУБА 15 Г №1) БЕЛМЕДПРЕПАРАТЫ РУП-БЕЛАРУСЬ', 0),
(57, 'НАЙЗ ГЕЛЬ', 18, 14, 8.8, '1', '10 мг/1 г', 'Индия', 'НАЙЗ ГЕЛЬ (ГЕЛЬ ДЛЯ НАРУЖНОГО ПРИМЕНЕНИЯ 10 МГ/1 Г ТУБА 20 Г №1) GROUP PHARMACEUTICALS LIMITED-ИНДИЯ', 0),
(58, 'ИБУФЕН', 18, 14, 9.64, '1', '10%', 'Польша', 'ИБУФЕН (ГЕЛЬ ДЛЯ НАРУЖНОГО ПРИМЕНЕНИЯ 10% ТУБА 50 Г №1) MEDANA PHARMA S.A.-ПОЛЬША', 0),
(59, 'ИБУПРОФЕН ДИП', 18, 14, 7.15, '1', '30г', 'Беларусь', 'ИБУПРОФЕН ДИП (ГЕЛЬ ДЛЯ НАРУЖНОГО ПРИМЕНЕНИЯ ТУБА 30 Г №1) ФАРМТЕХНОЛОГИЯ ООО-БЕЛАРУСЬ', 0),
(60, 'ПАРАЦЕТАМОЛ', 14, 1, 0.58, '10х1', '200 мг', 'Беларусь', 'ПАРАЦЕТАМОЛ (ТАБЛ. 200 МГ №10Х1) БОРИСОВСКИЙ ЗАВОД МЕДИЦИНСКИХ ПРЕПАРАТОВ ОАО-БЕЛАРУСЬ', 0),
(61, 'ИБУКЛИН', 14, 1, 7.32, '10х2', '400мг/325мг', 'Беларусь', 'ИБУКЛИН (ТАБ. П/П ОБ. 400МГ/325МГ №10Х2) DR. REDDY`S LABORATORIES LTD, ИНДИЯ УПАКОВАНО ОАО БОРИСОВСКИЙ ЗАВОД МЕДИЦИНСКИХ ПРЕПАРАТОВ-БЕЛАРУСЬ', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `medicine_categories`
--

CREATE TABLE `medicine_categories` (
  `medicine_category_id` int(11) NOT NULL,
  `medicine_category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `medicine_categories`
--

INSERT INTO `medicine_categories` (`medicine_category_id`, `medicine_category_name`) VALUES
(1, 'Антибиотики'),
(2, 'Антикоагулянты'),
(4, 'Антисептики'),
(6, 'Витамины'),
(7, 'Для горла'),
(8, 'Для носа'),
(9, 'Для похудения'),
(10, 'От аллергии'),
(11, 'От высокого давления'),
(12, 'От диареи'),
(13, 'От изжоги'),
(14, 'От простуды и гриппа'),
(15, 'При кашле'),
(16, 'Против глистов'),
(17, 'Снотворные и успокоительные средства'),
(18, 'Обезболивающие');

-- --------------------------------------------------------

--
-- Структура таблицы `medicine_forms`
--

CREATE TABLE `medicine_forms` (
  `medicine_form_id` int(11) NOT NULL,
  `medicine_form_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `medicine_forms`
--

INSERT INTO `medicine_forms` (`medicine_form_id`, `medicine_form_name`) VALUES
(1, 'Таблетки'),
(2, 'Аэрозоль'),
(4, 'Гранулы'),
(5, 'Капли'),
(6, 'Капсулы'),
(7, 'Лиофилизат'),
(8, 'Настойка'),
(9, 'Порошок'),
(10, 'Раствор'),
(11, 'Спрей'),
(13, 'Сироп'),
(14, 'Гель'),
(15, 'Пастилки'),
(16, 'Мазь');

-- --------------------------------------------------------

--
-- Структура таблицы `med_cards`
--

CREATE TABLE `med_cards` (
  `med_card_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `med_cards`
--

INSERT INTO `med_cards` (`med_card_id`, `user_id`, `medicine_id`, `count`) VALUES
(2, 26, 61, 2),
(3, 26, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `courier_salary` float NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `pay_method_id` int(11) NOT NULL,
  `order_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `order_datetime`, `courier_id`, `courier_salary`, `order_status_id`, `user_id`, `user_name`, `user_address`, `user_phone`, `user_comment`, `pay_method_id`, `order_total`) VALUES
(57, '2021-06-07 22:11:29', NULL, 2.04, 1, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 2, 13.58),
(58, '2021-06-07 22:13:16', 9, 0.48, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 3.17),
(59, '2021-06-07 22:57:47', 9, 4.3, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 28.68),
(60, '2021-06-07 22:57:59', 9, 2.67, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 17.77),
(61, '2021-06-07 23:11:05', 9, 6.53, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 43.55),
(62, '2021-06-07 23:35:04', 9, 8, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 53.31),
(63, '2021-06-07 23:38:36', 10, 4.32, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 28.83),
(64, '2021-06-07 23:47:29', 10, 21.09, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', '', 2, 140.61),
(65, '2021-06-07 23:47:58', 10, 16.56, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', '', 1, 110.4),
(66, '2021-06-07 23:48:42', 9, 6.06, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', '', 2, 40.41),
(67, '2021-06-08 00:27:06', 10, 2.83, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 18.87),
(68, '2021-06-08 00:35:53', 10, 1.64, 5, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)88-77-361', 'привет\n', 1, 10.91),
(69, '2021-06-08 00:43:49', 10, 2.83, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', '', 1, 18.87),
(70, '2021-06-08 00:46:19', 10, 1.64, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', 'мрпроп', 2, 10.91),
(71, '2021-06-08 08:40:16', NULL, 311.42, 1, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)88-77-364', 'Быстрее!\n', 2, 2076.16),
(72, '2021-06-08 17:43:08', NULL, 2.83, 1, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', '', 1, 18.87),
(74, '2021-06-09 15:02:26', 10, 1.64, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', 'Ааллаоалавл', 1, 10.91),
(75, '2021-06-10 10:42:47', 10, 6.58, 5, 33, 'Ващилова', 'ул.Диможа дом 32а кв. 5 подъезд 4', '+375 (29)78-62-956', 'Вы должны быть в маске', 2, 43.85),
(77, '2021-06-12 00:04:45', NULL, 2.83, 2, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', 'привет хорошо я поняла что это за час до еды и теряй в весе по версии следствия и суда нет бы поздароваться так как в прошлый раз не было такого лёгкого и очень милого общения с вами думаю что это за час до еды и теряй в весе по версии следствия и суда нет бы поздароваться так как в прошлый раз', 1, 18.87),
(78, '2021-06-14 10:35:28', 9, 14.83, 3, 26, 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '+375 (29)887-73-61', 'Быстрее пожалуйста ааааааа!', 2, 98.87),
(79, '2021-06-14 11:09:39', 10, 1.66, 5, 28, 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '+375 (29)585-60-30', '', 1, 11.07);

-- --------------------------------------------------------

--
-- Структура таблицы `order_content`
--

CREATE TABLE `order_content` (
  `order_content_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `count` int(3) NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `order_content`
--

INSERT INTO `order_content` (`order_content_id`, `order_id`, `medicine_id`, `count`, `sum`) VALUES
(74, 57, 5, 2, 13.58),
(75, 58, 6, 1, 3.17),
(76, 59, 4, 1, 17.77),
(77, 59, 3, 1, 10.91),
(79, 60, 4, 1, 17.77),
(80, 61, 7, 5, 43.55),
(81, 62, 4, 3, 53.31),
(82, 63, 2, 1, 18.87),
(83, 63, 5, 1, 6.79),
(84, 63, 6, 1, 3.17),
(85, 64, 2, 3, 56.61),
(86, 64, 8, 3, 84),
(88, 65, 6, 1, 3.17),
(89, 65, 3, 3, 32.73),
(90, 65, 9, 2, 74.5),
(91, 66, 7, 1, 8.71),
(92, 66, 6, 10, 31.7),
(94, 67, 2, 1, 18.87),
(95, 68, 3, 1, 10.91),
(96, 69, 2, 1, 18.87),
(97, 70, 3, 1, 10.91),
(98, 71, 7, 21, 182.91),
(99, 71, 8, 32, 896),
(100, 71, 9, 15, 558.75),
(101, 71, 13, 50, 438.5),
(105, 72, 2, 1, 18.87),
(107, 74, 3, 1, 10.91),
(108, 75, 13, 5, 43.85),
(110, 77, 2, 1, 18.87),
(111, 78, 5, 2, 13.58),
(112, 78, 15, 3, 52.08),
(113, 78, 33, 3, 33.21),
(114, 79, 33, 1, 11.07);

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE `order_statuses` (
  `order_status_id` int(11) NOT NULL,
  `order_status_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `order_statuses`
--

INSERT INTO `order_statuses` (`order_status_id`, `order_status_name`) VALUES
(1, 'Отменен'),
(2, 'В обработке'),
(3, 'Принят'),
(4, 'Доставляется'),
(5, 'Доставлен');

-- --------------------------------------------------------

--
-- Структура таблицы `pay_methods`
--

CREATE TABLE `pay_methods` (
  `pay_method_id` int(11) NOT NULL,
  `pay_method_name` varchar(10) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `pay_methods`
--

INSERT INTO `pay_methods` (`pay_method_id`, `pay_method_name`) VALUES
(1, 'Наличными'),
(2, 'Картой');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(20) CHARACTER SET utf32 NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf32 NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `med_card_number` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_phone`, `user_password`, `user_name`, `user_address`, `med_card_number`) VALUES
(26, '+375 (29)887-73-61', '$2y$10$OJv8iUHFtEclUGQ6HP4JFOTKKtVu2caTfqbQulL06vWSxFha9XnRm', 'Глеб', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '2686-8946-2683-5616'),
(27, '+375 (29)884-18-50', '$2y$10$SpItZFFrLTiMZpuNEgvTyOrVjs6KP5oWdaW.Yq5JZRBfXBhk7Tjsq', 'Людмила', 'ул.Гагарина дом 35 кв. 46 подъезд 3', '3297-6865-6468-9261'),
(28, '+375 (29)585-60-30', '$2y$10$RjhG93SCBWhWssuEwTOhxOxiOD/6qUMS3s0cg8NEWpQLP3PX3O/He', 'Роман', 'ул.Лиможа дом 32а кв. 8 подъезд 1', '1302-2002-1302-2002'),
(29, '+375 (29)564-62-12', '$2y$10$awkabKVQH1edK2nSLvUyp.qMH9JNMFWmHCbMHFaHbxRaNzOFklDcq', 'Андрей', 'ул.Лимож дом 48/2 кв. 80 подъезд 2', '1989-7643-4534-3868'),
(30, '+375 (33)474-23-50', '$2y$10$eE4QlB3a1cKRaeK0nx.sB.TbcOA2mZcy.V.xMpDtPz.jSuNq2xd1.', 'Владислав', 'ул.Дзержинского дом 102а кв. 47 подъезд 1', NULL),
(31, '+375 (44)567-68-88', '$2y$10$vjqyaD6EJIx8LyFw9KqaJ.hnEcDDYmNyyN8eee6trWyi82SOPTsK6', 'Антон', 'ул.НаполеонаОрды дом 4 кв. 32 подъезд 1', '3333-3265-6761-2311'),
(32, '+375 (33)585-63-89', '$2y$10$pcmdiGI7MIEp8aSpBwlQDuWqYkBHpD2tvWTVtMXKAqD1amDVooafu', NULL, NULL, NULL),
(33, '+375 (29)786-26-28', '$2y$10$3HqFElMTjFKIDPBM7JpUBOiMVYdQ.s5n60HsduXLYmY5oFAZZ4h3W', NULL, NULL, '1234-1234-1234-1234'),
(34, '+375 (29)286-58-30', '$2y$10$oRSbEZWmtR0nxzUNFnsu4uumZO/3otfnyCXIL5ivOPkKiYDm6Iv06', NULL, NULL, NULL),
(35, '+375 (33)333-33-33', '$2y$10$w1A1/P33uqW7yvRDcsIoiubX4XSZnq2EIFjSOS0iqIWN0J6sBymFq', NULL, NULL, NULL),
(36, '+375 (44)465-21-78', '$2y$10$48IaNGAVHtnnNBJJ9Vc3eOXbieL7oNDpIwgzj5P2nqkwqO3w9tO.2', NULL, NULL, NULL),
(37, '+375 (44)444-44-44', '$2y$10$BP8ip40QMMMybTZXzj8dQefFLPclAVbjVEnBSHwmHQHOp8q4Nri1.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `work_shifts`
--

CREATE TABLE `work_shifts` (
  `work_shift_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `start_work_shift` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `end_work_shift` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `work_shifts`
--

INSERT INTO `work_shifts` (`work_shift_id`, `courier_id`, `start_work_shift`, `end_work_shift`) VALUES
(22, 10, '22:33', '24:33'),
(23, 9, '22:40', '26:40'),
(24, 9, '22:41', '26:41'),
(25, 10, '08:35', '12:35'),
(26, 10, '10:41', '14:41'),
(27, 9, '12:33', '17:33'),
(28, 9, '10:35', '14:35'),
(29, 10, '11:08', '16:08');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Индексы таблицы `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`courier_id`),
  ADD KEY `active_order_id` (`active_order_id`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorit_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Индексы таблицы `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`),
  ADD KEY `medicine_category` (`medicine_category`),
  ADD KEY `medicine_form` (`medicine_form`);

--
-- Индексы таблицы `medicine_categories`
--
ALTER TABLE `medicine_categories`
  ADD PRIMARY KEY (`medicine_category_id`);

--
-- Индексы таблицы `medicine_forms`
--
ALTER TABLE `medicine_forms`
  ADD PRIMARY KEY (`medicine_form_id`);

--
-- Индексы таблицы `med_cards`
--
ALTER TABLE `med_cards`
  ADD PRIMARY KEY (`med_card_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_status_id` (`order_status_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `courier_id` (`courier_id`),
  ADD KEY `pay_method_id` (`pay_method_id`);

--
-- Индексы таблицы `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`order_content_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Индексы таблицы `pay_methods`
--
ALTER TABLE `pay_methods`
  ADD PRIMARY KEY (`pay_method_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_med_card_id` (`med_card_number`);

--
-- Индексы таблицы `work_shifts`
--
ALTER TABLE `work_shifts`
  ADD PRIMARY KEY (`work_shift_id`),
  ADD KEY `courier_id` (`courier_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `basket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT для таблицы `couriers`
--
ALTER TABLE `couriers`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `medicine_categories`
--
ALTER TABLE `medicine_categories`
  MODIFY `medicine_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `medicine_forms`
--
ALTER TABLE `medicine_forms`
  MODIFY `medicine_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `med_cards`
--
ALTER TABLE `med_cards`
  MODIFY `med_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT для таблицы `order_content`
--
ALTER TABLE `order_content`
  MODIFY `order_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pay_methods`
--
ALTER TABLE `pay_methods`
  MODIFY `pay_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `work_shifts`
--
ALTER TABLE `work_shifts`
  MODIFY `work_shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`);

--
-- Ограничения внешнего ключа таблицы `couriers`
--
ALTER TABLE `couriers`
  ADD CONSTRAINT `couriers_ibfk_1` FOREIGN KEY (`active_order_id`) REFERENCES `orders` (`order_id`);

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`);

--
-- Ограничения внешнего ключа таблицы `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`medicine_form`) REFERENCES `medicine_forms` (`medicine_form_id`),
  ADD CONSTRAINT `medicine_ibfk_2` FOREIGN KEY (`medicine_category`) REFERENCES `medicine_categories` (`medicine_category_id`);

--
-- Ограничения внешнего ключа таблицы `med_cards`
--
ALTER TABLE `med_cards`
  ADD CONSTRAINT `med_cards_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`),
  ADD CONSTRAINT `med_cards_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`order_status_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`pay_method_id`) REFERENCES `pay_methods` (`pay_method_id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`courier_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `order_content_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_content_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`);

--
-- Ограничения внешнего ключа таблицы `work_shifts`
--
ALTER TABLE `work_shifts`
  ADD CONSTRAINT `work_shifts_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`courier_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
