<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>

    <link rel="stylesheet" href="style.css">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script>
        $(function() {
            $("#tabs").tabs();
        });
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark" id="navigation_bar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <h2>Yuvraj Blogs</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                </ul>
                <span class="navbar-text nav_blog_btn">
                    <a href="addblogs.html" class="btn btn-outline-light nav_blog_btn">
                        <span class="nav_blog_btn">Create new Blog</span>
                    </a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 800px; margin-left:-100px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Blog Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div id="tabs">
        <ul style="padding:30px;">
            <li style="margin:10px;"><a href="#tabs-1">Your Blogs</a></li>
            <li style="margin:10px;"><a href="#tabs-2">All Blogs</a></li>
        </ul>
        <div id="tabs-1">
            <div class="row ml-5">
                <?php
                $data = mysqli_query($db_connect, $all_blogs);

                // $row = mysqli_fetch_assoc($data);
                // print_r($row);

                while ($row = mysqli_fetch_assoc($data)) {
                    echo ' 
                        <div class="col-md-4 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src= "uploads/' . $row['image'] . '" alt="' . $row['title'] . '" style="height:200px;">
                                    <div class="card-body">
                                        <h5 class="card-title" id="blog_title">' . $row['title'] . '</h5>
                                        <p class="card-text">' . $row['description'] . '</p>
                                        <span class="text-muted">Published At: ' . $row['published_at'] . ' </span>
                                    </div>
                                    <button data-id= " ' . $row['id'] . ' " class="btn btn-info m-3 blog_single_detail"> Read Full Blog </button> 
                                </div>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>

        <div id="tabs-2">
            <!-- Here a loader is created which loads till response comes -->
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status" id="loading">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <h1 class="heading-1">All Blogs</h1>
            <hr class="container text-center" style="margin: auto; display: block;">

            <!-- cards for showing data -->
            <div class="row">
                <section class="row container m-2">
                    <!-- All the information of the API will be shown here -->
                </section>
            </div>
        </div>
    </div>

</body>

<script src="script.js"></script>

<script>
    $(document).ready(function() {
        $('.blog_single_detail').click(function(e) {

            var blogid = $(this).data('id');
            console.log(blogid);

            $.ajax({
                type: 'POST',
                url: 'ajaxfile.php',
                data: {
                    blog_id: blogid
                },
                success: function(response) {
                    $('.modal-body').html(response);
                    $('#blogModal').modal('show');
                }
            });
        });
    });
</script>

</html>