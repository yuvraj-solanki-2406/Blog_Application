<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'blogs';

$db_connect = mysqli_connect($servername, $username, $password, $database);

// if (!$db_connect) {
//     echo "Database not connected";
// }else{
//     echo "Database connected";
// }

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $title = $_POST['title'];
    $image = $_FILES['blog_image']['name'];
    $published_at = $_POST['published_at'];
    $description = $_POST['description'];

    // Uploading Image
    move_uploaded_file($_FILES["blog_image"]["tmp_name"], "uploads/".$_FILES["blog_image"]["name"]);

    $sql = "INSERT INTO `blogs` (`title`, `image`, `published_at`, `description`) VALUES ('$title', '$image', '$published_at', '$description')";

    $insert = mysqli_query($db_connect, $sql);

    if ($insert) {
        $insert = true;
        header('Location: blogs.php');

    }else{
        echo "Some error ". mysqli_connect_error();
    }
}

    $all_blogs = "SELECT * from `blogs`";

?>