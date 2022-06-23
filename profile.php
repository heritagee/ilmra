<? 

    require('php/connect.php');
    global $link;
    session_start();

    $avatar_id = $_SESSION['user']['id'];
    $avatar = $link->query("SELECT * FROM `users` WHERE `id` = '$avatar_id'")->fetch(2);

    $id = $_GET['tovarid'];
    $tovar = $link->query("SELECT * FROM `products` WHERE id = '$id'")->fetch(2);


    // join table zakaz
    $zakazsql = $link->query("SELECT * FROM `orders` JOIN `users` ON `orders`.`id_user`=`users`.`id` WHERE `id` = '{$_SESSION['user']['id']}' AND status > 0");
    

    if($_SESSION['user']) {
    $orders = $link ->query("SELECT * FROM `basket` WHERE `user_id` = '{$_SESSION['user']['id']}'")->fetchAll();
    

    $admin_order = $link->query("SELECT `users`.*, `basket`.*
    FROM `basket` 
    LEFT JOIN `products` ON (`products`.`id`= `basket`.`product_name`) 
    LEFT JOIN `users` ON (`users`.`id` = `basket`.`user_id`)
    WHERE status > 0 ORDER BY `basket`.`id` DESC LIMIT 10")->fetchAll(2);
}

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


    
<!--    Если авторизирован     -->
    <? if($_SESSION['user']): ?>
        
<section class="session">
    <div class="container">

        <div class="padding-left padding-top">
            <h2 class="title_session">Профиль</h2>

            <div class="session_items">

                <div class="session_ava">
                    <h3 class="title2_session">Аватарка</h3>
                    <img src="php/<?=$avatar['file']; ?>" alt="ava" class="session_avatarka">
                    <div class="example-2">
                        <div class="form-group">

                            <form action="php/profile_edit.php" method="POST" name="avatar" enctype="multipart/form-data">
                            <input type="file" name="file" id="file" class="input-file" required>
                            
                                <label for="file" class="btn btn-tertiary js-labelFile">
                                <span class="js-fileName">Изменить аватарку</span>
                                </label>
                                <input type="submit" name="avatar" class="input_submit" value="Потвердить">
                            </form>

                        </div>
                    </div>
                    
                </div>
                    
                            <? 
                            // удаление заказа
                                if(isset($_GET['del'])) {
                                    $del = $_GET['del'];
                                    $delsql = $link->exec("DELETE FROM `basket` WHERE `id` = '$del'");
                                    echo '<script>document.location.href="profile.php"</script>';
                                }
                            
                            ?>

                    
                <div class="session_requests">
                    <h3 class="title2_session">История заказов</h3>

                    <div class="session_grid">
                        <!-- card start -->
                        <?  foreach ($orders as $zakazik): ?>
                       
                        <div class="session_item">
                            
                            <div class="item_top">
                                <p class="item_title">Номер заказа: <span class="item_span"><?=$zakazik['id']; ?></span></p>
                                <p class="item_title">Статус: <span class="item_span">
                                    <? if($zakazik['status'] == 1) {
                                    echo 'Обработка'; } 
                                    if($zakazik['status'] == 2) {
                                        echo 'Доставлено';
                                    } ?> </span></p>
                            </div>
                            <div class="item_middle">
                                <p class="item_text"><?=$zakazik['product_name']; ?></p>
                            </div>
                            <div class="item_bottom">
                                <p class="item_title">Стоимость: <span class="item_span"><?=$zakazik['price']; ?> Р</span></p>
                                <? if($zakazik['status'] == 1): ?>

                                <a href="profile.php?del=<?=$zakazik['id']; ?>" class="item_delete">Отменить заказ</a> 

                                <? endif; ?>

                                <? if($zakazik['status'] == 2): ?>
                                
                                <? endif; ?>
                            </div>
                           
                        </div>

                        <? endforeach; ?>
                        
                        <!-- card stop -->

                    </div>

                </div>

            </div>
            
        </div>

    </div>
</section>
<!-- АДМИН ПАНЕЛЬ -->
<? if($_SESSION['user']['lvl'] == 2): ?>
<section class="admin">
    <div class="container">
        <div class="padding-left padding-top">
            <div class="admin_items">

                <div class="admin_item">
                    <h2 class="title_admin">Админ-панель</h2>

                        <h3 class="title2_admin">Добавление товара</h3>

                        <form action="php/add.php" method="POST" name="add" enctype="multipart/form-data">
                                <div class="input_item">
                                    <label class="profile_text">Название</label>
                                    <input type="text" name="name" class="input_profile">
                                </div>

                                <div class="input_item">
                                    <label class="profile_text">Фирма</label>
                                    <input type="text" name="firm" class="input_profile">
                                </div>

                                <div class="input_item">
                                    <label class="profile_text">Цена</label>
                                    <input type="text" name="price" class="input_profile">
                                </div>

                                <div class="input_item">
                                    <label class="profile_text">Описание</label>
                                    <input type="text" name="text" class="input_profile">
                                </div>


                                <div class="input_item">
                                    <label class="profile_text">Категория</label>
                                    <select name="category" class="product_select">
                                            <option>Верхняя одежда</option>
                                            <option>Футболки</option>
                                            <option>Нижнее белье</option>
                                            <option>Топы</option>
                                            <option>Низ</option>
                                            <option>Головные уборы</option>
                                            <option>Обувь</option>
                                            <option>Акссесуары</option>
                                    </select>
                                </div>

                                <div class="input_item">
                                    <label class="profile_text">Прикрепите фотографии</label>
                                    <input type="file" name="img[]" required multiple="true" class="input_profile">
                                </div>

                                <div class="input_item">
                                <input type="submit" class="button_profile" value="Добавить" name="add">
                                </div>
                        </form>
                        <? include 'php/add.php'; ?>
                </div>

                <div class="admin_items">

                <div class="admin_item" style="margin-left: 20px;">

                        <h3 class="title2_admin" style="margin-top: 85px;">Добавление размеров</h3>
                        <? $all_products = $link->query("SELECT * FROM `products`"); ?>
                        <form method="POST" name="size">
                        <div class="input_item">
                                    <label class="profile_text">Все товары</label>
                                    <select name="productid" class="product_select">
                                        <? foreach($all_products as $product): ?>
                                            <option value="<?=$product['id'];?>"><?=$product['name']; ?></option>
                                            <? endforeach; ?>
                                    </select>
                                </div>


                                <div class="input_item">
                                    <label class="profile_text">Размер</label>
                                    <select name="size_label" class="product_select">
                                            <option>XS</option>
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                            <option>Единый размер</option>
                                            <option>40</option>
                                            <option>41</option>
                                            <option>42</option>
                                            <option>43</option>
                                    </select>
                                </div>

                                <div class="input_item">
                                    <label class="profile_text">Количество размеров</label>
                                    <input type="text" name="quantity" class="input_profile">
                                </div>


                                <div class="input_item">
                                <input type="submit" class="button_profile" value="Добавить" name="size">
                                </div>
                        </form>
                        <? 
                        
                            if(isset($_POST['size'])) {
                                $size_label = $_POST['size_label'];
                                $quantity = $_POST['quantity'];
                                $productid = $_POST['productid'];

                                $adsql = $link->prepare("INSERT INTO `size`(`size_label`, `quantity`, `product_id`)
                                    VALUES ('$size_label', '$quantity', '$productid')");
                                $adsql->execute(); 
                                echo '<script>document.location.href="profile.php"</script>';
                            }
                        
                        ?>
                </div>

                
                
            </div>

            
            
        </div>   


        <div class="admin_item" style="margin: 50px 0;">
                    <h3 class="title2_admin">Последние заказы</h3>
                    <div class="admin_table">
                    <? 
                    // изменить статус на доставлено 
                    if(isset($_GET['up'])) {
                        $up = $_GET['up'];
                        $ordersql=$link->prepare("UPDATE `basket` SET `status` = 2 WHERE `id` = '$up'");
                        $ordersql->execute();
                        echo '<script>document.location.href="profile.php"</script>';
                    }
                    ?>  
                    <table>
                    <tr>
                        <th>Номер заказа</th>
                        <th>Имя</th>
                        <th>Наименование</th>
                        <th>Стоимость</th>
                        <th>Номер телефона</th>
                        <th>Комментарий</th>
                        <th>Улица</th>
                        <th>Дом</th>
                        <th>Подъезд</th>
                        <th>Квартира</th>
                        <th>Статус</th>
                        <th>Статус на доставлено</th>
                        <th>Удаление заказа</th> 
                    </tr>
                    <? foreach($admin_order as $admin): ?>
                    <tr>
                        <td><?=$admin['id']; ?></td>
                        <td><?=$admin['first_name']; ?></td>
                        <td><?=$admin['product_name']; ?></td>
                        <td><?=$admin['price']; ?> Р</td>
                        <td><?=$admin['number']; ?> </td>
                        <td><?=$admin['comment']; ?> </td>
                        <td><?=$admin['street']; ?> </td>
                        <td><?=$admin['home']; ?> </td>
                        <td><?=$admin['porch']; ?> </td>
                        <td><?=$admin['apartment']; ?> </td>
                        <td><? if($admin['status'] == 1) {
                                    echo 'В пути'; } 
                                    if($admin['status'] == 2) {
                                        echo 'Доставлено';
                                    } ?></td>

                        <td><a href="profile.php?up=<?=$admin['id']; ?>" class="admin_button">Изменить</a></td>
                        <td><a href="profile.php?del=<?=$admin['id']; ?>" class="admin_button">Удалить</a></td>
                    </tr>
                    <? endforeach; ?>
                    </table>

                    </div>
                </div>
    </div>
</section>
<? endif; ?>

        <!--    Если не авторизирован     -->
    <? endif; ?>
    <? if(!$_SESSION['user']): ?>
        <section class="profile_login">
        <div class="profile_items">

            <img src="assets/img/loginbackground.png" alt="back" class="background_img">

            <div class="profile_item">
                <h3 class="title_profile">Авторизация</h3>

                <form class="form_profile" name="auth" method="POST" action="php/auth.php">

                    <div class="input_item">
                        <label class="profile_text">Email</label>
                        <input type="text" name="email" class="input_profile">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Пароль</label>
                        <input type="password" name="password" class="input_profile">
                    </div>

                    

                    <div class="input_item">
                        <input type="submit" class="button_profile" value="Войти в аккаунт" name="auth">

                        <?=$_SESSION['errors'];
                        unset($_SESSION['errors']); ?>

                        <a href="register.php" class="href_profile">Нету аккаунта? Зарегистрируйтесь</a>
                    </div>
                </form>

                <? require('php/auth.php'); ?>


            </div>

        </div>
        <? endif; ?>







    
    </section>



    <? include 'php/footer.php';  ?>

</body>
</html>