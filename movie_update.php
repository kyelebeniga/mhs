<?php
    @include 'config.php';

    $id = $_GET['edit'];

    if(isset($_POST['update_movie'])){
        $movie_title = $_POST['movie_title'];
        $movie_year = $_POST['movie_year'];
        $movie_rating = $_POST['movie_rating'];
        $movie_desc = $_POST['movie_desc'];
        $movie_duration = $_POST['movie_duration'];
        $movie_price = $_POST['movie_price'];
        $movie_image = $_FILES['movie_image']['name'];
        $movie_image_tmp_name = $_FILES['movie_image']['tmp_name'];
        $movie_image_folder = 'uploaded_img/'.$movie_image;

        if(empty($movie_title) || empty($movie_desc) || empty($movie_image) || empty($movie_year) || empty($movie_rating) || empty($movie_duration)){
            $message = 'Please fill out all the blanks.';
        }
        else{
            $movie_desc = str_replace("'", "\'", $movie_desc);
            $update_data = "UPDATE movie SET title='$movie_title', year='$movie_year', rating='$movie_rating', description='$movie_desc', 
                                             duration='$movie_duration', price='$movie_price', image='$movie_image' WHERE movieid = '$id'";
            $upload = mysqli_query($conn, $update_data);
            if($upload){
                move_uploaded_file($movie_image_tmp_name, $movie_image_folder);
                echo "<script>
                    alert('Successfully updated movie!');
                    window.open('movies.php','_self');
                </script>";
            }
            else{
                echo "<script>
                    alert('Error: Could not update.');
                </script>";
            }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/movies.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
    <?php
        if(isset($message)){
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    ?>
    <div class="container">
        <?php
            $select = mysqli_query($conn, "SELECT * FROM movie WHERE movieid = '$id'");
            while($row = mysqli_fetch_assoc($select)){
        ?>
        <div class="form-update" id="myForm">
            <form action="" method="post" enctype="multipart/form-data" class="form-container">
                <h3>Update Movie</h3>
                <input type="text" placeholder="Movie title" name="movie_title" class="box">
                <input type="text" placeholder="Year" name="movie_year" class="box">
                <input type="text" placeholder="Maturity Rating" name="movie_rating" class="box">
                <input type="text" placeholder="Description" name="movie_desc" class="box">
                <input type="text" placeholder="Duration" name="movie_duration" class="box">
                <input type="text" placeholder="Price" name="movie_price" class="box">

                <label for="image-file" class="image-label">Upload Image</label>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="movie_image" id="image-file">
                <script>
                    //Replaces "Upload Image" with the file name of the user's uploaded image
                    $('#image-file').change(function() {
                        var i = $(this).prev('label').clone();
                        var file = $('#image-file')[0].files[0].name;
                        $(this).prev('label').text(file);
                    });
                </script>

                <input type="submit" class="btn" name="update_movie" value="Update">
                <a href="movies.php" class="btn-cancel">Cancel</a>
            </form>
        </div>
        <?php }; ?>
        
    </div>
</body>
</html>