<?
require('php/connect.php');
session_start();

$id = $_GET['id'];

if (isset($_POST['update'])) { 

    $review_text = $_POST['review_text'];
    $height = $_POST['height'];
    $thigh = $_POST['thigh'];
    $waist = $_POST['waist'];
    $heft = $_POST['heft'];

    if(empty($review_text)) {
        $_SESSION['errors'] .= 'Вы не написали отзыв';
    }

    if(empty($_SESSION['errors'])) {

        $reviewsql = $link->prepare("INSERT INTO `reviews`(`review_text`, `id_product`, `id_user`) VALUES ('$review_text', '$id', '{$_SESSION['user']['id']}')");
        $reviewsql->execute();

        $zakazsql = $link->prepare("UPDATE `users` SET `height` = '$height', `thigh` = '$thigh', `waist` = '$waist', `heft` = '$heft' WHERE `id` = '{$_SESSION['user']['id']}'");
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
                    <?=$_SESSION['errors'];
                    unset($_SESSION['errors']); ?>
                    <div class="input_item">
                    <input type="submit" class="button_profile" value="Добавить" name="update">
                    </div>
            </form>
        </div>   
    </div>
</section>

<? include 'php/footer.php';  ?>
</body>
</html>