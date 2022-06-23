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
</head>
<body>
    <? include 'php/header.php'; ?>

    <section class="profile_login">

            <div class="profile_items">
                <img src="assets/img/loginbackground.png" alt="back" class="background_img">
                <div class="profile_item">
                    
                    
                    <form class="form_profile" method="POST" name="reg" action="php/reg.php" enctype="multipart/form-data">
                        <h1 class="title_profile">Регистрация</h1>
                        <div class="input_item">
                            <label class="profile_text">Имя</label>
                            <input type="text" name="first_name" class="input_profile">
                        </div>
                        <div class="input_item">
                            <label class="profile_text">Email</label>
                            <input type="text" name="email" class="input_profile">
                        </div>
                        <div class="input_item">
                            <label class="profile_text">Пароль</label>
                            <input type="password" name="password" class="input_profile">
                        </div>
                        <div class="input_item">
                            <label class="profile_text">Повторите пароль</label>
                            <input type="password" name="re_pass" class="input_profile">
                        </div>
                        <div>
                            <div class="payment_center">
                            <input type="radio" class="radio"><label class="text_payment" style="max-width: 300px;">Согласен на обработку персональных данных</label><br></div>
                        </div>

                        <div class="input_item">
                            <input name="reg" type="submit" class="button_profile" value="Зарегистрироваться">
                            <?=$_SESSION['errors']; 
                            unset($_SESSION['errors']); ?>
                            <a href="profile.php" class="href_profile">Есть аккаунт? Войти</a>
                        </div>  
                    </form>
                    <? require('php/reg.php'); ?>

                </div>


                    
                

            </div>

    </section>



    <? include 'php/footer.php';  ?>

</body>
</html>