<?php
    @include 'config.php';
    session_start();

    $id = $_GET['movie_id'];

    $mysql = "SELECT * FROM movie where movieid = '$id'";
    $result = mysqli_query($conn, $mysql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | <?php echo $row['title']; ?></title>
    <link rel="stylesheet" href="css/movie_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>
        <a href="#" class="logo">MHS</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
                if((isset($_SESSION['role']) && $_SESSION['role'] == "admin")){
                    echo "<li><a href=".'movies.php'.">Movies</a></li>";
                }else{
                    echo "<li><a href=".'tickets.php'.">Movies</a></li>";
                }
            ?>
            <li><a href="#"><?php echo $_SESSION['username']; ?></a>
                <ul>
                    <?php
                        if((isset($_SESSION['role']) && $_SESSION['role'] == "admin")){
                            echo "<li><a href=".'adminhistory.php'.">Purchases</a></li>";
                        }else{
                            echo "<li><a href=".'history.php'.">History</a></li>";
                        }
                    ?>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <div class="main-container">
        <div class="banner">
            <img src="uploaded_img/banner/<?php echo $row['banner']; ?>" alt="banner">
            <div class="banner-overlay"></div>
        </div>
        <div class="movie-content">
            <div class="movie-poster">
                <img src="uploaded_img/<?php echo $row['image']; ?>" height="300" width="200" alt="">
            </div>
            <div class="movie-text">
                <h1><?php echo $row['title']?></h1>
                <p><?php echo $row['rating'] . ' | ' .$row['year'] . ' | ' . $row['duration']; ?></p>
                <a href="purchase.php?movieid=<?php echo $row['movieid']; ?>" class="btn"><i class="fa-solid fa-cart-shopping"></i> Purchase </a>
                <p class="price">$<?php echo $row['price'];?></p>
            </div>
            <div class="movie-desc">
                <h1>Synopsis: </h1>
                <p><?php echo $row['description']; ?></p>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>
</html>