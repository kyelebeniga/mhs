<?php
    @include 'config.php';

    session_start();
    if(isset($_POST['add_movie'])){
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

        if(empty($movie_title) || empty($movie_desc) || empty($movie_image) || empty($movie_year) || empty($movie_rating) || empty($movie_duration) || empty($movie_banner)){
            $message = 'Please fill out all the blanks.';
        }
        else{
            $movie_desc = str_replace("'", "\'", $movie_desc); //Sanitizes input for movie description
            $insert = "INSERT INTO movie(title, year, rating, description, duration, price, image, banner) VALUES('$movie_title', '$movie_year', '$movie_rating', 
                        '$movie_desc', '$movie_duration', '$movie_price', '$movie_image', '$movie_banner');";
            $upload = mysqli_multi_query($conn, $insert);
            if($upload){
                move_uploaded_file($movie_image_tmp_name, $movie_image_folder);
                move_uploaded_file($movie_banner_tmp_name, $movie_banner_folder);
                $message = 'New movie added!';
            }
            else{
                $message = 'Error: Could not add movie.';
            }
        }
    };
    //Deletes movie entry
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM movie WHERE movieid = $id");
        echo "<script type='text/javascript'>alert('Movie entry deleted!');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | Movies</title>
    <link rel="stylesheet" href="css/movies.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
    <?php
        if(isset($message)){
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    ?>
    <header>
        <a href="#" class="logo">MHS</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#" class="current-page">Movies</a></li>
            <li><a href="#"><?php echo $_SESSION['username']; ?></a>
                <ul>
                    <li><a href="adminhistory.php">Purchases</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <section class="banner">
        <h1>Movies</h1>
        <button class="open-button" onclick="openForm()">Add Submission</button>
        <div class="container">
            <div class="form-popup" id="myForm">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="form-container">
                    <h3>Add movie</h3>
                    <input type="text" placeholder="Movie title" name="movie_title" class="box">
                    <input type="text" placeholder="Year" name="movie_year" class="box">
                    <input type="text" placeholder="Maturity Rating" name="movie_rating" class="box">
                    <input type="text" placeholder="Description" name="movie_desc" class="box">
                    <input type="text" placeholder="Duration (Ex. 1h 20m)" name="movie_duration" class="box">
                    <input type="text" placeholder="Price" name="movie_price" class="box">

                    <label for="image-file" class="image-label">Upload Poster</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="movie_image" id="image-file">
                    <script>
                        //Replaces "Upload Poster" with the file name of the user's uploaded image
                        $('#image-file').change(function() {
                            var i = $(this).prev('label').clone();
                            var file = $('#image-file')[0].files[0].name;
                            $(this).prev('label').text(file);
                        });
                    </script>

                    <label for="image-banner" class="image-label">Upload Banner (1920x550)</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="movie_banner" id="image-banner">
                    <script>
                        $('#image-banner').change(function() {
                            var i = $(this).prev('label').clone();
                            var file = $('#image-banner')[0].files[0].name;
                            $(this).prev('label').text(file);
                        });
                    </script>
                    <input type="submit" class="btn" name="add_movie" value="Submit">
                    <input type="button" class="btn-cancel" onclick="closeForm()" value="Cancel">
                </form>
            </div>
        </div>
        <div id="pageMask"></div>
    </section>

    <!--Movie Table-->
    <section class="movie-list">
        <?php
            $select = mysqli_query($conn, "SELECT * FROM movie")
        ?>
        <div class="movie-display">
            <table class="movie-table">
                <thead>
                    <tr>
                        <th class="poster">Poster</th>
                        <th>Title</th>
                        <th class="table-desc">Description</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <!--Populate Movie Table-->
                <?php while($row = mysqli_fetch_assoc($select)){ ?>
                    <tr>
                        <td>
                            <a href="movie_page.php?movie_id=<?php echo $row['movieid']; ?>"><img src="uploaded_img/<?php echo $row['image']; ?>" height="300" width="200" alt=""></a>
                        </td>
                        <td><a href="movie_page.php?movie_id=<?php echo $row['movieid']; ?>"><?php echo $row['title'] . '<br>$' .$row['price']; ?></a></td>
                        <td class="table-desc-content"><?php echo $row['description']; ?></td>
                        <td>
                            <div class="buttons">
                                <a href="movie_update.php?edit=<?php echo $row['movieid']; ?>" class="btn"><i class="fas fa-edit"></i>Edit</a>
                                <a href="movies.php?delete=<?php echo $row['movieid']; ?>" class="btn"><i class="fas fa-trash"></i>Delete</a>
                            </div>
                        </td>
                    <tr>
                <?php }; ?>
            </table>
        </div>
    </section>
    

    <!--JavaScript-->
    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
        function openForm(){
            document.getElementById("myForm").style.display = "block";
            document.getElementById("pageMask").style.display = "block";
        }
        function closeForm(){
            document.getElementById("myForm").style.display = "none";
            document.getElementById("pageMask").style.display = "none";
        }
    </script>

</body>
</html>
