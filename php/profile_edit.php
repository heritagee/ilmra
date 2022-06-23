<? 

require('connect.php');
session_start();



if(isset($_POST['avatar'])) {
    // для аватарки
    $filename = $_FILES['file']['name'];
    $route = 'img/'.$filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $route);

    // id пользователя
    $avatar_id = $_SESSION['user']['id'];
    // аватарка
    $profile_add = $link->prepare("UPDATE `users` SET `file`= '$route' WHERE `id` = '$avatar_id'");
    $profile_add->execute();

    header("Location: ../profile.php");

}


?>