<?php
    @include 'config.php';
    //sends user to login page if they haven't logged in yet
    session_start();
    if (!isset($_SESSION['username'])){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | Home</title>
    <link rel="stylesheet" href="css/home.css">
    <script src="https://use.fontawesome.com/b47846fa65.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>
<body>
    <header>
        <a href="#" class="logo">MHS</a>
        <ul>
            <li><a href="#" class="current-page">Home</a></li>
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
    <section class="banner">
        <?php
            $select = mysqli_query($conn, "SELECT movieid, image, title FROM movie");
        ?>
        <h1>Now Showing</h1>
        <div id="carousel">
            <div class="slick">
                <?php while($row = mysqli_fetch_assoc($select)){ ?>
                    <div class="now-showing">
                        <a href="movie_page.php?movie_id=<?php echo $row['movieid']; ?>"><img src="uploaded_img/<?php echo $row['image']; ?>"></a>
                        <p><?php echo $row['title']; ?></p>
                    </div>
                <?php }; ?>
            </div>
        </div>
    </section>
   

    <!--Navbar JavaScript-->
    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            $('#carousel .slick').slick({
                dots:true,
                autoplay: true,
                autoplaySpeed: 6000,
                speed: 500,
            });
        });
    </script>

</body>
</html>
