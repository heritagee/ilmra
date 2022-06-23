<? 

    require('php/connect.php');
    session_start();

    $id = $_GET['tovarid'];
    $tovar = $link->query("SELECT * FROM `products` WHERE id = '$id'")->fetch(2);

    function getProductImage($product_id){
        global $link;
        return $link->query("SELECT `path` FROM `images` WHERE `product_id` = {$product_id}")->fetch(PDO::FETCH_ASSOC)['path'];
    }

    function getProductImages($product_id){
        global $link;
        return $link->query("SELECT `path` FROM `images` WHERE `product_id` = {$product_id} ORDER BY `id` DESC LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
    }
    $images = getProductImages($id);




    // добавление в баскет
    if(isset($_POST['order'])) {
        $size = $_POST['size'];
        $user_id = $_SESSION['user']['id'];

        if(empty($size)) {
            $_SESSION['errors'] .= 'Товара нет в наличии';
        }

        if(empty($_SESSION['errors'])) {
        $add_user = $link->prepare("INSERT INTO `orders` (`id_product`, `id_user`, `size`) VALUES ('$id','$user_id', '$size')");
        $add_user->execute();
        echo '<script>document.location.href="basket.php"</script>';
    }
    }

    // размеры
    $sizes=$link->query("SELECT *, `size`.`id` 
    FROM `size` 
    JOIN `products` ON (`products`.`id`= `size`.`product_id`) 
    WHERE `products`.`id` = '$id'")->fetchAll(2);




    if($_SESSION['user']['id']) {
    
    // review
    $null = 0;
    $orders = $link ->query("SELECT * FROM `basket` WHERE `user_id` = '{$_SESSION['user']['id']}' AND `status` = 2")->fetchAll();
    foreach ($orders as $order) {
        $order_ids .= $order['product_id'].', ';
    }
    $reviews_array = explode(', ', $order_ids); 



    $show_review = false;
    if(in_array($id, $reviews_array)) {
        $show_review = true;
    }

    }

    
    // review end

    // join table
    $reviews = $link->query("SELECT *, `reviews`.`id` 
    AS review_id FROM `reviews` JOIN `products` ON (`products`.`id`= `reviews`.`id_product`) JOIN `users` ON (`users`.`id` = `reviews`.`id_user`) WHERE `reviews`.`id_product` = '$id' ")->fetchAll();


if (isset($_POST['update'])) { 

    $review_text = $_POST['review_text'];
    $height = $_POST['height'];
    $thigh = $_POST['thigh'];
    $waist = $_POST['waist'];
    $heft = $_POST['heft'];
    $foot = $_POST['foot'];

    if(empty($review_text)) {
        $_SESSION['errors'] .= 'Вы не написали отзыв';
    }

    if(empty($_SESSION['errors'])) {

        $reviewsql = $link->prepare("INSERT INTO `reviews`(`review_text`, `id_product`, `id_user`) VALUES ('$review_text', '$id', '{$_SESSION['user']['id']}')");
        $reviewsql->execute();

        $zakazsql = $link->prepare("UPDATE `users` SET `height` = '$height', `thigh` = '$thigh', `waist` = '$waist', `heft` = '$heft', `foot` = '$foot' WHERE `id` = '{$_SESSION['user']['id']}'");
        $zakazsql->execute();
        
        header("Location: catalog.php");
    }
}
// user sql
$usersql = $link->query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'")->fetch(2);
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
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> <!-- Подключение слайдера -->
    <script src="assets/js/product_slider.js"></script> <!-- Подключение слайдера -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    /> 
    <!-- Подключения fancyapps фреймворк CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script> <!-- Подключения fancyapps фреймворк JS-->
    
</head>
<body>
<? include 'php/header.php';  ?>


<!-- products -->
    <section class="product_more">
        <div class="container">

            <div class="main_more">

                <div class="main_images">

                        <img data-fancybox="gallery" src="php/<?=getProductImage($id); ?>" alt="products" class="product_img big">

                    <div class="main_images_hehe">
                        <? foreach($images as $image): ?>
                        <img data-fancybox="gallery" src="php/<?=$image['path']; ?>" alt="products" class="product_img small">
                        <? endforeach; ?>
                    </div>

                                    



                </div>

                <div class="main_item">
                    <!-- title -->
                    <h2 class="product_title"><?=$tovar['name']; ?></h2>
                    <!-- text -->
                    <p class="product_text"><?=$tovar['text']; ?></p>
                    <!-- article -->
                    <p class="product_text">Артикул: <?=$tovar['id']; ?></p>
                    <!-- sostav -->
                    <p class="product_text">Состав: <?=$tovar['compoud']; ?></p>
                    <!-- price -->
                    <p class="product_price"><?=$tovar['price']; ?> ₽</p>
                    <!-- select -->
                    <form action="#" class="product_select" method="POST" name="order">
                            <label class="product_label">Выберите размер:</label><br>
                            
                            <select class="product_select" name="size">
                            <? foreach ($sizes as $size): ?>
                                <? if($size['quantity'] <= 0) continue; ?>
                                <option><?=$size['size_label']; ?></option>
                            <? endforeach; ?>
                            </select>

                            <div class="product_btn">
                            <? if($_SESSION['user']): ?>
                                <input type="submit" name="order" class="button" value="В корзину">
                            <? endif; ?>
                            <? if(!$_SESSION['user']): ?>
                                <a href="profile.php" class="button">В корзину</a>
                            <? endif; ?>
                            </div>
                            <?=$_SESSION['errors'];
                            unset($_SESSION['errors']); ?>
                    </form>


                   
                    
                    
                    <? if($_SESSION['user']['lvl'] == 2): ?>
                    <div class="admin_btn">
                    <p class="product_title">Админ панель</p>
                        <a href="update.php?update=<?=$id;?>" class="btn_update">Редактировать товар</a>
                        <a href="php/delete.php?del=<?=$id;?>" class="btn_delete">Удалить товар</a>
                    </div>
                    <? endif; ?>
                </div>

            </div>

            
            
            <? $allTovar = $link->query("SELECT COUNT(id) as count FROM `reviews` WHERE `id_product` = $id")->fetch(2)['count']; ?>
            <div class="reviews">
                <? if($allTovar == 0) { ?>
                <h2 class="product_title">Отзывов на этот товар нет</h2>
                <? } else { ?>
                <h2 class="product_title">Отзывы (<?=$allTovar; ?>)</h2>

                <!-- card start -->
                    <? 
                    // удаление отзыва
                        if(isset($_GET['delete'])) {
                            $delete = $_GET['delete'];
                            $deletesql = $link->prepare("DELETE FROM `reviews` WHERE `id` = '$delete'");
                            $deletesql->execute();
                            echo '<script>document.location.href="product.php?tovarid='.$id.'"</script>';
                        }
                    
                    ?>

                <? foreach ($reviews as $review): 
                    $date = date("d M Y", strtotime($review['date']));
                    ?>
                <div class="review_block">
                    <div class="review_top">
                        <img src="php/<?=$review['file']; ?>" alt="ava" class="review_ava">

                        <div class="review_pri">
                            <div class="review_top_text">
                            
                            <p class="review_title"><?=$review['first_name']; ?></p>
                            <p class="text"><?=$review['review_text']; ?></p>

                            </div>

                            <div class="review_top_right">
                            <? if($_SESSION['user']['lvl'] == 2): ?>

                            <a href="product.php?tovarid=<?=$id;?>&delete=<?=$review['review_id']; ?>">
                            <svg width="30" height="30" viewBox="0 0 103 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="1.06066" y1="1.93934" x2="101.061" y2="101.939" stroke="black" stroke-width="3"/>
                            <line x1="101.061" y1="4.06066" x2="1.06069" y2="104.061" stroke="black" stroke-width="3"/>
                            </svg>

                            </a>

                            <? endif; ?>
                            </div>
                        </div>

                        

                    </div>

                    <div class="review_bottom">

                        <div class="inline">
                            <p class="review_text">Размер: M</p>
                            <p class="review_text">Рост: <?=$review['height']; ?></p>
                            <p class="review_text">Бедра: <?=$review['thigh']; ?></p>
                            <p class="review_text">Талия: <?=$review['waist']; ?></p>
                            <p class="review_text">Вес: <?=$review['heft']; ?></p>
                            <p class="review_text">Размер ноги: <?=$review['foot']; ?></p>
                        </div>
                        <div class="inline_2"><p class="review_text"><?=$date; ?></p></div>

                    </div>
                    <hr>
                </div>
                <? endforeach; ?>

                <!-- card stop -->
                
            </div>

        </div><? } ?>
        </section>







        <? $review_pokaz = $link->query("SELECT * FROM `reviews` WHERE `id_user` = '{$_SESSION['user']['id']}' AND `id_product` = '$id'")->fetch(2); ?>
        <? if($show_review == true): ?>
            
        <? if($review_pokaz == 0): ?>  
        <section class="admin">
    <div class="container">
        <div class="padding-left padding-top">

            <h3 class="title2_admin">Добавление отзыва</h3>

            <form method="POST" name="update">
                    <div class="input_item">
                        <textarea class="input_basket_full" name="review_text"></textarea>
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Рост</label>
                        <input type="text" name="height" class="input_profile" value="<?=$usersql['height']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Бедра</label>
                        <input type="text" name="thigh" class="input_profile" value="<?=$usersql['thigh']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Талия</label>
                        <input type="text" name="waist" class="input_profile" value="<?=$usersql['waist']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Вес</label>
                        <input type="text" name="heft" class="input_profile" value="<?=$usersql['heft']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Размер ноги</label>
                        <input type="text" name="foot" class="input_profile" value="<?=$usersql['foot']; ?>">
                    </div>
                    <?=$_SESSION['errors'];
                    unset($_SESSION['errors']); ?>
                    <div class="input_item">
                    <input type="submit" class="button_profile" value="Добавить" name="update">
                    </div>
            </form>
        </div>   
    </div>
</section>
<? endif; ?>  
<? endif; ?>  
      

        <? include 'php/footer.php';  ?>
     
    
</body>
</html>