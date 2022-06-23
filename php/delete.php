<? 
    require('connect.php');
    session_start();


    if(isset($_GET['del'])) {
        $del = $_GET['del'];
        $deletesql = $link->prepare("DELETE FROM `products` WHERE `id` = '$del' ");
        $deletesql->execute();
        echo '<script>document.location.href="../catalog.php"</script>';
    }

?>