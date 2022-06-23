<?
require('connect.php');
global $link;
session_start();


if (isset($_POST['auth'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // проверка на пустоту
    if (empty($email)) {
        $_SESSION['errors'] .= '<div class="er_mes">Вы не ввели email</div><br>';
        echo '<script>document.location.href="../profile.php"</script>';
    }
    if (empty($password)) {
        $_SESSION['errors'] .= '<div class="er_mes">Вы не ввели пароль</div><br>';
        echo '<script>document.location.href="../profile.php"</script>';
    }


    $auth = $link->query("SELECT * FROM `users` WHERE `email` = '$email'")->fetch(2);

    if (empty($_SESSION['errors'])) {
        if (!empty($auth)) {
            $_SESSION['errors'] .= '<div class="er_mes">Пользователь не найден</div><br>';
            echo '<script>document.location.href="../profile.php"</script>';
            if (md5($password) == $auth['password']) {
                $user = $auth;
                $_SESSION['user'] = $user;
                echo '<script>document.location.href="../profile.php"</script>';
            } else {
                echo '<script>document.location.href="../profile.php"</script>';
                $_SESSION['errors'] .= '<div class="er_mes">Неверный пароль</div><br>';
            }

        }
    }
}
?>