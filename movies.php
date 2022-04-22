<?php
    @include 'config.php';
    session_start();
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
    <script src="js/notify.js"></script>
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
            <li><a href="index.php" class="link">Home</a></li>
            <li><a href="#" class="link" id="current-page">Movies</a></li>
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
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="form-container" id="movieForm">
                    <h3>Add movie</h3>
                    <input type="text" placeholder="Movie title" name="movie_title" id="movie_title" class="box">
                    <input type="text" placeholder="Year" name="movie_year" id="movie_year" class="box">
                    <input type="text" placeholder="Maturity Rating" name="movie_rating" id="movie_rating" class="box">
                    <input type="text" placeholder="Description" name="movie_desc" id="movie_desc" class="box">
                    <input type="text" placeholder="Duration (Ex. 1h 20m)" name="movie_duration" id="movie_duration" class="box">
                    <input type="text" placeholder="Price" name="movie_price" id="movie_price" class="box">

                    <label for="image-file" class="image-label" id="poster-label">Upload Poster</label>
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="movie_image" id="image-file">
                    <script>
                        //Replaces "Upload Poster" with the file name of the user's uploaded image
                        $('#image-file').change(function() {
                            var i = $(this).prev('label').clone();
                            var file = $('#image-file')[0].files[0].name;
                            $(this).prev('label').text(file);
                        });
                    </script>

                    <label for="image-banner" class="image-label" id="label-banner">Upload Banner (1920x550)</label>
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
            <table class="movie-table" id="movie-table">
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
                                <button class="deleteBtn" id="<?php echo $row['movieid']; ?>"><i class="fas fa-trash"></i>Delete</a>
                            </div>
                        </td>
                    <tr>
                <?php }; ?>
            </table>
        </div>
    </section>
    

    <!--JavaScript-->
    <script src="js/deleteMovie.js"></script>
    <script src="js/insertMovie.js"></script>
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
