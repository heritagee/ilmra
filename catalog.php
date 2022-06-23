<? 

    require('php/connect.php');
    session_start();

// вывод всех товаров
    $products = $link->query("SELECT * FROM `products`")->fetchAll();

// фильтр, проверка на тип
   if(isset($_GET['type'])) {

       if($_GET['type'] == 'Верхняя одежда') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Верхняя одежда'")->fetchAll();
       }
       if($_GET['type'] == 'Футболки') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Футболки'")->fetchAll();
       }
       if($_GET['type'] == 'Нижнее белье') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Нижнее белье'")->fetchAll();
       }
       if($_GET['type'] == 'Топы') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Топы'")->fetchAll();
       }
       if($_GET['type'] == 'Низ') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Низ'")->fetchAll();
       }
       if($_GET['type'] == 'Головные уборы') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Головные уборы'")->fetchAll();
       }
       if($_GET['type'] == 'Обувь') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Обувь'")->fetchAll();
       }
       if($_GET['type'] == 'Акссесуары') {
        $products = $link->query("SELECT * FROM `products` WHERE `category` = 'Акссесуары'")->fetchAll();
       }

   }



// функция для показа фотографии
    function getProductImage($product_id){
        global $link;
    
        return $link->query("SELECT `path` FROM `images` WHERE `product_id` = {$product_id}")->fetch(PDO::FETCH_ASSOC)['path'];
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILMRA</title>
    <script src="assets/js/burger.js" defer></script> <!-- Подключение JS for burger -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Подключение CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Подключение шрифтов -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Подключение шрифтов -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Подключение шрифтов -->
</head>
<body>
<? include 'php/header.php';  ?>
    <!-- header x2 -->
    <section class="menu">
        <div class="container">
            <div class="header_menu">
                <nav>
                    <ul>
                        <li><a href="catalog.php" class="header_text">ВСЕ</a></li>
                        <li><a href="catalog.php?type=Верхняя одежда" class="header_text">ВЕРХНЯЯ ОДЕЖДА</a></li>
                        <li><a href="catalog.php?type=Футболки" class="header_text">ФУТБОЛКИ</a></li>
                        <li><a href="catalog.php?type=Нижнее белье" class="header_text">НИЖНЕЕ БЕЛЬЕ</a></li>
                        <li><a href="catalog.php?type=Топы" class="header_text">ТОПЫ</a></li>
                        <li><a href="catalog.php?type=Низ" class="header_text">НИЗ</a></li>
                        <li><a href="catalog.php?type=Головные уборы" class="header_text">ГОЛОВНЫЕ УБОРЫ</a></li>
                        <li><a href="catalog.php?type=Обувь" class="header_text">ОБУВЬ</a></li>
                        <li><a href="catalog.php?type=Акссесуары" class="header_text">АКССЕСУАРЫ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
<!-- tovarrrriiiii -->
    <main class="products">
        <!-- product start -->
        <div class="product_items">
            <!-- product *1 -->
            <? foreach($products as $product):  ?>
            <div class="product">
                <img src="php/<?=getProductImage($product['id']) ?>" alt="product" class="product_image">
                <div class="product_hover">
                    <p class="title_product"><?=$product['name']; ?></p>
                    <p class="text_product"><?=$product['firm']; ?></p>
                    <p class="price_product"><?=$product['price']; ?> рублей</p>
                    <a href="product.php?tovarid=<?=$product['id']; ?>" class="btn">Подробнее</a>
                </div>
            </div>
            <? endforeach; ?>
            <!-- product end -->
        </div>
    </main>

    <? include 'php/footer.php';  ?>
</body>
</html>