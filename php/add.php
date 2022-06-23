<?
require('connect.php');
session_start();

function createProduct()
{
    global $link;
    $name = $_POST['name'];
    $firm = $_POST['firm'];
    $price = $_POST['price'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    

    

    $filename = $_FILES['file']['name'];
    $route = 'img/'.$filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $route);

    $addsql = $link->prepare("INSERT INTO `products`(`name`, `firm`, `price`, `text`, `category`)
        VALUES ('$name', '$firm', '$price', '$text', '$category')");
    $addsql->execute();
    

    return $link->lastInsertId();
}

function uploadImage($product_id, $image, $index)
{
    global $link;
    $ext = pathinfo($image['name'][$index], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $ext;

    $path =  'img/' . $filename;

    move_uploaded_file($image['tmp_name'][$index], $path);

    $link->query("INSERT INTO `images` (`path`, `product_id`) VALUES ('{$path}', {$product_id})");
}


if (isset($_POST['add'])) {

    $product_id = createProduct();

    $files = $_FILES['img'];

    for ($index = 0; $index < count($files['name']); $index++) {
        uploadImage($product_id, $files, $index);
    }

    echo '<script>document.location.href="../profile.php"</script>';
}
?>