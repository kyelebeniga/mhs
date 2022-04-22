<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'mhs_db');

    $movie_title = $_POST['movie_title'];
    $movie_year = $_POST['movie_year'];
    $movie_rating = $_POST['movie_rating'];
    $movie_desc = $_POST['movie_desc'];
    $movie_duration = $_POST['movie_duration'];
    $movie_price = $_POST['movie_price'];
    $movie_image = $_FILES['movie_image']['name'];
    $movie_image_tmp_name = $_FILES['movie_image']['tmp_name'];
    $movie_image_folder = 'uploaded_img/'.$movie_image;
    $movie_banner = $_FILES['movie_banner']['name'];
    $movie_banner_tmp_name = $_FILES['movie_banner']['tmp_name'];
    $movie_banner_folder = 'uploaded_img/banner/'.$movie_banner;

    $movie_desc = str_replace("'", "\'", $movie_desc); //Sanitizes input for movie description
    $insert = "INSERT INTO movie(title, year, rating, description, duration, price, image, banner) VALUES('$movie_title', '$movie_year', '$movie_rating', 
                '$movie_desc', '$movie_duration', '$movie_price', '$movie_image', '$movie_banner');";
    $upload = mysqli_multi_query($conn, $insert);
    if($upload){
        move_uploaded_file($movie_image_tmp_name, $movie_image_folder);
        move_uploaded_file($movie_banner_tmp_name, $movie_banner_folder);
    }
?>