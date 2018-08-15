-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 20 2018 г., 18:16
-- Версия сервера: 5.7.19-17-beget-5.7.19-17-1-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rustvkzk_kafe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advert`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `advert`;
CREATE TABLE `advert` (
  `advert_id` int(11) NOT NULL,
  `text` varchar(500) DEFAULT NULL,
  `public` int(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `advert`
--

INSERT INTO `advert` (`advert_id`, `text`, `public`, `updated_at`) VALUES
(1, '<p>Уважаемые гости, в связи с банкетом 12.01.2017 кафе &ldquo;Экспресс&rdquo; будет закрыто до 21.00 часов.</p>\r\n', 0, '2017-04-13 11:12:13');

-- --------------------------------------------------------

--
-- Структура таблицы `album`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no-image.jpg',
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `public` int(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `album`
--

INSERT INTO `album` (`id`, `image`, `name`, `description`, `meta_key`, `public`, `updated_at`) VALUES
(1, 'DSC_0077.jpg', 'Оформление зала', 'В данном фотоальбоме вы можете ознакомиться с примерами оформления зала кафе \"Экспресс\"', '', 1, '2017-04-13 10:11:25'),
(3, 'DSC_0058.jpg', '6 января 2017 г.', 'Оформление банкета в красном цвете', '', 1, '2017-04-12 21:05:07'),
(5, 'DSC_0845.jpg', '1 июля 2016 г.', 'Оформление банкета в синем цвете', '', 1, '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `public` tinyint(1) DEFAULT '1',
  `order_num` int(3) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'no-image.jpg',
  `back_image` varchar(255) DEFAULT 'back_image.jpg',
  `public_in_menu` tinyint(1) DEFAULT '1',
  `public_in_cat` tinyint(1) DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `meta_key`, `parent_id`, `public`, `order_num`, `class`, `image`, `back_image`, `public_in_menu`, `public_in_cat`, `updated_at`) VALUES
(1, 'Первые блюда', 'Горячие супы', 'Супы, первые, блюда, кафе, экспресс', 0, 1, 2, '', 'Pervye_blyuda_1.jpg', 'Pervye_blyuda_1.jpg', 1, 1, '2017-04-13 07:02:03'),
(2, 'Вторые', 'Мясные блюда, гарниры, горячие', '', 0, 1, 3, '', 'Vtorye_2.jpg', 'Vtorye_2.jpg', 1, 1, '2017-04-13 08:33:51'),
(3, 'Закуски', 'Фуршетные блюда', '', 0, 1, 5, '', 'Zakuski_3.jpg', 'Zakuski_3.jpg', 1, 1, '2017-04-13 08:05:48'),
(4, 'Салаты', 'Салаты', '', 0, 1, 6, '', 'Salaty_4.jpg', 'Salaty_4.jpg', 1, 1, '2017-04-12 18:36:16'),
(5, 'Выпечка', NULL, NULL, NULL, 1, 7, '', 'no-image.jpg', 'back_image.jpg', 1, 1, '2017-04-12 18:36:16'),
(6, 'Полуфабрикаты', NULL, NULL, NULL, 1, 8, '', 'no-image.jpg', 'back_image.jpg', 1, 1, '2017-04-12 18:36:16'),
(7, 'Популярные блюда', 'Универсальные блюда, пользующиеся спросом у наших клиентов и подходящие к любому мероприятию', '', 0, 1, 1, 'index', 'no-image.jpg', 'back_image.jpg', 0, 0, '2017-04-13 06:23:00'),
(8, 'Рыбные закуски', 'Закуски из рыбы', '', 3, 1, 9, '', 'Rybnye_zakuski_8.jpg', 'Rybnye_zakuski_8.jpg', 0, 1, '2017-04-12 18:36:16'),
(9, 'Фаст фуд', 'Чикенбургеры, картофель фри, наггетсы', '', 0, 1, 10, '', 'Fast_fud_9.jpg', 'Fast_fud_9.jpg', 1, 1, '2017-04-12 18:36:16'),
(10, 'Десерты', '', '', 0, 1, 11, '', 'Deserty_10.jpg', 'back_image.jpg', 1, 1, '2017-04-12 18:36:16'),
(11, 'Детское меню', 'Детские блюда', '', 0, 1, 12, 'child', 'no-image.jpg', 'back_image.jpg', 0, 0, '2017-04-12 18:36:16'),
(12, 'Гарниры', '', '', 0, 1, 4, '', 'Garniry_12.jpg', 'Garniry_12.jpg', 1, 1, '2017-04-12 18:36:16'),
(13, 'Фрукты', '', 'фрукты, вазы, фруктовые', 0, 1, 10, NULL, 'Frukty_13.jpg', 'Frukty_13.jpg', 1, 1, '2017-04-12 18:36:16');

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `work_hours` varchar(500) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL,
  `adress` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'no-image.jpg',
  `logo` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `requisites` varchar(1000) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`company_id`, `name`, `phone`, `mail`, `work_hours`, `description`, `public`, `adress`, `image`, `logo`, `mobile_phone`, `requisites`, `updated_at`) VALUES
(1, 'Кафе \"Экспресс\"', '8 (35345) 3-18-90', 'mfa-70@mail.ru', '<time itemprop=\"openingHours\" datetime=\"Mo-Su 10:00−16:00\">\r\nПн-Сб: 10.00 - 16.00\r\n<br></time>\r\nПт, Сб: Вечерняя работа по заявкам до 01.00<br>\r\nВс: Выходной', 'Горячие обеды, организация банкетов, заказы на вынос. ', 1, '<span itemprop=\"postalCode\">461150</span><br>\r\n<span itemprop=\"addressRegion\">Оренбургская область</span>,<br>\r\n<span itemprop=\"addressLocality\">Красногвардейский район,<br>с. Плешаново</span>, \r\n<span itemprop=\"streetAddress\">пр.Гагарина 25</span>', '', '', '8 (922) 843-38-21', '<h2>Реквизиты</h2>\r\n\r\n<p>Индивидуальный предприниматель Давлетова Фарида Борисовна.</p>\r\n\r\n<p>Зарегистрирована в налоговом органе 18.02.2013г&nbsp;</p>\r\n\r\n<p>ИНН 563100009734&nbsp;</p>\r\n\r\n<p>Свидетельство серия 56 №002939514&nbsp;</p>\r\n\r\n<p>ОГРН 304564912800017&nbsp;</p>\r\n\r\n<p>Р/С: 40802810805000000023&nbsp;</p>\r\n\r\n<p>К/С: 30101810400000000885&nbsp;</p>\r\n\r\n<p>БИК: 045354885&nbsp;</p>\r\n\r\n<p>Банк: ОАО &laquo;Банк Оренбург&raquo; г. Оренбург&nbsp;</p>\r\n\r\n<p>Адрес регистрации: 461150 Оренбургская область, Красногвардейский район, с.Донское, пр. Гагарина, д.150</p>\r\n', '2017-04-12 19:20:41');

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adress` varchar(500) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `zadiak` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone`, `email`, `adress`, `description`, `start`, `end`, `birthday`, `zadiak`, `updated_at`) VALUES
(1, 'Мамбетов Рустам Валиахметович', '89991302050, 89991052321', 'Mr-15@mail.ru', 'г.Уфа, ул.Батырская 41/4', 'Классный чувак, сделал эту систему, мощно, огненно, бомбически..  красава', '2016-01-01', '2017-06-03', '1993-03-16', 'Рыба', '2017-04-12 21:05:07'),
(2, 'Мамбетов Раян Валиахметович', '89964011770', 'beatmama@mail.ru', 'Оренбургская область, Красногвардейский район, с.Плешаново, ул.Ленина 91/2', 'Красава, администратор, пьет, спит, ходит вертит девками в зале..', NULL, NULL, '1994-11-05', 'Dog.. snoop dog', '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `public` int(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `image`, `public`, `updated_at`) VALUES
(1, 'Свадьбы', '<p>Среди прочих условий проведения свадеб:&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Свадьбы проводятся с предварительным бронированием и предоплатой</li>\r\n	<li>Ведущие оплачиваются отдельно</li>\r\n</ol>\r\n', NULL, 1, '2017-04-13 10:29:37'),
(2, 'Юбилеи, праздники, встречи', 'Условия проведения банкетов', NULL, 1, '2017-04-12 21:05:07'),
(4, 'Заказы на вынос', 'Условия организации заказа на вынос', NULL, 1, '2017-04-12 21:05:07'),
(5, 'Поминальные обеды', 'Условия проведения', NULL, 1, '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(45, 'Albums/Album1/ef0e0e.jpg', 1, 1, 'Album', 'e5465b8d2a-1', ''),
(47, 'Albums/Album3/5a1e80.jpg', 3, 1, 'Album', '1a14cbefb7-1', ''),
(57, 'Albums/Album5/e552ef.jpg', 5, 1, 'Album', 'a0604d7afc-1', ''),
(58, 'Albums/Album1/6a6b11.jpg', 1, NULL, 'Album', '3fbff1827b-2', ''),
(59, 'Albums/Album3/aadb06.jpg', 3, NULL, 'Album', 'a77cbe742e-2', ''),
(60, 'Albums/Album3/0588e5.jpg', 3, NULL, 'Album', '8929b1452a-3', ''),
(61, 'Albums/Album3/ac7966.jpg', 3, NULL, 'Album', 'aeb4317b02-4', ''),
(62, 'Albums/Album3/053063.jpg', 3, NULL, 'Album', 'ad063fe814-5', ''),
(63, 'Albums/Album3/c33a1c.jpg', 3, NULL, 'Album', 'cbc7e71266-6', ''),
(64, 'Albums/Album5/d2aab2.jpg', 5, NULL, 'Album', '371f33d1b9-2', ''),
(65, 'Albums/Album5/977d25.jpg', 5, NULL, 'Album', 'a8f25c51f4-3', '');

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `updated_at`) VALUES
(1, 'Свежие помидоры', '2017-04-12 21:05:07'),
(2, 'Свежие огурцы', '2017-04-12 21:05:07'),
(3, 'Зелень', '2017-04-12 21:05:07'),
(4, 'Перец сладкий', '2017-04-12 21:05:07'),
(5, 'Сыр \"Фета\"', '2017-04-12 21:05:07'),
(6, 'Маслины', '2017-04-12 21:05:07'),
(7, 'Ветчина', '2017-04-12 21:05:07'),
(8, 'Сыр', '2017-04-12 21:05:07'),
(9, 'Картофель', '2017-04-12 21:05:07'),
(10, 'Лук', '2017-04-12 21:05:07'),
(11, 'Брынза', '2017-04-12 21:05:07'),
(12, 'Говядина', '2017-04-12 21:05:07'),
(13, 'Ананас', '2017-04-12 21:05:07'),
(14, 'Курица', '2017-04-12 21:05:07'),
(15, 'Капуста', '2017-04-12 21:05:07'),
(16, 'Лапша', '2017-04-12 21:05:07'),
(17, 'Грибы', '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `lunch_categories`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `lunch_categories`;
CREATE TABLE `lunch_categories` (
  `id` int(5) NOT NULL,
  `order` int(5) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `public` tinyint(1) DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Обеденные категории';

--
-- Дамп данных таблицы `lunch_categories`
--

INSERT INTO `lunch_categories` (`id`, `order`, `name`, `description`, `public`, `updated_at`) VALUES
(1, 1, 'Первые блюда', 'Горячие супы', 1, '2017-04-13 10:04:44'),
(2, 2, 'Вторые блюда', '', 1, '2017-04-13 10:03:42'),
(3, 3, 'Гарниры', NULL, 1, '2017-04-12 21:05:07'),
(4, 5, 'Выпечка', NULL, 1, '2017-04-12 21:05:07'),
(5, 6, 'Десерты', NULL, 1, '2017-04-12 21:05:07'),
(6, 7, 'Напитки', NULL, 1, '2017-04-12 21:05:07'),
(7, 4, 'Салаты', NULL, 1, '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `lunch_products`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `lunch_products`;
CREATE TABLE `lunch_products` (
  `id` int(11) NOT NULL,
  `lunch_category_id` int(5) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'no-image.jpg',
  `public` tinyint(1) DEFAULT '1',
  `order` int(5) DEFAULT '0',
  `price` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lunch_products`
