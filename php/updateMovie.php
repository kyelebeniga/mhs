<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'mhs_db');

    $id = $_POST['id'];

    $movie_title = $_POST['movie_title'];
    $movie_year = $_POST['movie_year'];
    $movie_rating = $_POST['movie_rating'];
    $movie_desc = $_POST['movie_desc'];
    $movie_duration = $_POST['movie_duration'];
    $movie_price = $_POST['movie_price'];
    $movie_image = $_FILES['movie_image2']['name'];
    $movie_image_tmp_name = $_FILES['movie_image2']['tmp_name'];
    $movie_image_folder = 'uploaded_img/'.$movie_image;
    $movie_banner = $_FILES['movie_banner2']['name'];
    $movie_banner_tmp_name = $_FILES['movie_banner2']['tmp_name'];
    $movie_banner_folder = 'uploaded_img/banner/'.$movie_banner;

    $movie_desc = str_replace("'", "\'", $movie_desc);
    $update_data = "UPDATE movie SET title='$movie_title', year='$movie_year', rating='$movie_rating', description='$movie_desc', 
                    duration='$movie_duration', price='$movie_price', image='$movie_image', banner='$movie_banner' WHERE movieid = '$id'";
    $upload = mysqli_query($conn, $update_data);
    
        move_uploaded_file($movie_image_tmp_name, $movie_image_folder);
        move_uploaded_file($movie_banner_tmp_name, $movie_banner_folder);
    
?>