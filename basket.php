<? 

    require('php/connect.php');
    session_start();
    $id = $_GET['tovarid'];
    if($_SESSION['user']['id']) {
    // join table ВЫВОД ТОВАРОВ
    $orders = $link->query("SELECT `orders`.`size`, `products`.*,
    `orders`.`id` AS order_id
    FROM `orders`
    LEFT JOIN `products` ON (`products`.`id`= `orders`.`id_product`)
    LEFT JOIN `users` ON (`users`.`id` = `orders`.`id_user`)
    WHERE `users`.`id`={$_SESSION['user']['id']} AND status = 0")->fetchAll();
}
    // функция для показа фотографии
    function getProductImage($product_id){
        global $link;
        return $link->query("SELECT `path` FROM `images` WHERE `product_id` = '$product_id'")->fetch(PDO::FETCH_ASSOC)['path'];
    }


    // показывает сколько товаров
    $allTovar = $link->query("SELECT COUNT(id) as count FROM `orders` WHERE `id_user` = '{$_SESSION['user']['id']}' AND `status` = 0")->fetch(2);
    if($_SESSION['user']['id']) {
    // общая стоимость 
    $price = $link->query("SELECT SUM(`products`.`price`) AS sum FROM `orders` LEFT JOIN `products` ON (`products`.`id`= `orders`.`id_product`) LEFT JOIN `users` ON (`users`.`id` = `orders`.`id_user`) WHERE `id_user` = {$_SESSION['user']['id']} AND status = 0")->fetch(2)['sum']; 
}
    // user sql
    $usersql = $link->query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'")->fetch(2);
    // добавление заказа 
    if(isset($_POST['add_order'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $indexxx = $_POST['indexxx'];
        $home = $_POST['home'];
        $porch = $_POST['porch'];
        $apartment = $_POST['apartment'];
        $comment = $_POST['comment'];

        $zakazsql = $link->prepare("UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `number` = '$number', 
        `email` = '$email', `street` = '$street', `indexxx` = '$indexxx', `home` = '$home', `porch` = '$porch', `apartment` = '$apartment', `comment` = '$comment' WHERE `id` = '{$_SESSION['user']['id']}' ");
        $zakazsql->execute();



        $product_id = array();
        $product_name = array();
        $basket_select = $link->query("SELECT `products`.`name`,`products`.`id` FROM `orders` 
        LEFT JOIN `products` ON (`products`.`id`= `orders`.`id_product`) 
        WHERE `id_user` = '{$_SESSION['user']['id']}' AND `status` = 0")->fetchAll();

        foreach ($basket_select as $basik) {
            $product_name[] .= $basik['name'];
            $product_id[] .=$basik['id'];
            
        }
        $product_name = implode(', ', $product_name);
        $product_id = implode(', ', $product_id);

        $ordersql = $link->prepare("INSERT INTO `basket` (`product_name`, `price`, `status`, `user_id`, `product_id`) VALUES ('$product_name', '$price', '1', '{$_SESSION['user']['id']}', '$product_id')");
        $ordersql->execute();

        $delete = $link->exec("DELETE FROM `orders` WHERE `id_user` = '{$_SESSION['user']['id']}' ");
        
            
        echo '<script>document.location.href="profile.php"</script>';

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

    
<!-- korzina -->
    <main class="basket">
        <div class="container_basket">
            <? if($allTovar > 0) { ?>
            <h2 class="title_basket">ТОВАРЫ (<?=$allTovar; ?>)</h2>
            <? } else { ?>
            <h2 class="title_basket">В данный момент ваша корзина пуста.</h2>
            <div class="basket_button"><a href="catalog.php" class="button-white">В каталог</a></div>  
            
            <? } ?>
<!-- card start -->
                <? 
                    if(isset($_GET['delete'])) {
                        $delete = $_GET['delete'];
                        $delsql = $link->prepare("DELETE FROM `orders` WHERE `id` = '$delete' ");
                        $delsql->execute();
                        echo '<script>document.location.href="basket.php"</script>';
                    }
                
                ?>
            <? if($_SESSION['user']['id']): ?>
            <? foreach ($orders as $order): ?>

            <div class="card">

                <div class="card_left">
                    <img src="php/<?=getProductImage($order['id']); ?>" alt="jj" class="basket_img">
                </div>
                
                <div class="card_middle">
                    <div class="middle_left">
                        <p class="title_card"><?=$order['name'] ?></p>
                        <p class="text_card">Размер: <?=$order['size']; ?></p>
                        <p class="text_card">Артикул: <?=$order['id']; ?></p>
                    </div>

                    <div class="middle_center">
                        <p class="title_card">ЦЕНА</p>
                        <p class="text_card"><?=$order['price']; ?> Р</p>
                    </div>

                </div>
                
                <div class="card_right">
                    <a href="basket.php?delete=<?=$order['order_id']; ?>">
                    <svg width="50" height="50" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="x_card">
                        <line x1="1.06066" y1="1.93934" x2="101.061" y2="101.939" stroke="white" stroke-width="3"/>
                        <line x1="101.061" y1="4.06066" x2="1.06069" y2="104.061" stroke="white" stroke-width="3"/>
                    </svg></a>                       
                </div>
                
            </div>

            <? endforeach; ?>
            <? endif;?>
        </div>
    </main>
<!-- section oplata -->
                <? if($allTovar > 0): ?>
    <section class="payment">
        <div class="container_basket">

            <div class="payment_items">

                <div class="payment_1">

                    <div>
                        <h2 class="title_payment">ДОСТАВКА</h2>
                        <div class="payment_radio">
                            <div class="payment_center">
                            <input type="radio" class="radio"><label class="text_payment">Курьером</label><br></div>
                            <div class="payment_center">
                            <input type="radio" class="radio"><label class="text_payment">Самовывоз</label></div>
                        </div>
                        
                    </div>

                    <div>
                        <p class="title_payment">ОПЛАТА</p>
                        <div class="payment_radio">
                        <div class="payment_center">
                            <input type="radio" class="radio"><label class="text_payment">Наличными курьеру</label><br>
                        </div>
                        <div class="payment_center">
                            <input type="radio" class="radio"><label class="text_payment">Картой курьеру</label>
                        </div>
                        </div>
                    </div>
                
                    <div>
                        <p class="title_payment">ОПЛАТА</p>
                        <div class="payment_price">
                            <p class="price"><?=$price; ?> Р</p>
                        </div>
                    </div>

                </div>

<!-- dostavka -->
                <div class="payment_2">
                    <p class="title_payment">АДРЕС ДОСТАВКИ</p>

                    <form name="add_order" method="POST">

                        <div class="payment_2_items">
                            <div class="payment_2_item">
                                <input type="text" class="input_basket" placeholder="Имя" name="first_name" value="<?=$usersql['first_name']; ?>">
                                <input type="text" class="input_basket" placeholder="Фамилия" name="last_name" value="<?=$usersql['last_name']; ?>">
                            </div>
                            <div class="payment_2_item">
                                <input type="text" class="input_basket" placeholder="Номер телефона" name="number" value="<?=$usersql['number']; ?>">
                                <input type="text" class="input_basket" placeholder="Электронная почта" name="email" value="<?=$usersql['email']; ?>">
                            </div>
                            <div class="payment_2_item">
                                <input type="text" class="input_basket" placeholder="Улица" name="street" value="<?=$usersql['street']; ?>">
                                <input type="text" class="input_basket" placeholder="Индекс" name="indexxx" value="<?=$usersql['indexxx']; ?>">
                            </div>
                            <div class="payment_2_item">
                                <input type="text" class="input_basket_1" placeholder="Дом" name="home" value="<?=$usersql['home']; ?>">
                                <input type="text" class="input_basket_1" placeholder="Подъезд" name="porch" value="<?=$usersql['porch']; ?>"> 
                                <input type="text" class="input_basket_1" placeholder="Квартира" name="apartament" value="<?=$usersql['apartament']; ?>">
                            </div>
                            <div class="payment_2_item">
                                <textarea class="input_basket_full" placeholder="Комментарий" name="comment"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="payment_button">
                        <input type="submit" class="button" name="add_order" value="Заказать">
                    </div>

                </form>

            </div>

        </div>
    </section>
    <? endif; ?>

    <? include 'php/footer.php';  ?>

</body>
</html>