--

INSERT INTO `lunch_products` (`id`, `lunch_category_id`, `name`, `description`, `image`, `public`, `order`, `price`, `weight`, `updated_at`) VALUES
(8, 1, 'Борщ', '', 'no-image.jpg', 1, 1, '85', '450г/30г', '2017-04-13 11:08:00'),
(9, 1, 'Суп Харчо', '', 'no-image.jpg', 1, 2, '70', '350г/30г', '2017-04-12 21:05:07'),
(10, 1, 'Суп лапша с фрикадельками', '', 'no-image.jpg', 1, 3, '65', '350г/60г', '2017-04-12 21:05:07'),
(11, 1, 'Пельмени', '', 'no-image.jpg', 1, 4, '65', '200г', '2017-04-12 21:05:07'),
(12, 1, 'Пельмени в горшочке с грибами', '', 'no-image.jpg', 1, 5, '75', '200г/30г', '2017-04-12 21:05:07'),
(13, 2, 'Гуляш из говядины', '', 'no-image.jpg', 1, NULL, '100', '250г/100г', '2017-04-12 21:05:07'),
(14, 2, 'Голубцы (2шт)', '', 'no-image.jpg', 1, NULL, '80', '400г/100г', '2017-04-12 21:05:07'),
(15, 2, 'Плов', '', 'no-image.jpg', 0, NULL, '75', '300г/50г', '2017-04-12 21:05:07'),
(16, 2, 'Лагман', '', 'no-image.jpg', 0, NULL, '75', '350г/250г', '2017-04-12 21:05:07'),
(17, 2, 'Шницель из курицы', '', 'no-image.jpg', 1, NULL, '75', '120г', '2017-04-12 21:05:07'),
(18, 2, 'Котлета', '', 'no-image.jpg', 1, NULL, '65', '100г', '2017-04-12 21:05:07'),
(19, 2, 'Манты(3шт)', '', 'no-image.jpg', 1, NULL, '65', '', '2017-04-12 21:05:07'),
(20, 3, 'Картофель \"Гратен\"', '', 'no-image.jpg', 0, NULL, '40', '220г', '2017-04-12 21:05:07'),
(22, 3, 'Картофельное пюре', '', 'no-image.jpg', 1, NULL, '25', '150г', '2017-04-12 21:05:07'),
(23, 3, 'Капуста тушенная', '', 'no-image.jpg', 1, NULL, '25', '150г', '2017-04-12 21:05:07'),
(24, 3, 'Гречка', '', 'no-image.jpg', 1, NULL, '25', '150г', '2017-04-12 21:05:07'),
(25, 3, 'Капуста тушенная', NULL, 'no-image.jpg', 1, 6, '35', '100 г.', '2017-04-12 21:05:07'),
(26, 3, 'Рис с грибами', NULL, 'Ris_s_gribami_26.jpg', 1, 7, '30', '100 г', '2017-04-12 21:05:07'),
(27, 2, 'Корейка на кости', NULL, 'Koreyka_na_kosti_27.jpg', 1, 5, '120', '190 г.', '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1489911240),
('m140622_111540_create_image_table', 1489911248),
('m140622_111545_add_name_to_image_table', 1489911248),
('m160104_073803_create_newsletter_template_table', 1491896868),
('m160104_073815_create_event_template_table', 1491896868),
('m160104_073828_create_event_newsletter_template_table', 1491896868);

-- --------------------------------------------------------

--
-- Структура таблицы `newsletters`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `news_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `newsletters`
--

INSERT INTO `newsletters` (`news_id`, `email`) VALUES
(9, 'lena13th@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(3000) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `summ` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `to_date` datetime DEFAULT NULL,
  `type` enum('Банкет','Заказ','Обед') DEFAULT NULL,
  `new` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `created_at`, `name`, `phone`, `email`, `message`, `qty`, `summ`, `status`, `to_date`, `type`, `new`) VALUES
(1, '2017-04-09 00:00:00', 'Рустам2', '+7 (999) 130-2053', 'mr-15@mail.ru2', '<h1>Заметки по тексту</h1>\r\n\r\n<ol>\r\n	<li>Заказ будет на такое то такое то число2</li>\r\n	<li>Привет как дела2</li>\r\n</ol>\r\n\r\n<p><img alt=\"\" src=\"/web/files/images/events.png\" style=\"height:162px; width:200px\" /><br />\r\n&nbsp;</p>\r\n', '4234', '1111', 0, '2017-04-10 00:00:00', 'Банкет', 0),
(2, '2017-04-11 00:00:00', 'Мамбетов Рустам Валиахметович', '+7 (999) 130-2050', 'mr-15@mail.ru', '', '12', '', NULL, NULL, '', 0),
(5, '2017-04-04 11:53:39', 'Рустам', '+7 (999) 130-2050', '', '', '2', NULL, 0, NULL, NULL, 0),
(8, '2017-04-11 00:00:00', 'Then ', '+7 (111) 114-1111', 'Geek ', 'N', 'C', 'N', 0, '2017-04-08 00:00:00', 'Банкет', 0),
(9, '2017-04-12 10:23:03', 'Рустам', '+7 (999) 130-2050', '', '', '1', NULL, 0, NULL, NULL, 1),
(10, '2017-04-12 17:37:57', 'Азат', '+7 (891) 738-6388', '', '', '4', NULL, 0, NULL, NULL, 1),
(11, '2017-04-13 10:20:05', 'Рустам', '+7 (999) 130-2050', '', '', '2', NULL, 0, NULL, NULL, 1),
(12, '2017-04-13 10:22:46', 'Hecnfv', '+7 (999) 999-9999', '', '', '2', '', NULL, NULL, 'Заказ', 0),
(13, '2017-04-13 10:24:25', 'Рустам', '+7 (999) 999-9999', '', '', '2', NULL, 0, NULL, NULL, 0),
(14, '2017-04-13 13:42:03', 'Раян Мамбетов', '+7 (996) 401-1770', 'Beatmama@mail.ru', 'Хочу', '2', NULL, 0, NULL, NULL, 0),
(15, '2017-04-13 14:48:50', 'Рустам', '+7 (999) 130-2050', '', '', '3', NULL, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `img` varchar(255) DEFAULT 'no-image.jpg',
  `text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `price`, `img`, `text`) VALUES
