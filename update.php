<?
require('php/connect.php');
session_start();

$id = $_GET['update'];
$tovar = $link->query("SELECT * FROM `products` WHERE id = '$id'")->fetch(2);

function updateProduct()
{
    global $link;
    global $id;
    $name = $_POST['name'];
    $firm = $_POST['firm'];
    $price = $_POST['price'];
    $text = $_POST['text'];
    $category = $_POST['category'];

    

    $addsql = $link->prepare("UPDATE `products` SET `name` = '$name', `firm` = '$firm', `price` = '$price',
    `text` = '$text', `category` = '$category' WHERE `id` = '$id'");
    $addsql->execute();

    return $link->lastInsertId();
}

function uploadImage($files)
{
    global $id;
    global $link;
    $i = 0;
    $sql = $link->query("SELECT * FROM `images` WHERE `product_id` = '$id'")->fetchAll();

    
    foreach ($sql as $ss) {
        
        $filename = $files['name'][$i];
        $route = 'img/'.time().$filename;
        move_uploaded_file($files['tmp_name'][$i], 'php/'.$route);

        $a = $link->prepare("UPDATE `images` SET `path` = '$route' WHERE `id` = '{$ss['id']}'");
        $a->execute();
        $i++;

    
    }

}

if (isset($_POST['update'])) {
    
    $product_id = updateProduct();

    $files = $_FILES['img'];

    
    if(($_FILES['img']['name'] != null) AND (count($_FILES['img']['name'] ) != null) ) {
        uploadImage($_FILES['img']);
    }
    echo '<script>document.location.href="catalog.php"</script>';
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

<section class="admin">
    <div class="container">
        <div class="padding-left padding-top">

            <h3 class="title2_admin">Редактирование товара</h3>

            <form method="POST" name="update" enctype="multipart/form-data">
                    <div class="input_item">
                        <label class="profile_text">Название</label>
                        <input type="text" name="name" class="input_profile" value="<?=$tovar['name']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Фирма</label>
                        <input type="text" name="firm" class="input_profile" value="<?=$tovar['firm']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Цена</label>
                        <input type="text" name="price" class="input_profile" value="<?=$tovar['price']; ?>">
                    </div>

                    <div class="input_item">
                        <label class="profile_text">Описание</label>
                        <input type="text" name="text" class="input_profile" value="<?=$tovar['text']; ?>">
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
                    <input type="submit" class="button_profile" value="Обновить" name="update">
                    </div>
            </form>
        </div>   
    </div>
</section>

<? include 'php/footer.php';  ?>
</body>
</html>