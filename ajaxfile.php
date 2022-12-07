<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'blogs';

$db_connect = mysqli_connect($servername, $username, $password, $database);

$id = $_POST['blog_id'];

$blog_details = "select * from `blogs` where id= ". $_POST['blog_id'] ;

$result = mysqli_query($db_connect, $blog_details);

while ($row = mysqli_fetch_array($result)) {
?>
    <table border='0' width='100%'>
        <tr>
            <td width="150"><img src="uploads/<?php echo $row['image']; ?>">
            <td style="padding:20px;">
                <div class="col-md-12 m-2">
                    <span><strong>Title : </strong> <?php echo $row['title']; ?></span>
                </div>
                <div class="col-md-12 m-2">
                    <p class="text-muted">Publihed At : <?php echo $row['published_at']; ?></p>
                </div>
                <hr>
                <p><strong>Description : </strong> <?php echo $row['description']; ?></p>
            </td>
        </tr>
    </table>

<?php } ?>