(1, 10, 7, 'Рыбное филе на подложке', NULL, 'no-image.jpg', NULL),
(2, 10, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(3, 10, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(4, 11, 7, 'Рыбное филе на подложке', NULL, 'no-image.jpg', NULL),
(5, 11, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(6, 11, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(7, 12, 7, 'Рыбное филе на подложке', NULL, 'no-image.jpg', NULL),
(8, 12, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(9, 12, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(10, 12, 31, 'Мороженое', NULL, 'no-image.jpg', NULL),
(11, 12, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(12, 12, 29, 'Картошка фри с наггетсами', NULL, 'no-image.jpg', NULL),
(13, 12, 30, 'Хот-дог', NULL, 'no-image.jpg', NULL),
(14, 13, 7, 'Рыбное филе на подложке', NULL, 'no-image.jpg', NULL),
(15, 13, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(16, 13, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(17, 13, 31, 'Мороженое', NULL, 'no-image.jpg', NULL),
(18, 13, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(19, 13, 29, 'Картошка фри с наггетсами', NULL, 'no-image.jpg', NULL),
(20, 13, 30, 'Хот-дог', NULL, 'no-image.jpg', NULL),
(21, 14, 7, 'Рыбное филе на подложке', NULL, 'no-image.jpg', NULL),
(22, 14, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(23, 14, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(24, 14, 31, 'Мороженое', NULL, 'no-image.jpg', NULL),
(25, 14, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(26, 14, 29, 'Картошка фри с наггетсами', NULL, 'no-image.jpg', NULL),
(27, 14, 30, 'Хот-дог', NULL, 'no-image.jpg', NULL),
(28, 15, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(29, 15, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(30, 16, 1, 'Тарталетки', NULL, 'no-image.jpg', NULL),
(31, 16, 3, 'Омлетный и печеночный рулет', NULL, 'no-image.jpg', NULL),
(32, 16, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(33, 16, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(34, 16, 7, 'Рыбное филе на подложке', NULL, 'no-image.jpg', NULL),
(35, 17, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(36, 17, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(37, 18, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(38, 18, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(39, 18, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(40, 18, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(41, 18, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(42, 19, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(43, 19, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(44, 19, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(45, 19, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(46, 19, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(47, 20, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(48, 20, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(49, 20, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(50, 20, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(51, 20, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(52, 21, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(53, 21, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(54, 21, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(55, 21, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(56, 21, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(57, 22, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(58, 22, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(59, 22, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(60, 22, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(61, 22, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(62, 23, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(63, 23, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(64, 23, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(65, 23, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(66, 23, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(67, 24, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(68, 24, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(69, 24, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(70, 24, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(71, 24, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(72, 25, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(73, 25, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(74, 25, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(75, 25, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(76, 25, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(77, 26, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(78, 26, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(79, 26, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(80, 26, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(81, 26, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(82, 27, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(83, 27, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(84, 27, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(85, 27, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(86, 27, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(87, 28, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(88, 28, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(89, 28, 8, 'Филе рыбное жаренное в кляре', NULL, 'no-image.jpg', NULL),
(90, 28, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(91, 28, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(92, 29, 12, 'Салат \"Греческий\"', NULL, 'no-image.jpg', NULL),
(93, 29, 13, 'Салат \"Пекин\"', NULL, 'no-image.jpg', NULL),
(94, 32, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(95, 33, 31, 'Мороженое', NULL, 'no-image.jpg', NULL),
(96, 34, 38, 'Солянка', NULL, 'no-image.jpg', NULL),
(97, 35, 11, 'Салат \"Охотничий\"', NULL, 'no-image.jpg', NULL),
(98, 35, 12, 'Салат \"Греческий\"', NULL, 'no-image.jpg', NULL),
(99, 36, 11, 'Салат \"Охотничий\"', NULL, 'no-image.jpg', NULL),
(100, 36, 12, 'Салат \"Греческий\"', NULL, 'no-image.jpg', NULL),
(101, 37, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(102, 37, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(103, 38, 24, 'Корейка на кости', NULL, 'no-image.jpg', NULL),
(104, 39, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(105, 39, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(106, 39, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(107, 40, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(108, 40, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(109, 41, 38, 'Солянка', NULL, 'no-image.jpg', NULL),
(110, 42, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(111, 42, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(112, 43, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(113, 43, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(114, 44, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(115, 44, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(116, 44, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(117, 45, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(118, 45, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(119, 46, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(120, 46, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(121, 46, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(122, 47, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(123, 47, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(124, 47, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(125, 48, 4, 'Шашлычки', '100', 'no-image.jpg', NULL),
(126, 48, 5, 'Заливное из курицы', '100', 'no-image.jpg', NULL),
(127, 48, 6, 'Мясная тарелка', '0', 'no-image.jpg', NULL),
(128, 49, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(129, 49, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(130, 50, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(131, 50, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(132, 50, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(133, 51, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(134, 51, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(135, 51, 11, 'Салат \"Охотничий\"', NULL, 'no-image.jpg', NULL),
(136, 51, 12, 'Салат \"Греческий\"', NULL, 'no-image.jpg', NULL),
(137, 51, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(138, 52, 11, 'Салат \"Охотничий\"', NULL, 'no-image.jpg', NULL),
(139, 52, 12, 'Салат \"Греческий\"', NULL, 'no-image.jpg', NULL),
(140, 52, 13, 'Салат \"Пекин\"', NULL, 'no-image.jpg', NULL),
(141, 53, 38, 'Солянка', NULL, 'no-image.jpg', NULL),
(142, 54, 11, 'Салат \"Охотничий\"', NULL, 'no-image.jpg', NULL),
(143, 54, 12, 'Салат \"Греческий\"', NULL, 'no-image.jpg', NULL),
(144, 54, 13, 'Салат \"Пекин\"', NULL, 'no-image.jpg', NULL),
(145, 54, 1, 'Тарталетки', '120', 'no-image.jpg', NULL),
(146, 54, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(147, 54, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(148, 54, 9, 'Рыбное ассорти', NULL, 'no-image.jpg', NULL),
(149, 54, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(150, 54, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(151, 55, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(152, 55, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(153, 55, 16, 'Тарелка \"Овощные маринады\"', NULL, 'no-image.jpg', NULL),
(154, 56, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(155, 56, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(156, 56, 2, 'Блины с начинкой, куриный рулет', '0', 'no-image.jpg', NULL),
(157, 56, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(158, 56, 5, 'Заливное из курицы', '100', 'no-image.jpg', NULL),
(159, 56, 4, 'Шашлычки', '100', 'no-image.jpg', NULL),
(160, 56, 42, 'Мясная тарелка<br>Мясо', '120', 'no-image.jpg', NULL),
(161, 57, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(162, 57, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(163, 57, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(164, 57, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(165, 57, 27, 'Рулет лавашный с шампиньонами', NULL, 'no-image.jpg', NULL),
(166, 58, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(167, 58, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(168, 59, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(169, 59, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(170, 59, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(171, 59, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(172, 60, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(173, 60, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(174, 60, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(175, 60, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(176, 61, 24, 'Корейка на кости', NULL, 'no-image.jpg', NULL),
(177, 62, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(178, 62, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(179, 62, 24, 'Корейка на кости', NULL, 'no-image.jpg', NULL),
(180, 62, 38, 'Солянка', NULL, 'no-image.jpg', 'Привет'),
(181, 63, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(182, 63, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(183, 63, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(184, 64, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(185, 64, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(186, 64, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(187, 63, 9, 'Рыбное ассорти', '170', 'no-image.jpg', NULL),
(188, 63, 7, 'Рыбное филе на подложке', '50', 'no-image.jpg', NULL),
(189, 63, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(190, 63, 4, 'Шашлычки', '100', 'no-image.jpg', NULL),
(191, 63, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(192, 64, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(193, 65, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(194, 66, 3, 'Омлетный и печеночный рулет', '100', 'no-image.jpg', NULL),
(196, 5, 15, 'Салат \"Тбилиси\"', NULL, 'no-image.jpg', NULL),
(197, 5, 28, 'Чикенбургер', NULL, 'no-image.jpg', NULL),
(965, 1, 38, 'Солянка', '120', 'no-image.jpg', 'фыв212123'),
(966, 1, 58, 'Шурпа из говядины', '3333', 'no-image.jpg', 'asdsda'),
(967, 1, 59, 'Суп лапша', '580', 'no-image.jpg', 'Нужно положить очень немного риса'),
(968, 1, 62, 'Пюре с грибной подливой', '123', 'no-image.jpg', 'ыыыы'),
(1152, 8, 2, 'Блины с начинкой, куриный рулет', '493829263', 'no-image.jpg', 'Thurber Kenny c '),
(1153, 8, 25, 'Блинные роллы со шпротами', NULL, 'no-image.jpg', ''),
(1154, 8, 27, 'Рулет лавашный с шампиньонами', NULL, 'no-image.jpg', ''),
(1155, 8, 39, 'Тарталетки, С грибами и курицей', NULL, 'no-image.jpg', ''),
(1156, 8, 41, 'Тарталетки, С ветчиной и сыром', NULL, 'no-image.jpg', ''),
(1157, 8, 60, 'Телятина с грибами', NULL, 'no-image.jpg', ''),
(1158, 8, 31, 'Мороженое', NULL, 'no-image.jpg', ''),
(1159, 8, 59, 'Суп лапша', NULL, 'no-image.jpg', ''),
(1160, 8, 62, 'Пюре с грибной подливой', NULL, 'no-image.jpg', ''),
(1161, 2, 10, 'Сельдь нарезка', '123qweqwe', 'no-image.jpg', 'qwe'),
(1162, 2, 39, 'Тарталетки, С грибами и курицей', '125', 'no-image.jpg', '5 шт'),
(1163, 2, 41, 'Тарталетки, С ветчиной и сыром', '', 'no-image.jpg', ''),
(1164, 2, 24, 'Корейка на кости', '', 'no-image.jpg', ''),
(1165, 2, 38, 'Солянка', '', 'no-image.jpg', ''),
(1166, 2, 58, 'Шурпа из говядины', '', 'no-image.jpg', ''),
(1167, 2, 59, 'Суп лапша', '', 'no-image.jpg', ''),
(1168, 2, 62, 'Пюре с грибной подливой', '', 'no-image.jpg', ''),
(1169, 9, 62, 'Пюре с грибной подливой', NULL, 'no-image.jpg', NULL),
(1170, 10, 6, 'Мясная тарелка', '0', 'no-image.jpg', NULL),
(1171, 10, 16, 'Тарелка \"Овощные маринады\"', NULL, 'no-image.jpg', NULL),
(1172, 10, 39, 'Тарталетки<br>С грибами и курицей', '95', 'no-image.jpg', NULL),
(1173, 10, 41, 'Тарталетки<br>С ветчиной и сыром', '80', 'no-image.jpg', NULL),
(1174, 11, 38, 'Солянка', NULL, 'no-image.jpg', NULL),
(1175, 11, 58, 'Шурпа из говядины', '70', 'no-image.jpg', NULL),
(1176, 12, 38, 'Солянка', NULL, 'no-image.jpg', NULL),
(1177, 12, 58, 'Шурпа из говядины', '70', 'no-image.jpg', NULL),
(1178, 13, 62, 'Пюре с грибной подливой', NULL, 'no-image.jpg', NULL),
(1179, 13, 63, 'Котлета по-киевски', '130', 'no-image.jpg', NULL),
(1180, 14, 24, 'Корейка на кости', NULL, 'no-image.jpg', NULL),
(1181, 14, 61, 'Картофель Фри', '70', 'no-image.jpg', NULL),
(1182, 15, 24, 'Корейка на кости', NULL, 'no-image.jpg', NULL),
(1183, 15, 60, 'Телятина с грибами', '130', 'no-image.jpg', NULL),
(1184, 15, 61, 'Картофель Фри', '70', 'no-image.jpg', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `album_id` varchar(255) DEFAULT NULL,
  `public` int(1) DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `album_id`, `public`, `updated_at`) VALUES
(1, '3', 1, '2017-04-12 21:05:07'),
(2, '3', 1, '2017-04-12 21:05:07'),
(3, '3', 1, '2017-04-12 21:05:07'),
(4, '3', 1, '2017-04-12 21:05:07'),
(5, '3', 1, '2017-04-12 21:05:07'),
(6, '5', 1, '2017-04-12 21:05:07'),
(7, '5', 1, '2017-04-12 21:05:07'),
(8, '5', 1, '2017-04-12 21:05:07'),
(9, '5', 1, '2017-04-12 21:05:07'),
(10, '1', 1, '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `public` tinyint(1) DEFAULT '1',
  `image` varchar(255) DEFAULT 'no-image.jpg',
  `price` int(5) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `popular` tinyint(1) DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `parent_id` int(5) DEFAULT '0',
  `child` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `public`, `image`, `price`, `weight`, `popular`, `meta_key`, `order`, `category_id`, `parent_id`, `child`, `updated_at`) VALUES
(2, 'Блины с начинкой, куриный рулет', 'Запеченный с овощами и сыром рулет, блины с копченной курицей и жаренными грибами', 0, 'no-image.jpg', 0, '', 0, '', 2, 3, 0, 0, '2017-04-12 19:49:33'),
(3, 'Омлетный и печеночный рулет', 'Рулет омлетный с сыром и зеленью, Рулет печеночный с пассерованными овощами и чесноком', 1, 'no-image.jpg', 100, '', 0, '', 3, 3, 0, 0, '2017-04-13 08:23:25'),
(4, 'Шашлычки', 'Шашлычки из свинины и курицы', 1, 'Shashlychki_4.jpg', 100, '', 0, '', 4, 3, 0, 0, '2017-04-12 19:49:33'),
(5, 'Заливное из курицы', '', 1, 'Zalivnoe_iz_kuricy_5.jpg', 100, '', 0, '', 5, 3, 0, 0, '2017-04-12 19:49:33'),
(6, 'Мясная тарелка', 'Крылышки куриный хрустящие, колбаски куриные гриль, люля-кебаб, картофель, лук', 1, 'Myasnaya_tarelka_6.jpg', 0, '', 0, '', 6, 3, 0, 0, '2017-04-12 19:49:33'),
(10, 'Сельдь нарезка', '', 1, 'no-image.jpg', 100, '', 0, '', NULL, 8, 0, 0, '2017-04-12 19:49:33'),
(11, 'Салат \"Охотничий\"', '', 1, 'Salat_Ohotnichiy_11.jpg', NULL, '', 0, '', 6, 4, 0, 0, '2017-04-13 08:31:05'),
(12, 'Салат \"Греческий\"', '', 1, 'Salat_Grecheskiy_12.jpg', NULL, '', 0, '', 2, 4, 0, 0, '2017-04-12 19:49:33'),
(13, 'Салат \"Пекин\"', '', 1, 'Salat_Pekin_13.jpg', NULL, '', 0, '', 8, 4, 0, 0, '2017-04-12 19:49:33'),
(14, 'Салат с печенью трески', '', 1, 'Salat_s_pechenyu_treski_14.jpg', NULL, '', 0, '', 1, 4, 0, 0, '2017-04-12 19:49:33'),
(15, 'Салат \"Тбилиси\"', '', 1, 'Salat_Tbilisi_15.jpg', NULL, '', 1, '', 1, 4, 0, 0, '2017-04-12 19:49:33'),
(16, 'Тарелка \"Овощные маринады\"', '', 1, 'Tarelka_Ovoschnye_marinady_16.jpg', NULL, '', 0, '', 1, 4, 0, 0, '2017-04-12 19:49:33'),
(17, 'Салат \"Парижель\"', '', 1, 'Salat_Parizhel_17.jpg', NULL, '', 0, '', 7, 4, 0, 0, '2017-04-12 19:49:33'),
(18, 'Салат \"Грибной\"', '', 1, 'Salat_Gribnoy_18.jpg', NULL, '', 0, '', 4, 4, 0, 0, '2017-04-12 19:49:33'),
(19, 'Салат \"Питательный\"', '', 1, 'Salat_Pitatelnyy_19.jpg', NULL, '', 0, '', 9, 4, 0, 0, '2017-04-12 19:49:33'),
(20, 'Сельдь под шубой', '', 1, 'Seld_pod_shuboy_20.jpg', NULL, '', 0, '', 1, 4, 0, 0, '2017-04-13 08:31:16'),
(21, 'Овощная нарезка', '', 1, 'Ovoschnaya_narezka_21.jpg', NULL, '', 0, '', NULL, 3, 0, 0, '2017-04-12 19:49:33'),
(22, 'Салат \"Погребок\"', '', 1, 'Salat_Pogrebok_22.jpg', NULL, '', 0, '', -1, 4, 0, 0, '2017-04-12 19:49:33'),
(23, 'Салат \"Максимилиан\"', '', 1, 'Salat_Maksimilian_23.jpg', NULL, '', 0, '', 5, 4, 0, 0, '2017-04-12 19:49:33'),
(24, 'Корейка на кости', '', 1, 'Koreyka_na_kosti_24.jpg', NULL, '', 0, '', NULL, 2, 0, 0, '2017-04-13 08:33:11'),
(25, 'Блинные роллы со шпротами', '', 1, 'Blinnye_rolly_so_shprotami_25.jpg', NULL, '', 0, '', NULL, 3, 0, 0, '2017-04-12 19:49:33'),
(27, 'Рулет лавашный с шампиньонами', NULL, 1, 'no-image.jpg', NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, '2017-04-12 19:49:33'),
(28, 'Чикенбургер', '', 1, 'Chikenburger_28.jpg', NULL, '', 1, '', 1, 9, 0, 0, '2017-04-12 19:49:33'),
(29, 'Картошка фри с наггетсами', '', 1, 'Kartoshka_fri_s_naggetsami_29.jpg', NULL, '', 0, '', 2, 9, 0, 1, '2017-04-12 19:49:33'),
(30, 'Хот-дог', NULL, 1, 'DSC_0693.jpg', NULL, NULL, NULL, NULL, 3, 9, 0, 1, '2017-04-12 19:49:33'),
(31, 'Мороженое', NULL, 1, 'DSC_0644-Edit.jpg', NULL, NULL, NULL, NULL, NULL, 10, 0, 1, '2017-04-12 19:49:33'),
(32, 'Фри с жаренными сосисками', '', 1, 'Fri_s_zharennymi_sosiskami_32.jpg', NULL, '', 0, '', 4, 9, 0, 1, '2017-04-12 19:49:33'),
(33, 'Картошка фри с чикенбургером', '', 1, 'Kartoshka_fri_s_chikenburgerom_33.jpg', NULL, '', 1, '', 5, 9, 0, 0, '2017-04-12 19:49:33'),
(38, 'Солянка', '', 1, 'Solyanka_38.jpg', NULL, '', 0, '', 4, 1, 0, 0, '2017-04-13 07:12:06'),
(39, 'С грибами и курицей', '', 1, 'no-image.jpg', 95, '170 г.', 1, '', NULL, 3, 53, 0, '2017-04-12 19:49:33'),
(41, 'С ветчиной и сыром', NULL, 1, 'no-image.jpg', 80, '150 г.', 1, NULL, NULL, 3, 53, NULL, '2017-04-12 19:49:33'),
(44, 'Новогодние мандарины', 'Фруктовая ваза, выполненная в виде елки из мандаринов', 1, 'Novogodnie_mandariny_44.jpg', 120, '600 г.', 0, 'Мандарины, ёлка, фрукты, новый, год', 6, 13, 0, 0, '2017-04-12 19:49:33'),
(53, 'Тарталетки', 'Тарталетки изготавливаются из запеченного теста и являются отличным вариантом разнообразия закусок к праздничному столу. Мы предлагаем два вида, тарталетки с грибами и курицей и тарталетки с ветчиной и сыром', 1, 'Tartaletki_53.jpg', 120, '150 г.', 1, '', NULL, 3, 0, 1, '2017-04-13 08:02:32'),
(58, 'Шурпа из говядины', 'Шурпа - блюдо пришедшее к нам с востока, но которое прочно укрепилось в нашей кухне', 1, 'Shurpa_iz_govyadiny_58.jpg', 70, '', 0, '', 1, 1, 0, 0, '2017-04-13 07:12:00'),
(59, 'Суп лапша', 'Традиционный суп с наваристым бульоном', 1, 'Sup_lapsha_59.jpg', 60, '', 0, 'Суп, лапша', 2, 1, 0, 0, '2017-04-13 07:12:03'),
(60, 'Телятина с грибами', '', 1, 'Telyatina_s_gribami_60.jpg', 130, '300 г.', 0, '', NULL, 2, 0, 0, '2017-04-12 19:49:33'),
(61, 'Картофель Фри', 'Жаренная картошка соломкой', 1, 'Kartofel_Fri_61.jpg', 70, '160 г.', 0, '', NULL, 2, 0, 0, '2017-04-12 19:49:33'),
(62, 'Пюре с грибной подливой', '', 1, 'Pyure_s_gribnoy_podlivoy_62.jpg', NULL, '', 1, 'пюре, грибы, картофель', NULL, 12, 0, 1, '2017-04-12 19:49:33'),
(63, 'Котлета по-киевски', 'Большое или не очень описание этого блюда', 1, 'Kotleta_po-kievski_63.jpg', 130, '150 г.', 1, 'Котлета, по-киевски', NULL, 2, 0, 1, '2017-04-12 19:49:33'),
(65, '11', NULL, 0, 'no-image.jpg', NULL, '', 0, NULL, NULL, NULL, 64, 0, '2017-04-12 19:49:33');

-- --------------------------------------------------------

--
-- Структура таблицы `product_categories`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(1, 10),
(2, 3),
(3, 3),
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_ingredients`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `product_ingredients`;
CREATE TABLE `product_ingredients` (
  `product_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_ingredients`
--

INSERT INTO `product_ingredients` (`product_id`, `ingredient_id`, `updated_at`) VALUES
(4, 1, '2017-04-12 21:05:07'),
(10, 9, '2017-04-12 21:05:07'),
(10, 14, '2017-04-12 21:05:07'),
(22, 10, '2017-04-12 21:05:07'),
(25, 5, '2017-04-12 21:05:07'),
(39, 3, '2017-04-12 21:05:07'),
(39, 6, '2017-04-12 21:05:07'),
(39, 7, '2017-04-12 21:05:07'),
(39, 9, '2017-04-12 21:05:07'),
(39, 10, '2017-04-12 21:05:07'),
(39, 11, '2017-04-12 21:05:07'),
(39, 12, '2017-04-12 21:05:07'),
(39, 13, '2017-04-12 21:05:07'),
(41, 7, '2017-04-12 21:05:07'),
(41, 8, '2017-04-12 21:05:07'),
(44, 3, '2017-04-12 21:05:07'),
(44, 7, '2017-04-12 21:05:07'),
(44, 9, '2017-04-12 21:05:07'),
(44, 10, '2017-04-12 21:05:07'),
(44, 11, '2017-04-12 21:05:07'),
(44, 12, '2017-04-12 21:05:07'),
(50, 3, '2017-04-12 21:05:07'),
(58, 1, '2017-04-12 21:05:07'),
(58, 3, '2017-04-12 21:05:07'),
(58, 12, '2017-04-12 21:05:07'),
(59, 3, '2017-04-12 21:05:07'),
(60, 3, '2017-04-12 21:05:07'),
(60, 10, '2017-04-12 21:05:07'),
(60, 12, '2017-04-12 21:05:07'),
(62, 9, '2017-04-12 21:05:07'),
(62, 17, '2017-04-12 21:05:07'),
(63, 3, '2017-04-12 21:05:07'),
(63, 5, '2017-04-12 21:05:07'),
(63, 7, '2017-04-12 21:05:07'),
(63, 9, '2017-04-12 21:05:07'),
(63, 10, '2017-04-12 21:05:07'),
(63, 11, '2017-04-12 21:05:07'),
(63, 12, '2017-04-12 21:05:07'),
(63, 13, '2017-04-12 21:05:07'),
(63, 14, '2017-04-12 21:05:07'),
(63, 15, '2017-04-12 21:05:07'),
(63, 17, '2017-04-12 21:05:07'),
(65, 2, '2017-04-12 21:05:07'),
(65, 8, '2017-04-12 21:05:07');

-- --------------------------------------------------------

--
-- Структура таблицы `simple_pages`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `simple_pages`;
CREATE TABLE `simple_pages` (
  `id` int(11) NOT NULL,
  `public` int(1) NOT NULL DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `simple_pages`
--

INSERT INTO `simple_pages` (`id`, `public`, `name`, `content`, `meta_key`, `meta_title`, `meta_description`) VALUES
(1, 1, 'О нас', '<div class=\"wishlist_page_header\">\r\n<h1 style=\"text-align: center;\">Кафе &quot;Экспресс&quot;</h1>\r\n\r\n<p style=\"text-align:center\">О заведении, его работе и его сотрудниках</p>\r\n\r\n<hr /></div>\r\n\r\n<div class=\"about_content col-xs-12\"><img alt=\"\" src=\"/web/files/DSC_0148.jpg\" style=\"float:left; margin-left:20px; margin-right:20px; width:400px\" />\r\n<p>Кафе экспресс открылось в 1999 году и было первым заведением общественного питания в Плешаново. Первое время кафе занимало лишь некотрую часть здания и зал был небольшой. Несколько лет кафе обслуживало только обеды, но в 2005 году, после большой перестройки здания, начали проводиться праздничные мерроприятия.</p>\r\n\r\n<p>&nbsp;</p>\r\n<!--?= Html::img(\"@web/img/DSC_0148.jpg\", [\'alt\' =--></div>\r\n', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `auth_key` varchar(255) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT 'avatar.jpg',
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `rights` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `image`, `role`, `name`, `age`, `phone`, `adress`, `description`, `rights`) VALUES
(1, 'Farida', '$2y$13$ozFNxsEcDCpfe9YZDBfhdeJwdYV91FXAJ.p.Q6IpgIyspjSJsvfiW', 'bRM35kR79HifOo41RtuZogGejo17feiA', 'farida.png', 'Администраотор, директор заведения', 'Давлетова Фарида Борисовна', 47, '89228433821', 'ул. Ленина 91/2', NULL, 'admin'),
(2, 'Rustam', '$2y$13$F3GoAkkgIfBZO14boe0EEu96gZtUS4xD/pTLgm36wiieGuMfU5vvS', '2agpqDoMOWuMmtYIAc_ajjU8Kn8byMkm', 'rustam.png', 'Разработчик системы, Системный администратор', 'Мамбетов Рустам Валиахметович', 23, '89991052321, 89991302050', 'г.Уфа', 'Красавичк', 'system');

-- --------------------------------------------------------

--
-- Структура таблицы `vacancy`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `vacancy`;
CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL,
  `short_description` varchar(255) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `date` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vacancy`
--

INSERT INTO `vacancy` (`id`, `short_description`, `public`, `date`, `name`, `description`, `salary`, `meta_title`, `meta_key`, `meta_desc`, `updated_at`) VALUES
(1, 'В кафе \"Экспресс\" приглашается сотрудник на должность кассир-официант', 1, '', 'Кассир официант', '<p>В кафе &quot;Экспресс&quot; приглашается сотрудник на должность кассир-официант.&nbsp;</p>\r\n', '7 000 - 12 000', '0', '', '', '2017-04-12 21:31:34'),
(3, 'Приглашается сотрудник на должность помощника повара.', 1, '', 'Помощник повара ', '<p>Приглашается сотрудник на должность помощника повара. Требования: женщина в возрасте от 40 до 50 лет. Возможность самостоятельно добираться до работы. Наличие возможности работать ночью.</p>\r\n', '6 000 - 11 000', '0', '0', '0', '2017-04-13 10:59:58'),
(4, 'Груз грузить', 0, '2017-04-20', 'Грузчик', '<p>ффывфывфыв</p>\r\n', '15 000', NULL, 'груз, работа, плешаново, красногвардейский, район, оренбургская, область', 'Требуется грузчик в Кафе Экспресс, село Плешаново, Красногвардейский район', '2017-08-12 18:12:39');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`advert_id`);

--
-- Индексы таблицы `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lunch_categories`
--
ALTER TABLE `lunch_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lunch_products`
--
ALTER TABLE `lunch_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`news_id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_id`,`ingredient_id`);

--
-- Индексы таблицы `simple_pages`
--
ALTER TABLE `simple_pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advert`
--
ALTER TABLE `advert`
  MODIFY `advert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `lunch_categories`
--
ALTER TABLE `lunch_categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `lunch_products`
--
ALTER TABLE `lunch_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1185;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `simple_pages`
--
ALTER TABLE `simple_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
