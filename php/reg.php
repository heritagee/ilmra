<?php
require('connect.php');
session_start();



if (isset($_POST['reg'])) {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_pass = $_POST['re_pass'];


    if (empty($first_name)) {
        $_SESSION['errors'] .= '<div class="er_mes">Вы не ввели значение в поле с именем</div><br>';
    }

    if (empty($email)) {
        $_SESSION['errors'] .= '<div class="er_mes">Вы не ввели значение в поле с email</div><br>';
    }

    if (empty($password)) {
        $_SESSION['errors'] .= '<div class="er_mes">Вы не ввели значение в поле с паролем</div><br>';
    }

    if (empty($re_pass)) {
        $_SESSION['errors'] .= '<div class="er_mes">Вы не ввели значение в поле с подтверждением пароля</div><br>';
    }

    if ($password != $re_pass) {
        $_SESSION['errors'] .= '<div class="er_mes">Пароли не совпадают</div><br>';
    }

    if (strlen($password) < 5) {
        $_SESSION['errors'] .= '<div class="er_mes">Длина пароля должна быть больше 5 символов</div><br>';
    }

    if (!preg_match("/[0-9a-z]+@[a-z]/", $email)) {
        echo "Формат ввода email не верен!";
    }

    $emails = $link->query("SELECT `email` FROM `users` WHERE `email`='".$email."'")->fetch(2);
    if (!empty($emails['email'])){
        $_SESSION['errors'] .= '<div class="er_mes">Такая почта уже есть</div><br>';
    }
 
    if (empty($_SESSION['errors'])) {
        $hashPass = md5($password);
        $regsql=$link->prepare("INSERT INTO `users`(`first_name`, `password`, `email`) VALUES ('$first_name','$hashPass','$email')");
        $regsql->execute();
        echo '<script>document.location.href="../profile.php"</script>';
    }
    else {
        echo '<script>document.location.href="../register.php"</script>';
    }


}
?>