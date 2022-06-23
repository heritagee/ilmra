<?
require('php/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILMRA - Профиль</title>
    <script src="assets/js/burger.js" defer></script> <!-- Подключение JS for burger -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Подключение CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Подключение шрифтов -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Подключение шрифтов -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Подключение шрифтов -->
    <script src="assets/js/file.js" defer></script>
</head>
<body>
<? include 'php/header.php';  ?>

<section class="admin">
    <div class="container">
        <div class="admin_footer padding-left padding-top">

            <div><h3 class="admin_footer_title">О нас</h3>

                <p class="admin_footer_text">
                ILMRA - это одежда для мужчин и женщин, которые ценят современный, функциональный и продуманный дизайн. 
                Мы предлагаем заново пересмотреть классику и базовый гардероб. Коллаборация традициооных методов 
                и новых технологий делает нши коллекции независимыми, стоящими вне времени и трендов.
                </p> 

                <p class="admin_footer_text" style="margin-top: 20px;">
                Мы верим в мир, где у вас есть полная свобода быть самим собой, без осуждения. Чтобы поэкспериментировать. 
                Чтобы выразить себя. Быть смелым и воспринимать жизнь как экстраординарные приключения, которыми она является. 
                Поэтому мы заботимся о том, чтобы у каждого был равный шанс открыть для себя все удивительные вещи, на которые он способен, – независимо от того, кто он, 
                откуда родом или как выглядит, чтобы им нравилось руководить. Мы существуем для того, чтобы дать вам уверенность в том, что вы можете быть тем, кем вы хотите быть.
                </p>
            </div>
            <div>
                <h3 class="admin_footer_title">Доставка</h3>
                <p class="admin_footer_text">
                Доставка длиться от 3 до 14 дней, в зависимости от вашего местонахождения. Доставка проводится по всем странам СНГ.
                </p>
            </div>
            <div>
                <h3 class="admin_footer_title">Отзыв</h3>
                <p class="admin_footer_text">
                Чтобы оставить отзыв, вам нужно заказать товар и дождаться, чтобы он доехал до вас, после статус заказа станет "Доставлен". После этого, вам нужно перейти на товар и снизу появится форма для составления отзыва.
                </p> 
            </div>
                
                
                
                

        </div> 
    </div>
</section>

<? include 'php/footer.php';  ?>
</body>
</html>