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
    <title>ILMRA</title>
    <script src="assets/js/burger.js" defer></script> <!-- Подключение JS for burger -->
    <script src="assets/js/swiper.js" defer></script> <!-- Подключение JS for slider -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Подключение CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Подключение шрифтов -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Подключение шрифтов -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Подключение шрифтов -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/> <!-- Подключение slider js -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script> <!-- Подключение slider js -->
    
</head>
<body>

<? include 'php/header_index.php'; ?>



<!-- main section -->
    <main class="main">
       <div class="main_items_one">

           <div class="main_one_left">

                <h2 class="title_bg1">НОВАЯ<br>КОЛЛЕКЦИЯ</h2>
                <img src="assets/img/woman.png" alt="main" class="image_bg1">

           </div>



           <div class="main_one_right">
                <h2 class="title_white">КРОССОВКИ<br>ADIDAS</h2>
                <img src="assets/img/123.png" alt="main" class="image_bg2">
           </div>

       </div>


       <div class="main_items_one">

           <div class="main_two_left">
                <div class="left_padding">
                    <h2 class="title_black">О нас</h2>

                    <p class="text_two_left">
                        ILMRA - это одежда для мужчин и женщин, которые ценят современный, функциональный и продуманный дизайн. 
                        Мы предлагаем заново пересмотреть классику и базовый гардероб. Коллаборация традициооных методов 
                        и новых технологий делает нши коллекции независимыми, стоящими вне времени и трендов.
                    </p>

                    <a href="catalog.php" class="button main">В каталог</a>
                </div>


           </div>

           <img src="assets/img/bg.png" alt="bg" class="bg2">

       </div>
    </main>

    <? include 'php/footer.php';  ?>

    
</body>
</html>